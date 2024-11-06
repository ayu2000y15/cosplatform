<?php

    require_once('db.php'); 
    $obj = new DbController();
    $topImg = $obj->getTopImg('S202');
    $cosplayImg1 = $obj->getCosplayImg('S111');
    $cosplayImg2 = $obj->getCosplayImg(viewFlg: 'S112');

?>
<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>COSPLAY - COSPLATFORM</title>
    <link rel="stylesheet" href="style.css">
    <style>
    .subpage-hero {
        <?php foreach ($topImg as $row) {
            echo 'background-image: url("'. htmlspecialchars($row['FILE_PATH']) . htmlspecialchars($row['FILE_NAME']) . '");';
        }

        ?>
    }
    </style>
</head>

<body>
    <?php include 'header.php'; ?>

    <main>
        <section class="subpage-hero">
            <h1>COSPLAY</h1>
        </section>
        <div class="container">
            <div class="container-box">
                <section class="cosplay-page">
                    <div class="cosplay-content">
                        <h2>コスプレ衣装の販売・買取・レンタル</h2>
                        <div class="cosplay-content-box">
                            <p>弊社で製作しましたコスプレ衣装の販売・買取・レンタルを行っております。</p>
                            <p>あああああああああああああああああああああああああああ</p>
                        </div>
                    </div>
                    <div class="cosplay-grid">
                        <?php
                            
                            foreach ($cosplayImg1 as $row) {
                                echo '<div class="cosplay-item">';
                                echo '<img src="' . htmlspecialchars($row['FILE_PATH']) . htmlspecialchars($row['FILE_NAME']) . '" alt="' . htmlspecialchars($row['ALT']) . '">';
                                echo '</div>';
                            }
                        ?>
                    </div>

                    <div class="cosplay-content2">
                        <h2>コスプレ・衣装の制作</h2>
                        <div class="cosplay-content-box2">
                            <p>コスプレやアイドルの衣装やカフェなどのコスチューム制作</p>
                            <p>あああああああああああああああああああああああああああ</p>
                        </div>
                    </div>
                    <div class="cosplay-grid">
                        <?php
                            
                            foreach ($cosplayImg2 as $row) {
                                echo '<div class="cosplay-item">';
                                echo '<img src="' . htmlspecialchars($row['FILE_PATH']) . htmlspecialchars($row['FILE_NAME']) . '" alt="' . htmlspecialchars($row['ALT']) . '">';
                                echo '</div>';
                            }
                        ?>
                    </div>
                    <hr class="hr-line">
                    <img src="img/hp/logo1.png" alt="ロゴ" style="width:200px; height:200px; margin-left:4rem;">
                </section>
            </div>
        </div>
    </main>


    <?php include 'footer.php'; ?>

    <script src="script.js"></script>
</body>

</html>