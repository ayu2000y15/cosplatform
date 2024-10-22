<?php

    require_once('db.php'); 
    $obj = new DbController();
    $topImg = $obj->getTopImg('202');

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
                            require_once('db.php'); 
                            $obj = new DbController();
                            $row = $obj->getTalentList();
                            
                            foreach ($row as $row) {
                                echo '<div class="talent-item">';
                                echo '<div class="image-container">';
                                echo '<img src="img/' . $row['talent_img'] . '" alt="タレント ' . $row['layer_name'] . '" class="main-image">';
                                echo '<img src="img/talent1.png" alt="タレント ' . $row['layer_name'] . '" class="hover-image">';            
                                echo '</div>';
                                echo '<h2>' .   $row['layer_name'] . '</h2>';
                                echo '<p>' . $row['comment'] . '</p>';
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

    <script>
        document.addEventListener('DOMContentLoaded', (event) => {
            const talentItems = document.querySelectorAll('.talent-item');
            talentItems.forEach(item => {
                const mainImage = item.querySelector('.main-image');
                const hoverImage = item.querySelector('.hover-image');
                
                // Preload hover image
                const img = new Image();
                img.src = hoverImage.src;
                
                item.addEventListener('mouseenter', () => {
                    mainImage.style.opacity = '0';
                    hoverImage.style.opacity = '1';
                });
                
                item.addEventListener('mouseleave', () => {
                    mainImage.style.opacity = '1';
                    hoverImage.style.opacity = '0';
                });
            });
        });
    </script>
</body>
</html>