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
                            <div class="social-icons profile">
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
                            <h3 class="talent-name-en"><?php echo htmlspecialchars($talentInfo['LAYER_FURIGANA_EN']); ?>
                            </h3>
                            <hr class="hr-line">
                            <div class="talent-details">
                                <table>
                                    <?php if($talentInfo['BIRTHDAY_FLG'] ==='1') :?>
                                    <tr>
                                        <th>Birthday</th>
                                        <td><?php echo date('Y/n/j',strtotime($talentInfo['BIRTHDAY'])); ?></td>
                                    </tr>
                                    <?php endif; ?>
                                    <?php if($talentInfo['HEIGHT_FLG'] ==='1' || $talentInfo['THREE_SIZES_FLG'] ==='1') :?>
                                    <?php  
                                            $rowspan = 0;
                                            if($talentInfo['HEIGHT_FLG'] ==='1'){
                                                $rowspan++;
                                            }if($talentInfo['THREE_SIZES_FLG'] ==='1'){
                                                $rowspan++;
                                            }
                                        ?>
                                    <tr>
                                        <th rowspan="<?php echo $rowspan ?>">SIZE</th>
                                        <?php if($talentInfo['HEIGHT_FLG'] ==='1'):?>
                                        <td colspan="1">Height:<?php echo htmlspecialchars($talentInfo['HEIGHT']); ?>
                                        </td>
                                        <?php endif; ?>
                                    </tr>
                                    <?php if($talentInfo['THREE_SIZES_FLG'] ==='1'):?>
                                    <tr>
                                        <td colspan="1">B:<?php echo htmlspecialchars($talentInfo['THREE_SIZES_B']); ?>
                                            W:<?php echo htmlspecialchars($talentInfo['THREE_SIZES_W']); ?>
                                            H:<?php echo htmlspecialchars($talentInfo['THREE_SIZES_H']); ?>
                                        </td>
                                    </tr>
                                    <?php endif; ?>
                                    <?php endif; ?>
                                    <?php if($talentInfo['HOBBY_SPECIALTY_FLG'] ==='1'):?>
                                    <tr>
                                        <th>HOBBY / SPECIALTY</th>
                                        <td><?php echo htmlspecialchars($talentInfo['HOBBY_SPECIALTY']); ?></td>
                                    </tr>
                                    <?php endif; ?>
                                </table>
                            </div>
                            <div class="tag-container">
                                <?php
                                foreach ($talentTag as $row) {
                                    echo '<span class="tag" style="background-color: ' . htmlspecialchars($row['TAG_COLOR']) . ';">' . '#' . htmlspecialchars($row['TAG_NAME']) . '</span>';
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
                        <div class="career-categories">
                            <?php 
                            $count = 1;
                            foreach ($careerCategory as $items): 
                                if($count % 2 === 0) {
                                    echo '<div class="career-category2">';
                                }else{
                                    echo '<div class="career-category">';
                                }
                            ?>
                            <h3><?php echo htmlspecialchars($items['CAREER_CATEGORY_NAME']); ?></h3>
                            <hr class="hr-line">
                            <ul>
                                <?php foreach ($talentCareer as $item){
                                    if($items['CAREER_CATEGORY_NAME'] === $item['CAREER_CATEGORY_NAME']){
                                        echo '<li>' . htmlspecialchars($item['CONTENT']) . '</li>';
                                    }
                                }
                                ?>
                            </ul>
                            <?php 
                        echo '</div>';
                        $count++; 
                        endforeach;
                        ?>
                        </div>
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