<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TALENT - COSPLATFORM</title>
    <link rel="stylesheet" href="style.css">
    <style>
        .subpage-hero {
            background-image: url('src/top3.jpg');
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
                                echo '<img src="src/' . $row['talent_img'] . '" alt="タレント ' . $row['layer_name'] . '">';
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
</body>
</html>