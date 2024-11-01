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
            //直近登録された人順
            $sql = " select TALENT_ID ,LAYER_NAME, AFFILIATION_DATE, RETIREMENT_DATE, DEL_FLG from TALENT order by TALENT_ID desc;";
            
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

        //タレントの表示情報を取得するSQL
        public function getTalentInfoCtl($talentId){
            $sql = $this->db->prepare(  "select "
            . "    TALENT_ID           ,    "
            . "    FOLLOWERS_FLG       ,    "
            . "    HEIGHT_FLG          ,    "
            . "    AGE_FLG             ,    "
            . "    BIRTHDAY_FLG        ,    "
            . "    THREE_SIZES_FLG     ,    "
            . "    THREE_SIZES_B_FLG   ,    "
            . "    THREE_SIZES_W_FLG   ,    "
            . "    THREE_SIZES_H_FLG   ,    "
            . "    HOBBY_SPECIALTY_FLG ,    "
            . "    COMMENT_FLG         ,    "
            . "    SNS_1_FLG           ,    "
            . "    SNS_2_FLG           ,    "
            . "    SNS_3_FLG                "
            . " from TALENT_INFO_CTL        "
            . " where TALENT_ID = ?;          ");

            // SQL文を実行
            $sql->bindValue(1, $talentId);
            $sql->execute();
            return $row = $sql->fetchall(PDO::FETCH_ASSOC);
        }

        //タレントの表示情報を新規登録するSQL
        public function insertTalent($talentInfo){
            $sql = $this->db->prepare(
            "insert into TALENT(TALENT_NAME         , "
            . " TALENT_FURIGANA_JP  , "
            . " TALENT_FURIGANA_EN  , "
            . " LAYER_NAME          , "
            . " LAYER_FURIGANA_JP   , "
            . " LAYER_FURIGANA_EN   , "
            . " FOLLOWERS           , "
            . " STREAM_FLG          , "
            . " COS_FLG             , "
            . " HEIGHT              , "
            . " AGE                 , "
            . " BIRTHDAY            , "
            . " THREE_SIZES_B       , "
            . " THREE_SIZES_W       , "
            . " THREE_SIZES_H       , "
            . " HOBBY_SPECIALTY     , "
            . " COMMENT             , "
            . " AFFILIATION_DATE    , "
            . " RETIREMENT_DATE     , "
            . " MAIL                , "
            . " TEL_NO              , "
            . " SNS_1               , "
            . " SNS_2               , "
            . " SNS_3                "
            . " )                     "
            . " values (    "
            . " :TALENT_NAME            , "
            . " :TALENT_FURIGANA_JP     , "
            . " :TALENT_FURIGANA_EN     , "
            . " :LAYER_NAME             , "
            . " :LAYER_FURIGANA_JP      , "
            . " :LAYER_FURIGANA_EN      , "
            . " :FOLLOWERS              , "
            . " :STREAM_FLG             , "
            . " :COS_FLG                , "
            . " :HEIGHT                 , "
            . " :AGE                    , "
            . " :BIRTHDAY               , "
            . " :THREE_SIZES_B          , "
            . " :THREE_SIZES_W          , "
            . " :THREE_SIZES_H          , "
            . " :HOBBY_SPECIALTY        , "
            . " :COMMENT                , "
            . " :AFFILIATION_DATE       , "
            . " :RETIREMENT_DATE        , "
            . " :MAIL                   , "
            . " :TEL_NO                 , "
            . " :SNS_1                  , "
            . " :SNS_2                  , "
            . " :SNS_3                   "
            . " );");

            foreach($talentInfo as $key => $value){
                $sql -> bindValue($key, $value);
            }
            $sql -> execute();

        }

        //タレント情報の表示を新規登録するSQL
        public function insertTalentInfoCtl($viewInfo){
            $sql = $this->db->prepare(  
            "insert into TALENT_INFO_CTL( "
            . "    TALENT_ID           ,    "
            . "    FOLLOWERS_FLG       ,    "
            . "    HEIGHT_FLG          ,    "
            . "    AGE_FLG             ,    "
            . "    BIRTHDAY_FLG        ,    "
            . "    THREE_SIZES_FLG     ,    "
            . "    THREE_SIZES_B_FLG   ,    "
            . "    THREE_SIZES_W_FLG   ,    "
            . "    THREE_SIZES_H_FLG   ,    "
            . "    HOBBY_SPECIALTY_FLG ,    "
            . "    COMMENT_FLG         ,    "
            . "    SNS_1_FLG           ,    "
            . "    SNS_2_FLG           ,    "
            . "    SNS_3_FLG                "
            . ") values (                   "
            . "    (select MAX(TALENT_ID) from TALENT),"
            . "    :FOLLOWERS_FLG       ,   "
            . "    :HEIGHT_FLG          ,   "
            . "    :AGE_FLG             ,   "
            . "    :BIRTHDAY_FLG        ,   "
            . "    :THREE_SIZES_FLG     ,   "
            . "    :THREE_SIZES_B_FLG   ,   "
            . "    :THREE_SIZES_W_FLG   ,   "
            . "    :THREE_SIZES_H_FLG   ,   "
            . "    :HOBBY_SPECIALTY_FLG ,   "
            . "    :COMMENT_FLG         ,   "
            . "    :SNS_1_FLG           ,   "
            . "    :SNS_2_FLG           ,   "
            . "    :SNS_3_FLG               "
            . ");");

            foreach($viewInfo as $key => $value){
                $sql -> bindValue($key, $value);
            }

            $sql -> execute();
            return $sql -> rowCount();
        }

        //タレント登録時にタグ（男装・女装）を登録するSQL
        public function insertTalentTag($tagName){
            $sql = $this->db->prepare(  
                " insert into TALENT_TAG(TALENT_ID, TAG_ID) values( "
                    . " (select MAX(TALENT_ID) from TALENT), "
                    . " (select TAG_ID from M_TAG where TAG_NAME = ?) "
                    . ");");

            $sql -> bindValue(1, $tagName);
    
            $sql -> execute();
            return $sql -> rowCount();
        }

        //タレント削除（物理削除ではなく論理削除）
        //RETIREMENT_DATEとDEL_FLGを更新
        public function deleteTalent($retireDate, $talentId){
            //TALENT.
            $sql = $this->db->prepare(  
                " UPDATE TALENT "
                    . " SET RETIREMENT_DATE = ? "
                    . ", UPD_DATE = CURRENT_TIMESTAMP() "
                    . ", DEL_FLG = '1' "
                    . " where TALENT_ID = ? ;");
            
            $sql -> bindValue(1, $retireDate);
            $sql -> bindValue(2, $talentId);
            $sql -> execute();

        }
    }
?>