<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>COSPLAY - COSPLATFORM</title>
    <link rel="stylesheet" href="style.css">
    <style>
        .subpage-hero {
            background-image: url('img/hp/top3.jpg');
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
                            require_once('db.php'); 
                            $obj = new DbController();
                            $row = $obj->getGalleryList();
                            
                            foreach ($row as $row) {
                                echo '<div class="cosplay-item">';
                                echo '<img src="img/' . $row['gallery_img'] . '" alt="コスプレ ' . $row['gallery_id'] . '">';
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