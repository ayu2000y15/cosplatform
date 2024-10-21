<?php
    $slides = [
        ['title' => 'TOP/バナー 1', 'description' => '何か文字を入れる', 'filename' => 'img/hp/top1.jpg', 'alt' => 'スライド1'],
        ['title' => 'TOP/バナー 2', 'description' => 'コスプレイヤーの皆様へ', 'filename' => 'img/hp/top2.jpg', 'alt' => ''],
        ['title' => 'TOP/バナー 3', 'description' => '新しいイベント情報' , 'filename' => 'img/hp/top3.jpg', 'alt' => '']
    ];

    $connect_item = ['filename' => 'img/hp/top1.jpg', 'alt' => 'コスプレ'];
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
                    foreach ($slides as $index => $slide) {
                        echo '<div class="slide fade">';
                        echo '<img src="' . $slide['filename'] . '" alt="' . $slide['alt'] . '">';
                        echo '<div class="slide-content">';
                        echo '<h1>' . $slide['title'] . '</h1>';
                        echo '<p>' . $slide['description'] . '</p>';
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
                    for ($i = 0; $i < count($slides); $i++) {
                        echo '<span class="dot" onclick="currentSlide(' . ($i + 1) . ')"></span>';
                    }
                    ?>
                </div>
            </section>

            <section class="connect-image">
                <?php
                    echo '<img src="' . $connect_item['filename'] . '" alt="' . $connect_item['alt'] .'" class="full-width-image">'
                ?>
            </section>

            <section id="talent" class="container-box talent">
                <h2>TALENT</h2>
                <div class="talent-grid">
                    <?php
                        require_once('db.php'); 
                        $obj = new DbController();
                        $row = $obj->getTalentMain();

                        foreach ($row as $row) {
                            echo '<div class="talent-item-main">';
                            echo '<img src="img/' . $row['talent_img'] . '" alt="タレント ' . $row['layer_name'] . '">';
                            echo '<p>' . $row['layer_name'] . '</p>';
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
                        $row = $obj->getGalleryMain();

                        foreach ($row as $row) {
                            echo '<img src="img/' . $row['gallery_img'] . '" alt="コスプレ ' . $row['gallery_id'] . '">';
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