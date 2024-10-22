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

        //TOPページのtalent写真取得するSQL
        //VIEW_FLG = '01'
        public function getTalentImgTop(){
            
            $sql = "select t.LAYER_NAME LAYER_NAME, img.FILE_NAME FILE_NAME, img.FILE_PATH FILE_PATH, vi.COMMENT ALT"
                    . " from TALENT t, IMG_LIST img, IMG_VIEW vi "
                    . " where t.TALENT_ID = img.TALENT_ID "
                    . " and img.FILE_NAME = vi.FILE_NAME "
                    . " and vi.VIEW_FLG = '01' "
                    . " order by vi.PRIORITY; ";

            // SQL文を実行
            return $row = $this->db->query($sql, PDO::FETCH_ASSOC);
        }

        //TOPページのcosplay写真取得するSQL
        //vi.VIEW_FLG = '02'
        public function getCosplayImgTop(){
            
            $sql = "select t.LAYER_NAME LAYER_NAME, img.FILE_NAME FILE_NAME ,img.FILE_PATH FILE_PATH, vi.COMMENT ALT"
                    . " from TALENT t, IMG_LIST img, IMG_VIEW vi "
                    . " where t.TALENT_ID = img.TALENT_ID "
                    . " and img.FILE_NAME = vi.FILE_NAME "
                    . " and vi.VIEW_FLG = '02' "
                    . " order by vi.PRIORITY; ";
            // SQL文を実行
            return $row = $this->db->query($sql, PDO::FETCH_ASSOC);
        }


        public function getTalentList(){
            //talentテーブルの一覧取得するSQL
            $sql = 'SELECT talent_img, layer_name, comment FROM talent where del_flg = 0';
            // SQL文を実行
            return $row = $this->db->query($sql, PDO::FETCH_ASSOC);
        }

        public function getGalleryList(){
            //galleryテーブルの一覧取得するSQL
            $sql = 'SELECT gallery_id, gallery_img FROM gallery where del_flg = 0';
            // SQL文を実行
            return $row = $this->db->query($sql, PDO::FETCH_ASSOC);
        }
    }
?>