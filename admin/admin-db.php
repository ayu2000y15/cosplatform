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

        //タレント情報を取得するSQL
        public function getTalentList(){
            $sql = " select TALENT_ID ,LAYER_NAME from TALENT;";
            
            return $row = $this->db->query($sql, PDO::FETCH_ASSOC);
        }

        //タレント情報を取得するSQL
        public function getTalent($talentId){
            $sql = $this->db->prepare(" select                  "
                    . " TALENT_ID             , "
                    . " TALENT_NAME           , "
                    . " TALENT_FURIGANA_JP    , "
                    . " TALENT_FURIGANA_EN    , "
                    . " LAYER_NAME            , "
                    . " LAYER_FURIGANA_JP     , "
                    . " LAYER_FURIGANA_EN     , "
                    . " FOLLOWERS             , "
                    . " STREAM_FLG            , "
                    . " COS_FLG               , "
                    . " HEIGHT                , "
                    . " AGE                   , "
                    . " BIRTHDAY              , "
                    . " THREE_SIZES_B         , "
                    . " THREE_SIZES_W         , "
                    . " THREE_SIZES_H         , "
                    . " HOBBY_SPECIALTY       , "
                    . " COMMENT               , "
                    . " AFFILIATION_DATE      , "
                    . " RETIREMENT_DATE       , "
                    . " MAIL                  , "
                    . " TEL_NO                , "
                    . " SNS_1                 , "
                    . " SNS_2                 , "
                    . " SNS_3                 , "
                    . " SPARE1                , "
                    . " SPARE2                , "
                    . " SPARE3                , "
                    . " INS_DATE              , "
                    . " UPD_DATE              , "
                    . " DEL_FLG                 "
                    . " from TALENT            "
                    . " where TALENT_ID = ?;");
            // SQL文を実行
            $sql->bindValue(1, $talentId);
            $sql->execute();
            return $row = $sql->fetchall(PDO::FETCH_ASSOC);
        }

    }
?>