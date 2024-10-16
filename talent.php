<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TALENT - COSPLATFORM</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <?php include 'header.php'; ?>

    <div class="container">
        <main>
            <section class="talent-page">
                <h1>TALENT</h1>
                <div class="talent-grid">
                    <?php
                        require_once('dbaccess.php'); 
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
        </main>
    </div>

    <?php include 'footer.php'; ?>

    <script src="script.js"></script>
</body>
</html>