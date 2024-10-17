<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>COSPLAY - COSPLATFORM</title>
    <link rel="stylesheet" href="style.css">
    <style>
        .cosplay-hero {
            background-image: url('src/top3.jpg');
            background-size: cover;
            background-position: center;
            height: 400px;
            display: flex;
            align-items: flex-end;
            padding: 2rem;
        }
        .cosplay-hero h1 {
            color: white;
            font-size: 3rem;
            text-shadow: 2px 2px 4px rgba(0,0,0,0.5);
        }
    </style>
</head>
<body>
    <?php include 'header.php'; ?>

    <div class="container">
        <main>
        <section class="cosplay-hero">
                <h1>COSPLAY</h1>
            </section>
            <section class="cosplay-page">
                <div class="cosplay-grid">
                    <?php
                        require_once('db.php'); 
                        $obj = new DbController();
                        $row = $obj->getGalleryList();
                        
                        foreach ($row as $row) {
                            echo '<div class="cosplay-item">';
                            echo '<img src="src/' . $row['gallery_img'] . '" alt="コスプレ ' . $row['gallery_id'] . '">';
                            //echo '<h2>' . $row['layer_name'] . '</h2>';
                            //echo '<p>' . $row['comment'] . '</p>';
                            echo '</div>';
                        }
                    ?>
                </div>
            </section>
        </main>
    </div>

    <?php include 'footer.php'; ?>

    <script src="script.js"></script>
</body>
</html>