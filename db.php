<?php
    class DbController{
        private $db;
        private $ERROR = array();
        public function __construct(){
            // 接続エラーを取得するための記述
            try {
                //mysql接続
                $this->db = new PDO('mysql:dbname=cospla_develop;host=localhost;charset=utf8', 'cospla_develop01', 'develop01');
            // 接続エラーの例外を処理 
            } catch(PDOException $e) {
                $this->ERROR[] = "接続失敗：".$e->getMessage();
            }
        }

        //ヘッダーとフッターのロゴを取得するSQL
        public function getLogoImg(){
            
            $sql = "select FILE_NAME, FILE_PATH , COMMENT ALT"
                . " from IMG_LIST "
                . " where VIEW_FLG = 'S999' and PRIORITY=1;  ";
            // SQL文を実行
            return $row = $this->db->query($sql, PDO::FETCH_ASSOC);
        }

        //TOPページのスライドショーを取得するSQL
        //VIEW_FLG in ('S201')
        public function getSlideImg(){
            
            $sql = "select FILE_NAME , FILE_PATH , COMMENT ALT, SPARE1 TITLE, SPARE2 DISCRIPTION"
                . " from IMG_LIST "
                . " where VIEW_FLG in ('S201') "
                . "   and DEL_FLG = '0'"
                . " order by PRIORITY; ";
            // SQL文を実行
            return $row = $this->db->query($sql, PDO::FETCH_ASSOC);
        }

        //TOPページのスライドショーの件数を取得するSQL
        //VIEW_FLG in ('S201')
        public function getSlideCnt(){
            
            $sql = "select count(*)"
                . " from IMG_LIST  "
                . " where VIEW_FLG in ('S201') "
                . "   and DEL_FLG = '0' "
                . " order by PRIORITY; ";
            // SQL文を実行
            return $row = $this->db->query($sql, PDO::FETCH_ASSOC);
        }

        //タレントと紐つかない画像を取得するSQL
        public function getTopImg(String $viewFlg='0'){
            
            $sql = $this->db->prepare("select FILE_NAME, FILE_PATH, COMMENT ALT"
                . " from IMG_LIST "
                . " where VIEW_FLG in ( ? ) "
                . "   and DEL_FLG = '0'"
                . " order by PRIORITY; ");
            
            // SQL文を実行
            $sql->bindValue(1, $viewFlg);
            $sql->execute();
            return $row = $sql->fetchall(PDO::FETCH_ASSOC);

        }

        //TOPページの写真を取得するSQL
        public function getTopImgValue(String $viewFlg, int $limit){
            
            if($viewFlg === '01'){
                $sql = $this->db->prepare("select t.LAYER_NAME LAYER_NAME, img.FILE_NAME FILE_NAME, img.FILE_PATH FILE_PATH, img.COMMENT ALT"
                        . " from TALENT t, IMG_LIST img "
                        . " where img.VIEW_FLG = ? "
                        . " and img.DEL_FLG = '0' "
                        . " and t.TALENT_ID = img.TALENT_ID "
                        . " order by img.PRIORITY "
                        . " limit ? ;");
            }

            if($viewFlg === 'S203'){
                $sql = $this->db->prepare("select FILE_NAME, FILE_PATH, COMMENT ALT"
                        . " from IMG_LIST "
                        . " where VIEW_FLG = ? "
                        . " and DEL_FLG = '0'"
                        . " order by PRIORITY "
                        . " limit ? ;");
            }

            // SQL文を実行
            $sql->bindValue(1, $viewFlg);
            $sql->bindParam(2, $limit, PDO::PARAM_INT );
            $sql->execute();
            return $row = $sql->fetchall(PDO::FETCH_ASSOC);
        }

        //TOPページのニュースを取得するSQL
        public function getNewsTitle(){
            
            $sql = " select NEWS_ID, TITLE, POST_DATE from NEWS where DEL_FLG='0' order by POST_DATE limit 5; ";
            
            // SQL文を実行
            return $row = $this->db->query($sql, PDO::FETCH_ASSOC);
        }

        //NEWSページの情報を取得するSQL
        public function getNewsContent($newsId='0'){
            
            $sql = $this->db->prepare(" select NEWS_ID, TITLE, POST_DATE, CONTENT from NEWS "
                    . "where DEL_FLG = '0' "
                    . "  and NEWS_ID = ?; ");
            
            // SQL文を実行
            $sql->bindValue(1, $newsId);
            $sql->execute();
            return $row = $sql->fetchall(PDO::FETCH_ASSOC);
        }

        //ABOUTページの会社情報を取得するSQL
        public function getCompany(){
            
            $sql = "select COMPANY_NAME, DATE_FORMAT(ESTABLISHMENT_DATE, '%Y年%c月') ESTABLISHMENT_DATE, DIRECTOR, POST_CODE, LOCATION, CONTENT from M_COMPANY;";

            // SQL文を実行
            return $row = $this->db->query($sql, PDO::FETCH_ASSOC);
        }

        //TALENTページの写真を取得するSQL
        public function getTalentImg(){
            
            $sql = " select t.LAYER_NAME LAYER_NAME, "
                    . "t.TALENT_ID TALENT_ID, "
                    . "img1.FILE_NAME FILE_NAME1, "
                    . "img1.FILE_PATH FILE_PATH1, "
                    . "img1.COMMENT ALT1, "
                    . "img2.FILE_NAME FILE_NAME2, "
                    . "img2.FILE_PATH FILE_PATH2, "
                    . "img2.COMMENT ALT2 "
                    . "from TALENT t, IMG_LIST img1, IMG_LIST img2 "
                    . " where t.TALENT_ID = img1.TALENT_ID "
                    . "and t.TALENT_ID = img2.TALENT_ID "
                    . "and img1.VIEW_FLG = '01' "
                    . "and img2.VIEW_FLG = '02' "
                    . "and t.DEL_FLG = '0' "
                    . "and t.RETIREMENT_DATE > CURDATE() "
                    . "order by img1.PRIORITY ; ";

            // SQL文を実行
            return $row = $this->db->query($sql, PDO::FETCH_ASSOC);
        }

        //TALENT詳細ページのタレント情報を取得するSQL
        public function getTalentProfile(String $viewFlg, String $talentId){
            
            $sql = $this->db->prepare("select              "
                    . "  t.TALENT_ID TALENT_ID                   ,"
                    . "  t.TALENT_NAME TALENT_NAME               ,"
                    . "  t.TALENT_FURIGANA_JP TALENT_FURIGANA_JP ,"
                    . "  t.TALENT_FURIGANA_EN TALENT_FURIGANA_EN ,"
                    . "  t.LAYER_NAME LAYER_NAME                 ,"
                    . "  t.LAYER_FURIGANA_JP LAYER_FURIGANA_JP   ,"
                    . "  t.LAYER_FURIGANA_EN LAYER_FURIGANA_EN   ,"
                    . "  t.FOLLOWERS FOLLOWERS                   ,"
                    . "  t.STREAM_FLG STREAM_FLG                 ,"
                    . "  t.COS_FLG COS_FLG                       ,"
                    . "  t.HEIGHT HEIGHT                         ,"
                    . "  t.AGE AGE                               ,"
                    . "  t.BIRTHDAY BIRTHDAY                     ,"
                    . "  t.THREE_SIZES_B THREE_SIZES_B           ,"
                    . "  t.THREE_SIZES_W THREE_SIZES_W           ,"
                    . "  t.THREE_SIZES_H THREE_SIZES_H           ,"
                    . "  t.HOBBY_SPECIALTY HOBBY_SPECIALTY       ,"
                    . "  t.COMMENT TALENT_COMMENT                ,"
                    . "  t.AFFILIATION_DATE AFFILIATION_DATE     ,"
                    . "  t.RETIREMENT_DATE RETIREMENT_DATE       ,"
                    . "  t.MAIL MAIL                             ,"
                    . "  t.TEL_NO TEL_NO                         ,"
                    . "  t.SNS_1 SNS_1                           ,"
                    . "  t.SNS_2 SNS_2                           ,"
                    . "  t.SNS_3 SNS_3                           ,"
                    . "  img.FILE_NAME FILE_NAME                 ,"
                    . "  img.FILE_PATH FILE_PATH                 ,"
                    . "  img.COMMENT ALT                          ,"
                    . " tctl.FOLLOWERS_FLG FOLLOWERS_FLG         ,"
                    . " tctl.HEIGHT_FLG HEIGHT_FLG               ,"
                    . " tctl.AGE_FLG AGE_FLG                     ,"
                    . " tctl.BIRTHDAY_FLG BIRTHDAY_FLG           ,"
                    . " tctl.THREE_SIZES_FLG THREE_SIZES_FLG     ,"
                    . " tctl.THREE_SIZES_B_FLG THREE_SIZES_B_FLG ,"
                    . " tctl.THREE_SIZES_W_FLG THREE_SIZES_W_FLG ,"
                    . " tctl.THREE_SIZES_H_FLG THREE_SIZES_H_FLG ,"
                    . " tctl.HOBBY_SPECIALTY_FLG HOBBY_SPECIALTY_FLG,"
                    . " tctl.COMMENT_FLG COMMENT_FLG             ,"
                    . " tctl.SNS_1_FLG SNS_1_FLG                 ,"
                    . " tctl.SNS_2_FLG SNS_2_FLG                 ,"
                    . " tctl.SNS_3_FLG SNS_3_FLG                  "
                    . " from TALENT t, IMG_LIST img, TALENT_INFO_CTL tctl "
                    . " where t.TALENT_ID = img.TALENT_ID         "
                    . " and t.TALENT_ID = tctl.TALENT_ID          "
                    . " and img.VIEW_FLG = ?                       "
                    . " and t.TALENT_ID = ?                       "
                    . " and t.DEL_FLG = '0'                       "
                    . " and t.RETIREMENT_DATE > CURDATE()         "
                    . " order by img.PRIORITY                      ");

            // SQL文を実行
            $sql->bindValue(1, $viewFlg);
            $sql->bindValue(2, $talentId);
            $sql->execute();
            return $row = $sql->fetchall(PDO::FETCH_ASSOC);
        }

        //TALENT詳細ページのタレントのタグを取得するSQL
        public function getTalentTag(String $talentId='0'){
            
            $sql = $this->db->prepare("select mtag.TAG_NAME TAG_NAME, mtag.TAG_COLOR TAG_COLOR from TALENT t, TALENT_TAG tag, M_TAG mtag"
                            . "  where t.TALENT_ID = tag.TALENT_ID "
                            . "  and tag.TAG_ID = mtag.TAG_ID "
                            . "  and t.DEL_FLG = '0' "
                            . "  and t.RETIREMENT_DATE > CURDATE() "
                            . "  and tag.TALENT_ID= ? ;");
            // SQL文を実行
            $sql->bindValue(1, $talentId);
            $sql->execute();
            return $row = $sql->fetchall(PDO::FETCH_ASSOC);
        }

        //TALENT詳細ページのキャリアのカテゴリを取得するSQL
        public function getCareerCategory(String $talentId='0'){
            
            $sql = $this->db->prepare("select distinct mcr.CAREER_CATEGORY_NAME CAREER_CATEGORY_NAME"
                            . " from TALENT t, TALENT_CAREER cr, M_CAREER_CATEGORY mcr "
                            . " where t.TALENT_ID = cr.TALENT_ID "
                            . " and cr.CAREER_CATEGORY_ID = mcr.CAREER_CATEGORY_ID "
                            . " and t.DEL_FLG = '0' "
                            . " and t.RETIREMENT_DATE > CURDATE() "
                            . " and cr.TALENT_ID= ? ;");
            // SQL文を実行
            $sql->bindValue(1, $talentId);
            $sql->execute();
            return $row = $sql->fetchall(PDO::FETCH_ASSOC);
        }

        //TALENT詳細ページのタレントのキャリアを取得するSQL
        public function getTalentCareer(String $talentId='0'){
            
            $sql = $this->db->prepare("select mcr.CAREER_CATEGORY_NAME CAREER_CATEGORY_NAME, cr.CONTENT CONTENT"
                            . " from TALENT t, TALENT_CAREER cr, M_CAREER_CATEGORY mcr "
                            . " where t.TALENT_ID = cr.TALENT_ID "
                            . " and cr.CAREER_CATEGORY_ID = mcr.CAREER_CATEGORY_ID "
                            . " and t.DEL_FLG = '0' "
                            . " and t.RETIREMENT_DATE > CURDATE() "
                            . " and cr.TALENT_ID= ? ;");
            // SQL文を実行
            $sql->bindValue(1, $talentId);
            $sql->execute();
            return $row = $sql->fetchall(PDO::FETCH_ASSOC);
        }
    }
?>