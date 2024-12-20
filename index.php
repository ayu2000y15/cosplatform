<?php

    require_once('db.php');
    $obj = new DbController();
    $talent = $obj->getTopImgValue('01', 4);
    $cosplay = $obj->getTopImgValue('S203', 6);
    $slides = $obj->getSlideImg();
    $slidesCnt = $obj->getSlideCnt();
    $newsTitle = $obj->getNewsTitle();

    $topImg = $obj->getTopImg('S204');
    $backImg = $obj->getTopImg('S001');


?>
<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ホーム - COSPLATFORM</title>
    <link rel="stylesheet" href="style.css">
    <style>
        body {
            <?php foreach ($backImg as $row) {
                echo 'background-image: url("'. $row['FILE_PATH'] . $row['FILE_NAME'] . '");';
            }
            ?>
        }
    </style>
</head>

<body>
    <?php include 'header.php'; ?>

    <main>
        <div id="back">
            <section class="hero">
                <div class="slideshow-container">
                    <?php
                    foreach ($slides as $slide) {
                        echo '<div class="slide fade">';
                        echo '<div class="slide-image-container">';
                        echo '<img src="' . htmlspecialchars($slide['FILE_PATH']) . htmlspecialchars($slide['FILE_NAME']) . '" alt="' . htmlspecialchars($slide['ALT']) . '">';
                        echo '</div>';
                        echo '</div>';
                    }
                    ?>
                    <a class="prev" onclick="plusSlides(-1)">&#10094;</a>
                    <a class="next" onclick="plusSlides(1)">&#10095;</a>
                </div>
                <div class="dot-container">
                    <?php
                    for ($i = 0; $i < $slidesCnt; $i++) {
                        echo '<span class="dot" onclick="currentSlide(' . ($i + 1) . ')"></span>';
                    }
                    ?>
                </div>
            </section>

            <section class="connect-image">
                <?php
                foreach ($topImg as $row) {
                    echo '<img src="' . htmlspecialchars($row['FILE_PATH']) . htmlspecialchars($row['FILE_NAME']) . '" alt="' . htmlspecialchars($row['ALT']) . '" class="full-width-image">';
                }
                ?>
            </section>

            <section id="talent" class="container-box talent">
                <h2>TALENT</h2>
                <div class="section-content">
                    <div class="talent-list">
                        <div class="talent-grid-main">
                            <?php
                            foreach ($talent as $row) {
                                echo '<div class="talent-item-main">';
                                echo '<img style="background: linear-gradient(180deg, rgba(255, 255, 255, 1), rgba(216, 236, 255, 1) 100%, rgba(149, 233, 243, 1)); border-radius: 10px; padding:10px;" src="' . htmlspecialchars($row['FILE_PATH']) . htmlspecialchars($row['FILE_NAME']) . '" alt="タレント ' . htmlspecialchars($row['ALT']) . '">';
                                echo '<p>' . htmlspecialchars($row['LAYER_NAME']) . '</p>';
                                echo '</div>';
                            }
                            ?>
                        </div>
                    </div>
                    <div class="see-more">
                        <a href="talent.php" class="arrow-button" aria-label="タレント一覧をもっと見る">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round">
                                <line x1="5" y1="12" x2="19" y2="12"></line>
                                <polyline points="12 5 19 12 12 19"></polyline>
                            </svg>
                        </a>
                    </div>
                </div>
            </section>
        </div>
        <div id="top" class="container">
            <h2>COSPLAY</h2>
            <section id="cosplay" class="container-box cosplay">
                <div class="section-content">
                    <div class="cosplay-list">
                        <div class="cosplay-grid">
                            <?php
                            foreach ($cosplay as $row) {
                                echo '<img src="' . htmlspecialchars($row['FILE_PATH']) . htmlspecialchars($row['FILE_NAME']) . '" alt="コスプレ ' . htmlspecialchars($row['ALT']) . '">';
                            }
                            ?>
                        </div>
                        <p>コスプレイベントの様子や、撮影会の写真などがご覧いただけます。</p>
                    </div>
                    <div class="see-more">
                        <a href="cosplay.php" class="arrow-button" aria-label="コスプレ一覧をもっと見る">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round">
                                <line x1="5" y1="12" x2="19" y2="12"></line>
                                <polyline points="12 5 19 12 12 19"></polyline>
                            </svg>
                        </a>
                    </div>
                </div>
            </section>

            <h2>NEWS</h2>
            <section id="news" class="container-box news">
                <div class="section-content">
                    <div class="news-list">
                        <?php foreach ($newsTitle as $item) : ?>
                        <form method="post" name="<?php echo 'news' . $item['NEWS_ID'] ?>" action="news-content.php">
                            <a href="<?php echo 'javascript:news' . $item['NEWS_ID'] . '.submit()'?>">
                                <div class="news-item">
                                    <div class="news-content">
                                        <input type="hidden" name="NEWS_ID"
                                            value="<?php echo htmlspecialchars($item['NEWS_ID']); ?>">
                                        <p class="date"><?php echo htmlspecialchars($item['POST_DATE']) ?></p>
                                        <p class="title"><?php echo htmlspecialchars($item['TITLE']) ?></p>
                                    </div>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round">
                                        <polyline points="9 18 15 12 9 6"></polyline>
                                    </svg>
                                </div>
                            </a>
                        </form>
                        <?php endforeach; ?>
                    </div>
                    <!-- <div class="see-more">
                        <a href="news.php" class="arrow-button" aria-label="ニュース一覧をもっと見る">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round">
                                <line x1="5" y1="12" x2="19" y2="12"></line>
                                <polyline points="12 5 19 12 12 19"></polyline>
                            </svg>
                        </a>
                    </div> -->
                </div>
            </section>
        </div>
    </main>


    <?php include 'footer.php'; ?>

    <script src="script.js"></script>
</body>

</html>