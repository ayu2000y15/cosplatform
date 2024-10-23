<?php

    require_once('db.php'); 
    $obj = new DbController();
    $topImg = $obj->getTopImg('202');
    $cosplayImg = $obj->getCosplayImg();
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
                    <div class="cosplay-grid">
                        <?php
                            
                            foreach ($cosplayImg as $row) {
                                echo '<div class="cosplay-item">';
                                echo '<img src="' . htmlspecialchars($row['FILE_PATH']) . htmlspecialchars($row['FILE_NAME']) . '" alt="' . htmlspecialchars($row['ALT']) . '">';
                                //echo '<h2>' . $row['layer_name'] . '</h2>';
                                //echo '<p>' . $row['comment'] . '</p>';
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