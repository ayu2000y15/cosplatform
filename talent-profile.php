<?php
// ここでデータベースからタレント情報を取得すると仮定します
$talent = [
    'name' => '山田 花子',
    'name_en' => 'Hanako Yamada',
    'base' => 'Tokyo',
    'size' => 'Height:166cm B76cm W59cm H83cm Shoes:23.5cm',
    'hobby' => '散歩、カメラ',
    'image' => '/path/to/image.jpg',
    'social' => [
        'twitter' => '#',
        'instagram' => '#',
        'tiktok' => '#'
    ],
    'career' => [
        '雑誌' => [
            'マガジンハウス「GINZA」',
            'マガジンハウス「MEN\'S NON-NO」',
            'カエルム「NYLON」',
            '集英社「BAILA」「SPUR」'
        ],
        'WEB' => [
            'VOGUE GIRL',
            'NYLON.JP',
            'GINZA web',
            'FACETASM×蜷川実花「TOKYO SEQUENCE」',
            'TOGA'
        ],
        'CM / MV' => [
            '遠野美術株式会社「セブス・ハイ」',
            'サカママ「非道徳と走馬燈」'
        ]
    ]
];
?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TALENT - <?php echo htmlspecialchars($talent['name']); ?></title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h1 class="title">TALENT</h1>
        <div class="profile">
            <div class="profile-image">
                <img src="<?php echo htmlspecialchars($talent['image']); ?>" alt="<?php echo htmlspecialchars($talent['name']); ?>">
                <div class="social-links">
                    <a href="<?php echo htmlspecialchars($talent['social']['twitter']); ?>" class="social-icon twitter">
                        <span class="sr-only">Twitter</span>
                    </a>
                    <a href="<?php echo htmlspecialchars($talent['social']['instagram']); ?>" class="social-icon instagram">
                        <span class="sr-only">Instagram</span>
                    </a>
                    <a href="<?php echo htmlspecialchars($talent['social']['tiktok']); ?>" class="social-icon tiktok">
                        <span class="sr-only">TikTok</span>
                    </a>
                </div>
            </div>
            <div class="profile-info">
                <h2 class="talent-name"><?php echo htmlspecialchars($talent['name']); ?></h2>
                <p class="talent-name-en"><?php echo htmlspecialchars($talent['name_en']); ?></p>
                <div class="talent-details">
                    <p><strong>BASE:</strong> <?php echo htmlspecialchars($talent['base']); ?></p>
                    <p><strong>SIZE:</strong> <?php echo htmlspecialchars($talent['size']); ?></p>
                    <p><strong>HOBBY / SPECIALTY:</strong> <?php echo htmlspecialchars($talent['hobby']); ?></p>
                </div>
                <div class="action-buttons">
                    <button class="button">PHOTOS</button>
                    <button class="button">CAREER</button>
                </div>
                <div class="career-info">
                    <?php foreach ($talent['career'] as $category => $items): ?>
                        <div class="career-category">
                            <h3><?php echo htmlspecialchars($category); ?></h3>
                            <ul>
                                <?php foreach ($items as $item): ?>
                                    <li><?php echo htmlspecialchars($item); ?></li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>
</body>
</html>