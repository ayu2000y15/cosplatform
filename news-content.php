<?php 

$newsId = (string)$_REQUEST['NEWS_ID'];

require_once('db.php'); 
$obj=new DbController(); 
$topImg = $obj->getTopImg('S205');
$news = $obj->getNewsContent($newsId);

?>
<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NEWS - COSPLATFORM</title>
    <link rel="stylesheet" href="style.css">
    <style>
    .subpage-hero {
        <?php foreach ($topImg as $row) {
            echo 'background-image: url("'. $row['FILE_PATH'] . $row['FILE_NAME'] . '");';
        }

        ?>
    }
    </style>
</head>

<body>
    <?php include 'header.php'; ?>

    <main>
        <section class="subpage-hero">
            <h1>NEWS</h1>
        </section>
        <div class="container">
            <div class="container-box news-page">
                <?php foreach ($news as $newsItem): ?>
                <div class="news-page-header">
                    <h2><?php echo htmlspecialchars($newsItem['TITLE']) ?></h2>
                    <div class="news-page-date">
                        <p><?php echo htmlspecialchars($newsItem['POST_DATE']) ?></p>
                    </div>
                </div>
                <hr class="hr-line">
                <p><?php echo htmlspecialchars($newsItem['CONTENT']) ?></p>
                <?php endforeach; ?>
            </div>
        </div>
    </main>
    <?php include 'footer.php'; ?>

    <script src="script.js"></script>

</body>

</html>