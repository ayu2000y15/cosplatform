<?php
// ここでデータベースからタレント情報を取得すると仮定します
$talent = [
    'name' => '山田 花子',
    'name_en' => 'Hanako Yamada',
    'base' => 'Tokyo',
    'size' => 'Height:166cm B76cm W59cm H83cm Shoes:23.5cm',
    'hobby' => '散歩、カメラ',
    'image' => 'img/talent1.png',
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

<?php 

$talentId = (string)$_REQUEST['TALENT_ID'];

require_once('db.php'); 
$obj=new DbController(); 
$topImg=$obj->getTopImg('201');
$talentProfile = $obj->getTalentProfile('03',$talentId);
$talentImg = $obj->getTalentProfile('23',$talentId);
$talentTag = $obj->getTalentTag($talentId);
$careerCategory = $obj->getCareerCategory($talentId);
$talentCareer = $obj->getTalentCareer($talentId);

?>
<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TALENT - COSPLATFORM</title>
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
            <h1>TALENT</h1>
        </section>
        <div class="container">
            <div class="container-box profile">
                <section class="profile-page center-content">
                    <div class="profile-content">
                        <?php foreach ($talentProfile as $talentInfo): ?>
                        <div class="profile-image">
                            <img src="<?php echo htmlspecialchars($talentInfo['FILE_PATH'] . $talentInfo['FILE_NAME']); ?>"
                                alt="<?php echo htmlspecialchars($talentInfo['LAYER_NAME']); ?>">
                        </div>
                        <div class="profile-info">
                            <div class="social-icons">
                                <a href="<?php echo htmlspecialchars($talentInfo['SNS_1']); ?>"
                                    aria-label="X (Twitter)">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round">
                                        <path d="M4 4l11.733 16h4.267l-11.733 -16z" />
                                        <path d="M4 20l6.768 -6.768m2.46 -2.46l6.772 -6.772" />
                                    </svg>
                                </a>
                                <a href="<?php echo htmlspecialchars($talentInfo['SNS_2']); ?>" aria-label="Instagram">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round">
                                        <rect width="20" height="20" x="2" y="2" rx="5" ry="5"></rect>
                                        <path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"></path>
                                        <line x1="17.5" x2="17.51" y1="6.5" y2="6.5"></line>
                                    </svg>
                                </a>
                                <a href="<?php echo htmlspecialchars($talentInfo['SNS_3']); ?>" aria-label="TikTok">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round">
                                        <path d="M9 12a4 4 0 1 0 4 4V4a5 5 0 0 0 5 5"></path>
                                    </svg>
                                </a>
                            </div>
                            <h2 class="talent-name"><?php echo htmlspecialchars($talentInfo['LAYER_NAME']); ?></h2>
                            <p class="talent-name-en"><?php echo htmlspecialchars($talentInfo['LAYER_FURIGANA_EN']); ?>
                            </p>
                            <hr class="hr-line">
                            <div class="talent-details">
                                <table>
                                    <tr>
                                        <th>Birthday</th>
                                        <td><?php echo htmlspecialchars($talentInfo['BIRTHDAY']); ?></td>
                                    </tr>
                                    <tr>
                                        <th>SIZE</th>
                                        <td>Height:<?php echo htmlspecialchars($talentInfo['HEIGHT']); ?></td>
                                        <td>B:<?php echo htmlspecialchars($talentInfo['THREE_SIZES_B']); ?>
                                            W:<?php echo htmlspecialchars($talentInfo['THREE_SIZES_W']); ?>
                                            H:<?php echo htmlspecialchars($talentInfo['THREE_SIZES_H']); ?></td>
                                    </tr>
                                    <tr>
                                        <th>HOBBY / SPECIALTY</th>
                                        <td><?php echo htmlspecialchars($talentInfo['HOBBY_SPECIALTY']); ?></td>
                                    </tr>
                                </table>
                            </div>
                            <div class="tag">
                            <?php
                            foreach ($talentTag as $row) {
                                echo '<p>' . '#' . htmlspecialchars($row['TAG_NAME']) . '</p>';
                            }
                            ?>
                            </div>
                        </div>
                        <?php endforeach; ?>
                    </div>
                    <div class="action-buttons">
                        <button class="button photos-button">PHOTOS</button>
                        <button class="button career-button">CAREER</button>
                    </div>
                    <div class="photos-info" style="display: none;">
                        <div class="photos-grid">
                            <?php 
                            foreach ($talentImg as $row) {
                                echo '<img src="' . htmlspecialchars($row['FILE_PATH'] . $row['FILE_NAME']) . '" alt="' . htmlspecialchars($row['ALT']) . '">';
                            }
                            ?>
                        </div>
                    </div>
                    <div class="career-info" style="display: none;">
                        <?php foreach ($careerCategory as $items): ?>
                        <div class="career-category">
                            <h3><?php echo htmlspecialchars($items['CAREER_CATEGORY_NAME']); ?></h3>
                            <ul>
                                <?php foreach ($talentCareer as $item){
                                    if($items['CAREER_CATEGORY_NAME'] === $item['CAREER_CATEGORY_NAME']){
                                        echo '<li>' . htmlspecialchars($item['CONTENT']) . '</li>';
                                    }
                                }
                                ?>
                            </ul>
                        </div>
                        <?php endforeach; ?>
                    </div>
                </section>
            </div>
        </div>
    </main>
    <?php include 'footer.php'; ?>

    <script src="script.js"></script>
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        const careerButton = document.querySelector('.career-button');
        const photosButton = document.querySelector('.photos-button');
        const careerInfo = document.querySelector('.career-info');
        const photosInfo = document.querySelector('.photos-info');

        function hideAllSections() {
            careerInfo.style.display = 'none';
            photosInfo.style.display = 'none';
            careerButton.classList.remove('active');
            photosButton.classList.remove('active');
        }

        careerButton.addEventListener('click', function() {
            hideAllSections();
            careerInfo.style.display = 'block';
            careerButton.classList.add('active');
        });

        photosButton.addEventListener('click', function() {
            hideAllSections();
            photosInfo.style.display = 'block';
            photosButton.classList.add('active');
        });
    });
    </script>
</body>

</html>