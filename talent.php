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
                    $talents = [
                        ['name' => 'スペシャルウィーク', 'description' => 'タレント1の簡単な紹介文がここに入ります。コスプレ歴や得意なジャンルなどを記載します。'],
                        ['name' => 'サイレンススズカ', 'description' => 'タレント2の簡単な紹介文がここに入ります。特徴的な衣装や人気のあるキャラクターなどを紹介します。'],
                        ['name' => 'トウカイテイオー', 'description' => 'タレント3の簡単な紹介文がここに入ります。SNSフォロワー数や過去の実績などを記載します。'],
                        ['name' => '名前 4', 'description' => 'タレント4の簡単な紹介文がここに入ります。得意な表現方法や魅力的なポイントを紹介します。'],
                        ['name' => '名前 5', 'description' => 'タレント5の簡単な紹介文がここに入ります。コスプレ以外の特技や趣味なども記載します。'],
                        ['name' => '名前 6', 'description' => 'タレント6の簡単な紹介文がここに入ります。今後の目標や挑戦したいコスプレなどを紹介します。']
                    ];
                    $counter = 0;
                    foreach ($talents as $talent) {
                        $counter++;
                        echo '<div class="talent-item">';
                        echo '<img src="src/talent' . $counter . '.png" alt="タレント ' . $talent['name'] . '">';
                        echo '<h2>' .   $talent['name'] . '</h2>';
                        echo '<p>' . $talent['description'] . '</p>';
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