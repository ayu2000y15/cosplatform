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
            
            $sql = "select img.FILE_NAME FILE_NAME, img.FILE_PATH FILE_PATH, vi.COMMENT ALT"
                . " from IMG_LIST img, IMG_VIEW vi "
                . " where img.FILE_NAME = vi.FILE_NAME "
                . " and vi.VIEW_FLG = '999' and PRIORITY=1 ";
            // SQL文を実行
            return $row = $this->db->query($sql, PDO::FETCH_ASSOC);
        }

        //TOPページのスライドショーを取得するSQL
        //VIEW_FLG in ('101')
        public function getSlideImg(){
            
            $sql = "select img.FILE_NAME FILE_NAME, img.FILE_PATH FILE_PATH, vi.COMMENT ALT, vi.SPARE1 TITLE, vi.SPARE2 DISCRIPTION"
                . " from IMG_LIST img, IMG_VIEW vi "
                . " where img.FILE_NAME = vi.FILE_NAME "
                . "   and vi.VIEW_FLG in ('101') "
                . " order by vi.PRIORITY; ";
            // SQL文を実行
            return $row = $this->db->query($sql, PDO::FETCH_ASSOC);
        }

        //TOPページのスライドショーの件数を取得するSQL
        //VIEW_FLG in ('101')
        public function getSlideCnt(){
            
            $sql = "select count(*)"
                . " from IMG_LIST img, IMG_VIEW vi "
                . " where img.FILE_NAME = vi.FILE_NAME "
                . "   and vi.VIEW_FLG in ('101') "
                . " order by vi.PRIORITY; ";
            // SQL文を実行
            return $row = $this->db->query($sql, PDO::FETCH_ASSOC);
        }

        //各ページのTOP画像を取得するSQL
        public function getTopImg(String $viewFlg='0'){
            
            $sql = $this->db->prepare("select img.FILE_NAME FILE_NAME, img.FILE_PATH FILE_PATH, vi.COMMENT ALT"
                . " from IMG_LIST img, IMG_VIEW vi "
                . " where img.FILE_NAME = vi.FILE_NAME "
                . "   and vi.VIEW_FLG in ( ? ) "
                . " order by vi.PRIORITY; ");
            
            // SQL文を実行
            $sql->bindValue(1, $viewFlg);
            $sql->execute();
            return $row = $sql->fetchall(PDO::FETCH_ASSOC);

        }

        //TOPページの写真を取得するSQL
        //VIEW_FLG = '01' talent
        //VIEW_FLG = '02' cosplay
        public function getTopImgValue(String $viewFlg='0', int $limit=0){
            
            $sql = $this->db->prepare("select t.LAYER_NAME LAYER_NAME, img.FILE_NAME FILE_NAME, img.FILE_PATH FILE_PATH, vi.COMMENT ALT"
                    . " from TALENT t, IMG_LIST img, IMG_VIEW vi "
                    . " where t.TALENT_ID = img.TALENT_ID "
                    . " and img.FILE_NAME = vi.FILE_NAME "
                    . " and vi.VIEW_FLG = ? "
                    . " order by vi.PRIORITY "
                    . " limit ? ;");

            // SQL文を実行
            $sql->bindValue(1, $viewFlg);
            $sql->bindParam(2, $limit, PDO::PARAM_INT );
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
                    . "vi2.COMMENT ALT1, "
                    . "img2.FILE_NAME FILE_NAME2, "
                    . "img2.FILE_PATH FILE_PATH2, "
                    . "vi2.COMMENT ALT2 "
                    . "from TALENT t, IMG_LIST img1, IMG_LIST img2, IMG_VIEW vi1, IMG_VIEW vi2 "
                    . " where t.TALENT_ID = img1.TALENT_ID "
                    . "and img1.FILE_NAME = vi1.FILE_NAME "
                    . "and t.TALENT_ID = img2.TALENT_ID "
                    . "and img2.FILE_NAME = vi2.FILE_NAME "
                    . "and vi1.VIEW_FLG = '03' "
                    . "and vi2.VIEW_FLG = '13' "
                    . "order by vi1.PRIORITY ; ";

            // SQL文を実行
            return $row = $this->db->query($sql, PDO::FETCH_ASSOC);
        }

        //COSPLAYページの写真を取得するSQL
        //VIEW_FLG = '04' COSPLAYページに表示
        public function getCosplayImg(){
            
            $sql = "select t.LAYER_NAME LAYER_NAME, img.FILE_NAME FILE_NAME, img.FILE_PATH FILE_PATH, vi.COMMENT ALT"
                    . " from TALENT t, IMG_LIST img, IMG_VIEW vi "
                    . " where t.TALENT_ID = img.TALENT_ID "
                    . " and img.FILE_NAME = vi.FILE_NAME "
                    . " and vi.VIEW_FLG = '04' "
                    . " order by vi.PRIORITY ";

            // SQL文を実行
            return $row = $this->db->query($sql, PDO::FETCH_ASSOC);
        }

    }
?>