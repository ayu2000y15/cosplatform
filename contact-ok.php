<?php

    require_once('db.php'); 
    $obj = new DbController();
    $topImg = $obj->getTopImg('S105');
    $backImg = $obj->getTopImg('S005');

?>
<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CONTACT - COSPLATFORM</title>
    <link rel="stylesheet" href="style.css">
    <style>
        body {
            <?php foreach ($backImg as $row) {
                echo 'background-image: url("'. $row['FILE_PATH'] . $row['FILE_NAME'] . '");';
            }
            ?>
        }

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
            <h1>CONTACT</h1>
        </section>
        <div class="container">
            <div class="container-box contact">
                <p>送信が完了しました。</p>
                <p>返答をお待ちください。</p>
            </div>
        </div>
    </main>

    <?php include 'footer.php'; ?>

    <script src="script.js"></script>
</body>

</html>