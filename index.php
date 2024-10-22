<?php

    require_once('db.php'); 
    $obj = new DbController();
    $talent = $obj->getTalentImgTop();
    $cosplay = $obj->getCosplayImgTop();
    $slides = $obj->getSlideImg();
    $slidesCnt = $obj->getSlideCnt();
    $topImg = $obj->getTopImg('200');

?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ホーム - COSPLATFORM</title>
    <link rel="stylesheet" href="style.css">
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
                        echo '<img src="' . $slide['FILE_PATH'] . $slide['FILE_NAME'] . '" alt="' . $slide['ALT'] . '">';
                        echo '<div class="slide-content">';
                        echo '<h1>' . $slide['TITLE'] . '</h1>';
                        echo '<p>' . $slide['DISCRIPTION'] . '</p>';
                        //echo '<button>詳細を見る</button>';
                        echo '</div>';
                        echo '</div>';
                    }
                    ?>
                    <a class="prev" onclick="plusSlides(-1)">&#10094;</a>
                    <a class="next" onclick="plusSlides(1)">&#10095;</a>
                </div>
                <div class="dot-container">
                    <?php
                    for ($i = 0; $i < 3; $i++) {
                        echo '<span class="dot" onclick="currentSlide(' . ($i + 1) . ')"></span>';
                    }
                    ?>
                </div>
            </section>

            <section class="connect-image">
                <?php
                foreach ($topImg as $row) {
                    echo '<img src="' . $row['FILE_PATH'] . $row['FILE_NAME'] . '" alt="' . $row['ALT'] .'" class="full-width-image">';
                }
                ?>
            </section>

            <section id="talent" class="container-box talent">
                <h2>TALENT</h2>
                <div class="talent-grid">
                    <?php

                        foreach ($talent as $row) {
                            echo '<div class="talent-item-main">';
                            echo '<img src="' . $row['FILE_PATH'] . $row['FILE_NAME'] . '" alt="タレント ' . $row['ALT'] . '">';
                            echo '<p>' . $row['LAYER_NAME'] . '</p>';
                            echo '</div>';
                        }
                    ?>
                    <div class="see-more">
                        <a href="talent.php" class="arrow-button" aria-label="タレント一覧をもっと見る">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <line x1="5" y1="12" x2="19" y2="12"></line>
                                <polyline points="12 5 19 12 12 19"></polyline>
                            </svg>
                        </a>
                    </div>
                </div>
            </section>
        </div>
        <div class="container">
            <section id="cosplay" class="container-box cosplay">
                <h2>COSPLAY</h2>
                <div class="cosplay-grid">
                    <?php
                        foreach ($cosplay as $row) {
                            echo '<img src="' . $row['FILE_PATH'] . $row['FILE_NAME'] . '" alt="コスプレ ' . $row['ALT'] . '">';
                        }
                    ?>
                    <div class="see-more">
                        <a href="cosplay.php" class="arrow-button" aria-label="コスプレ一覧をもっと見る">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <line x1="5" y1="12" x2="19" y2="12"></line>
                                <polyline points="12 5 19 12 12 19"></polyline>
                            </svg>
                        </a>
                    </div>
                </div>
                <p>コスプレイベントの様子や、撮影会の写真などがご覧いただけます。</p>
            </section>

            <section id="news" class="container-box">
                <h2>NEWS</h2>
                <div class="news-list">
                    <?php
                    $news_items = [
                        ['date' => '2024.10.11', 'title' => 'ニュースタイトル 1'],
                        ['date' => '2024.10.12', 'title' => 'ニュースタイトル 2'],
                        ['date' => '2024.10.13', 'title' => 'ニュースタイトル 3']
                    ];
                    foreach ($news_items as $item) {
                        echo '<div class="news-item">';
                        echo '<div>';
                        echo '<p class="date">' . $item['date'] . '</p>';
                        echo '<p class="title">' . $item['title'] . '</p>';
                        echo '</div>';
                        echo '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="9 18 15 12 9 6"></polyline></svg>';
                        echo '</div>';
                    }
                ?>
                </div>
            </section>
        </div>
    </main>
    

    <?php include 'footer.php'; ?>

    <script src="script.js"></script>
</body>
</html>