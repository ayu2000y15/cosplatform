<?php

    require_once('db.php'); 
    $obj = new DbController();
    $topImg = $obj->getTopImg('201');
    $talentImg = $obj->getTalentImg();
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TALENT - COSPLATFORM</title>
    <link rel="stylesheet" href="style.css">
    <style>
        .subpage-hero {
            <?php
            foreach ($topImg as $row) {
                echo 'background-image: url("' . $row['FILE_PATH'] . $row['FILE_NAME'] . '");';
            }
            ?>
        }
    </style>
</head>
<body>
    <?php include 'header.php'; ?>

    <main>
        <section class="subpage-hero">
            <h1>TALENT</h1>
        </section>
        <div class="container">
            <div class="container-box">
                <section class="talent-page">
                    <div class="talent-grid">
                        <?php
                            
                            foreach ($talentImg as $row) {
                                
                                echo '<div class="talent-item">';
                                echo '<a href="#" target="_blank">';
                                echo '<img src="' . $row['FILE_PATH1'] . $row['FILE_NAME1'] . '" onmouseover="this.src=\'' . $row['FILE_PATH2'] . $row['FILE_NAME2'] . '\'" onmouseout="this.src=\'' . $row['FILE_PATH1'] . $row['FILE_NAME1'] . '\'">';
                                echo '</a>';
                                echo '<h2>' . $row['LAYER_NAME'] . '</h2>';
                                echo '</div>';
                                
                            }
                        ?>
                    </div>
                </section>
            </div>
        </div>
    </main>
    

    <?php include 'footer.php'; ?>

    <script src="script.js"></script>
</body>
</html>