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

        public function close(){
            $this->db->close();
        }

        //空文字やNULLのチェックメソッド
        public function isNullOrEmpty($str){
            if($str == null){
                return true;
            }
            if($str == ""){
                return true;
            }
                return false;
        }

        //ヘッダーのロゴを取得するSQL
        public function getLogoImg(){
        
            $sql = "select img.FILE_NAME FILE_NAME, img.FILE_PATH FILE_PATH, vi.COMMENT ALT"
                    . " from IMG_LIST img, IMG_VIEW vi "
                    . " where img.FILE_NAME = vi.FILE_NAME "
                    . " and vi.VIEW_FLG = 'S999' and PRIORITY=1 ";
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

        /* EXE_ID = '02' */
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
                if($this->isNullOrEmpty($value)){
                    $value = null;
                }
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
                if($this->isNullOrEmpty($value)){
                    $value = null;
                }
                $sql -> bindValue($key, $value);
            }

            $sql -> execute();
            return $sql -> rowCount();
        }

        //タレント登録時にタグ（男装・女装）を登録するSQL
        public function insertTalentTagF($tagName){
            $sql = $this->db->prepare(  
                " insert into TALENT_TAG(TALENT_ID, TAG_ID) values( "
                    . " (select MAX(TALENT_ID) from TALENT), "
                    . " (select TAG_ID from M_TAG where TAG_NAME = ?) "
                    . ");");

            $sql -> bindValue(1, $tagName);
    
            $sql -> execute();
            return $sql -> rowCount();
        }

        /* EXE_ID = '11' */
        //タレント情報変更
        public function updateTalent($talentId, $talentInfo){
            //TALENT.
            $sql = $this->db->prepare(  
                " update TALENT "
                . " set "
                . "   TALENT_NAME          = :TALENT_NAME         , "
                . "   TALENT_FURIGANA_JP   = :TALENT_FURIGANA_JP  , "
                . "   TALENT_FURIGANA_EN   = :TALENT_FURIGANA_EN  , "
                . "   LAYER_NAME           = :LAYER_NAME          , "
                . "   LAYER_FURIGANA_JP    = :LAYER_FURIGANA_JP   , "
                . "   LAYER_FURIGANA_EN    = :LAYER_FURIGANA_EN   , "
                . "   FOLLOWERS            = :FOLLOWERS           , "
                . "   STREAM_FLG           = :STREAM_FLG          , "
                . "   COS_FLG              = :COS_FLG             , "
                . "   HEIGHT               = :HEIGHT              , "
                . "   AGE                  = :AGE                 , "
                . "   BIRTHDAY             = :BIRTHDAY            , "
                . "   THREE_SIZES_B        = :THREE_SIZES_B       , "
                . "   THREE_SIZES_W        = :THREE_SIZES_W       , "
                . "   THREE_SIZES_H        = :THREE_SIZES_H       , "
                . "   HOBBY_SPECIALTY      = :HOBBY_SPECIALTY     , "
                . "   COMMENT              = :COMMENT             , "
                . "   AFFILIATION_DATE     = :AFFILIATION_DATE    , "
                . "   RETIREMENT_DATE      = :RETIREMENT_DATE     , "
                . "   MAIL                 = :MAIL                , "
                . "   TEL_NO               = :TEL_NO              , "
                . "   SNS_1                = :SNS_1               , "
                . "   SNS_2                = :SNS_2               , "
                . "   SNS_3                = :SNS_3               , "
                . "   UPD_DATE             = CURRENT_TIMESTAMP()    "
                . " where TALENT_ID = :TALENT_ID;                   "
                );
            
            foreach($talentInfo as $key => $value){
                if($this->isNullOrEmpty($value)){
                    $value = null;
                }
                $sql -> bindValue($key, $value);
            }
            $sql -> bindValue("TALENT_ID", $talentId);
            $sql -> execute();

        }

        //タレント情報の表示情報変更
        public function updateTalentInfoCtl($talentId, $viewInfo){
            //TALENT.
            $sql = $this->db->prepare(  
                "update TALENT_INFO_CTL "
                    . " set "
                    . "    FOLLOWERS_FLG       = :FOLLOWERS_FLG       , "
                    . "    HEIGHT_FLG          = :HEIGHT_FLG          , "
                    . "    AGE_FLG             = :AGE_FLG             , "
                    . "    BIRTHDAY_FLG        = :BIRTHDAY_FLG        , "
                    . "    THREE_SIZES_FLG     = :THREE_SIZES_FLG     , "
                    . "    THREE_SIZES_B_FLG   = :THREE_SIZES_B_FLG   , "
                    . "    THREE_SIZES_W_FLG   = :THREE_SIZES_W_FLG   , "
                    . "    THREE_SIZES_H_FLG   = :THREE_SIZES_H_FLG   , "
                    . "    HOBBY_SPECIALTY_FLG = :HOBBY_SPECIALTY_FLG , "
                    . "    COMMENT_FLG         = :COMMENT_FLG         , "
                    . "    SNS_1_FLG           = :SNS_1_FLG           , "
                    . "    SNS_2_FLG           = :SNS_2_FLG           , "
                    . "    SNS_3_FLG           = :SNS_3_FLG             "
                    . " where TALENT_ID = :TALENT_ID; "
                );

            foreach($viewInfo as $key => $value){
                if($this->isNullOrEmpty($value)){
                    $value = null;
                }
                $sql -> bindValue($key, $value);
            }
            $sql -> bindValue("TALENT_ID", $talentId);
            $sql -> execute();
            
        }

        /* EXE_ID = '12' */
        //タレントに登録された写真を取得するSQL
        public function getTalentImg(String $talentId){
            
            $sql = $this->db->prepare(
                " select "
                . "       t.LAYER_NAME LAYER_NAME,                          "
                . "       img.FILE_NAME FILE_NAME,                          "
                . "       img.FILE_PATH FILE_PATH,                          "
                . "       vi.COMMENT ALT,                                   "
                . "       vi.VIEW_FLG VIEW_FLG,                             "
                . "       vi.PRIORITY PRIORITY,                             "
                . "       mv.COMMENT COMMENT,                               "
                . "       img.DEL_FLG DEL_FLG                               "
                . "       from TALENT t left outer join IMG_LIST img        "
                . "       on t.TALENT_ID = img.TALENT_ID                    "
                . "       left outer join IMG_VIEW vi                       "
                . "       on img.FILE_NAME = vi.FILE_NAME                   "
                . "       left outer join M_VIEW_FLG mv                     "
                . "       on vi.VIEW_FLG = mv.VIEW_FLG                      "
                . "       where t.TALENT_ID = ?                             "
                . "         and img.DEL_FLG = '0'                           "
                . "       order by img.FILE_NAME desc"
                    );
            // SQL文を実行
            $sql->bindValue(1, $talentId);
            $sql->execute();
            return $row = $sql->fetchall(PDO::FETCH_ASSOC);
        }

        //タレント写真の削除
        public function deleteTalentImg($fileName, $talentId){
            $sql = $this->db->prepare(  
                " delete from IMG_LIST "
                . " where FILE_NAME = ? "
                . " and TALENT_ID = ?;"
                );
            
            $sql -> bindValue(1, $fileName);
            $sql -> bindValue(2, $talentId);
            $sql -> execute();

        }
        
        //VIEW_FLGの一覧を取得
        public function getViewFlg(){
            $sql = " select VIEW_FLG, COMMENT from M_VIEW_FLG where VIEW_FLG like '__' order by cast(VIEW_FLG as signed);";
            
            return $row = $this->db->query($sql, PDO::FETCH_ASSOC);
        }

        //タレント写真の表示先更新
        public function updateTalentImg($fileName, $viewFlg_bef, $viewFlg_aft){
            $sql = $this->db->prepare(  
                " update IMG_VIEW "
                . " set "
                . " VIEW_FLG = ? "
                . " where FILE_NAME = ? "
                . " and VIEW_FLG = ? ;"
                );
            
            $sql -> bindValue(1, $viewFlg_aft);
            $sql -> bindValue(2, $fileName);
            $sql -> bindValue(3, $viewFlg_bef);
            $sql -> execute();

        }

        //写真の登録
        public function insertImgList($fileName, $talentId, $filePath){
            $sql = $this->db->prepare(  
                " insert into IMG_LIST(FILE_NAME, TALENT_ID, FILE_PATH) "
                . " values (?, ?, ?); "
                );

            $sql2 = $this->db->prepare(
                " insert into IMG_VIEW(FILE_NAME, VIEW_FLG, PRIORITY) "
                . " values (?, '00', 0); ");

            if($this->isNullOrEmpty($talentId)){
                $talentId = null;
            }

            $sql -> bindValue(1, $fileName);
            $sql -> bindValue(2, $talentId);
            $sql -> bindValue(3, $filePath);
            $sql -> execute();

            $sql2 -> bindValue(1, $fileName);
            $sql2 -> execute();
        }

        /* EXE_ID = '13' */
        //経歴カテゴリを取得(ドロップダウンにいれる)
        public function getCareerCategory(){
            $sql = " select CAREER_CATEGORY_ID, CAREER_CATEGORY_NAME"
                    . " from M_CAREER_CATEGORY "
                    . " where DEL_FLG = '0';";
            
            return $row = $this->db->query($sql, PDO::FETCH_ASSOC);
        }

        //タレント経歴の登録
        public function insertTalentCareer($talentId, $categoryId, $content, $detail){
            $sql = $this->db->prepare(  
                " insert into TALENT_CAREER(TALENT_ID, CAREER_CATEGORY_ID, CONTENT, DETAIL) "
                . " values (?, ?, ?, ?); "
                );

            if($this->isNullOrEmpty($detail)){
                $detail = null;
            }
            $sql -> bindValue(1, $talentId);
            $sql -> bindValue(2, $categoryId);
            $sql -> bindValue(3, $content);
            $sql -> bindValue(4, $detail);
            $sql -> execute();

        }

        //タレント経歴取得
        public function getTalentCareer($talentId){
            $sql = $this->db->prepare("select mcr.CAREER_CATEGORY_ID CAREER_CATEGORY_ID, mcr.CAREER_CATEGORY_NAME CAREER_CATEGORY_NAME, cr.CONTENT CONTENT, cr.DETAIL DETAIL"
                            . " from TALENT t, TALENT_CAREER cr, M_CAREER_CATEGORY mcr "
                            . " where t.TALENT_ID = cr.TALENT_ID "
                            . " and cr.CAREER_CATEGORY_ID = mcr.CAREER_CATEGORY_ID "
                            . " and cr.TALENT_ID= ? ;");
            
            $sql -> bindValue(1, $talentId);
            $sql->execute();
            return $row = $sql->fetchall(PDO::FETCH_ASSOC);
        }

        //タレント経歴の削除
        public function deleteTalentCareer($talentId, $categoryId, $content){
            $sql = $this->db->prepare(  
                " delete from TALENT_CAREER "
                . " where TALENT_ID = ? "
                . " and CAREER_CATEGORY_ID = ? "
                . " and CONTENT = ? ;"
                );
            
            $sql -> bindValue(1, $talentId);
            $sql -> bindValue(2, $categoryId);
            $sql -> bindValue(3,  $content);
            $sql -> execute();

        }

        /* EXE_ID = '14' */
        //タレントに登録されているタグを取得するSQL
        public function getTalentTag(String $talentId){
            
            $sql = $this->db->prepare("select mtag.TAG_ID, mtag.TAG_NAME TAG_NAME, mtag.TAG_COLOR TAG_COLOR "
                            . " from TALENT t, TALENT_TAG tag, M_TAG mtag"
                            . "  where t.TALENT_ID = tag.TALENT_ID "
                            . "  and tag.TAG_ID = mtag.TAG_ID "
                            . "  and mtag.DEL_FLG = '0' "
                            . "  and tag.TALENT_ID= ? ;");
            // SQL文を実行
            $sql->bindValue(1, $talentId);
            $sql->execute();
            return $row = $sql->fetchall(PDO::FETCH_ASSOC);
        }

        //タレントに登録されていないタグを取得するSQL(プルダウンに設定)
        public function getTalentNotTag(String $talentId){
            
            $sql = $this->db->prepare("select TAG_ID, TAG_NAME,TAG_COLOR from M_TAG "
                . " where TAG_ID not in (select TAG_ID from TALENT_TAG where TALENT_ID= ? ); ");
            
            // SQL文を実行
            $sql->bindValue(1, $talentId);
            $sql->execute();
            return $row = $sql->fetchall(PDO::FETCH_ASSOC);
        }

        //タレント情報にタグを追加する
        public function insertTalentTag($talentId, $tagId){
            try{
            $sql = $this->db->prepare(  
                " insert into TALENT_TAG(TALENT_ID, TAG_ID) values( "
                    . " ?, "
                    . " ? "
                    . ");");

            $sql -> bindValue(1, $talentId);
            $sql -> bindValue(2, $tagId);
    
            $sql -> execute();
            return $sql -> rowCount();
            }catch(Exception $e){
                return "既にこのタグは登録済みです。変更してください。";
            }
        }

        //タグの新規登録
        public function insertMTag($tagName, $tagColor){
            $sql = $this->db->prepare(  
                " insert into M_TAG(TAG_NAME, TAG_COLOR) values (?, ?);");
            
            $sql -> bindValue(1, $tagName);
            $sql -> bindValue(2, $tagColor);
            $sql -> execute();

        }

        //タグの削除
        public function deleteTalentTag($talentId, $tagId){
            $sql = $this->db->prepare(  
                " delete from TALENT_TAG where TALENT_ID = ? and TAG_ID = ?;");
            
            $sql -> bindValue(1, $talentId);
            $sql -> bindValue(2, $tagId);
            $sql -> execute();

        }

        /* EXE_ID = '15' */
        //タレント削除（物理削除ではなく論理削除）
        //RETIREMENT_DATEとDEL_FLGを更新
        public function deleteTalent($retireDate, $talentId){
            //TALENT.
            $sql = $this->db->prepare(  
                " update TALENT "
                    . " set RETIREMENT_DATE = ? "
                    . ", UPD_DATE = CURRENT_TIMESTAMP() "
                    . ", DEL_FLG = '1' "
                    . " where TALENT_ID = ? ;");
            
            $sql -> bindValue(1, $retireDate);
            $sql -> bindValue(2, $talentId);
            $sql -> execute();

        }
    }
?>