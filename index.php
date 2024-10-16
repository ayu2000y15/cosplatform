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

    <div class="container">
        <main>
            <section class="hero">
                <div class="slideshow-container">
                    <?php
                    $slides = [
                        ['title' => 'TOP/バナー 1', 'description' => '(仮装、夢見ゴスプレ/原宿～3Dフォトブース)'],
                        ['title' => 'TOP/バナー 2', 'description' => 'コスプレイヤーの皆様へ'],
                        ['title' => 'TOP/バナー 3', 'description' => '新しいイベント情報']
                    ];
                    foreach ($slides as $index => $slide) {
                        echo '<div class="slide fade">';
                        echo '<img src="src/top' . ($index + 1) . '.jpg" alt="スライド ' . ($index + 1) . '">';
                        echo '<div class="slide-content">';
                        echo '<h1>' . $slide['title'] . '</h1>';
                        echo '<p>' . $slide['description'] . '</p>';
                        echo '<button>詳細を見る</button>';
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

            <section class="connect">
                <h2>コスプレで<br>世界と<br>コネクト</h2>
                <p>日本発のコスプレコミュニティーを広げていくサービス。アニメ、マンガ、ゲームなどの作品が好きな人たちが、コスプレを通じて繋がっていく。</p>
            </section>

            <section id="talent" class="talent">
                <h2>TALENT</h2>
                <div class="talent-grid">
                    <?php
                    $talents = [
                        ['name' => 'スペシャルウィーク'],
                        ['name' => 'サイレンススズカ'],
                        ['name' => 'トウカイテイオー'],
                        ['name' => '名前 4']
                    ];
                    $counter = 0;
                    foreach ($talents as $talent) {
                        $counter++;
                        echo '<div class="talent-item">';
                        echo '<img src="src/talent' . $counter . '.png" alt="タレント ' . $talent['name'] . '">';
                        echo '<p>' . $talent['name'] . '</p>';
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

            <section id="cosplay" class="cosplay">
                <h2>COSPLAY</h2>
                <div class="cosplay-grid">
                    <?php
                    for ($i = 1; $i <= 6; $i++) {
                        echo '<img src="src/cos' . $i . '.png" alt="コスプレ ' . $i . '">';
                    }
                    ?>
                </div>
                <p>コスプレイベントの様子や、撮影会の写真などがご覧いただけます。</p>
            </section>

            <section id="news" class="news">
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
        </main>
    </div>

    <?php include 'footer.php'; ?>

    <script src="script.js"></script>
</body>
</html>