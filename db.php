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

        public function getTalentMain(){
            //Mainページのtalentテーブル取得するSQL
            $sql = 'SELECT talent_img, layer_name FROM talent where del_flg = 0 LIMIT 4';
            // SQL文を実行
            return $row = $this->db->query($sql, PDO::FETCH_ASSOC);
        }

        public function getGalleryMain(){
            //Mainページのtalentテーブル取得するSQL
            $sql = 'SELECT gallery_id, gallery_img FROM gallery where del_flg = 0 LIMIT 7';
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