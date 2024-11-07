<?php 
    $talentId = (string)$_REQUEST['TALENT_ID'];

    require_once('db.php'); 
    $obj=new DbController(); 
    $topImg=$obj->getTopImg('S103');
    $talentProfile = $obj->getTalentProfile('01',$talentId);
    $talentImg = $obj->getTalentProfile('03',$talentId);
    $talentTag = $obj->getTalentTag($talentId);
    $careerCategory = $obj->getCareerCategory($talentId);
    $talentCareer = $obj->getTalentCareer($talentId);
    $backImg = $obj->getTopImg('S003');
?>
<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TALENT - COSPLATFORM</title>
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
                                <?php if($talentInfo['SNS_1_FLG'] ==='1') :?>
                                <a href="<?php echo htmlspecialchars($talentInfo['SNS_1']); ?>"
                                    aria-label="X (Twitter)">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round">
                                        <path d="M4 4l11.733 16h4.267l-11.733 -16z" />
                                        <path d="M4 20l6.768 -6.768m2.46 -2.46l6.772 -6.772" />
                                    </svg>
                                </a>
                                <?php endif; ?>
                                <?php if($talentInfo['SNS_2_FLG'] ==='1') :?>
                                <a href="<?php echo htmlspecialchars($talentInfo['SNS_2']); ?>"
                                    aria-label="Instagram">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round">
                                        <rect width="20" height="20" x="2" y="2" rx="5" ry="5"></rect>
                                        <path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"></path>
                                        <line x1="17.5" x2="17.51" y1="6.5" y2="6.5"></line>
                                    </svg>
                                </a>
                                <?php endif; ?>
                                <?php if($talentInfo['SNS_3_FLG'] ==='1') :?>
                                <a href="<?php echo htmlspecialchars($talentInfo['SNS_3']); ?>"
                                    aria-label="TikTok">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round">
                                        <path d="M9 12a4 4 0 1 0 4 4V4a5 5 0 0 0 5 5"></path>
                                    </svg>
                                </a>
                                <?php endif; ?>
                            </div>
                            <h2 class="talent-name"><?php echo htmlspecialchars($talentInfo['LAYER_NAME']); ?></h2>
                            <h3 class="talent-name-en"><?php echo htmlspecialchars($talentInfo['LAYER_FURIGANA_EN']); ?>
                            </h3>
                            <hr class="hr-line">
                            <div class="talent-details">
                                <table>
                                    <?php if($talentInfo['BIRTHDAY_FLG'] ==='1') :?>
                                    <tr>
                                        <th>BIRTHDAY</th>
                                        <td><?php echo date('Y/n/j',strtotime($talentInfo['BIRTHDAY'])); ?></td>
                                    </tr>
                                    <?php endif; ?>
                                    <?php if($talentInfo['FOLLOWERS_FLG'] ==='1') :?>
                                    <tr>
                                        <th>FOLLOWERS</th>
                                        <td><?php echo htmlspecialchars($talentInfo['FOLLOWERS']); ?></td>
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
                                        <th rowspan="<?php echo $rowspan+1 ?>">SIZE</th>
                                        <td style="display: none;"></td>
                                    </tr>
                                    <?php if($talentInfo['HEIGHT_FLG'] ==='1'):?>
                                        <tr>
                                            <td colspan="1">Height:<?php echo htmlspecialchars($talentInfo['HEIGHT']); ?>
                                            </td>
                                        </tr>
                                    <?php endif; ?>
                                    <?php if($talentInfo['THREE_SIZES_FLG'] ==='1'):?>
                                    <tr>
                                        <td colspan="1">
                                            <?php if($talentInfo['THREE_SIZES_B_FLG'] ==='1'):?>
                                            B:<?php echo htmlspecialchars($talentInfo['THREE_SIZES_B']); ?>
                                            <?php endif; ?>
                                            <?php if($talentInfo['THREE_SIZES_W_FLG'] ==='1'):?>
                                            W:<?php echo htmlspecialchars($talentInfo['THREE_SIZES_W']); ?>
                                            <?php endif; ?>
                                            <?php if($talentInfo['THREE_SIZES_H_FLG'] ==='1'):?>
                                            H:<?php echo htmlspecialchars($talentInfo['THREE_SIZES_H']); ?>
                                            <?php endif; ?>
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
                                    <?php if($talentInfo['COMMENT_FLG'] ==='1'):?>
                                    <tr>
                                        <th>COMMENT</th>
                                        <td><?php echo htmlspecialchars($talentInfo['TALENT_COMMENT']); ?></td>
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
                        <div class="photos-slider-container">
                            <button class="slider-arrow prev-arrow" aria-label="前の画像へ">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round">
                                    <path d="M15 18l-6-6 6-6" />
                                </svg>
                            </button>
                            <div class="photos-grid">
                                <?php 
                            foreach ($talentImg as $row) {
                                echo '<div class="photo-item" tabindex="0" >';
                                echo '<img src="' . htmlspecialchars($row['FILE_PATH'] . $row['FILE_NAME']) . '" alt="' . htmlspecialchars($row['ALT']) . '" loading="lazy">';
                                echo '</div>';
                            }
                            ?>
                            </div>
                            <button class="slider-arrow next-arrow" aria-label="次の画像へ">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round">
                                    <path d="M9 18l6-6-6-6" />
                                </svg>
                            </button>
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
        <div class="preview-overlay">
            <img src="" alt="" class="preview-image">
            <span class="close-preview">&times;</span>
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
        const sliderContainer = document.querySelector('.photos-slider-container');
        const photosGrid = document.querySelector('.photos-grid');
        const prevArrow = document.querySelector('.prev-arrow');
        const nextArrow = document.querySelector('.next-arrow');
        const photoItems = document.querySelectorAll('.photo-item');
        const previewOverlay = document.querySelector('.preview-overlay');
        const previewImage = document.querySelector('.preview-image');
        const closePreview = document.querySelector('.close-preview');

        let currentPosition = 0;
        let startX = 0;
        let scrollLeft = 0;
        let isDragging = false;
        let lastTouchX = 0;
        let currentTouchX = 0;
        let touchStartTime = 0;

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
            updateSliderLayout();
        });

        // プレビュー機能
        photoItems.forEach(item => {
            item.addEventListener('click', function() {
                const img = this.querySelector('img');
                previewImage.src = img.src;
                previewImage.alt = img.alt;
                previewOverlay.style.display = 'flex';
            });

            item.addEventListener('keydown', function(e) {
                if (e.key === 'Enter' || e.key === ' ') {
                    e.preventDefault();
                    this.click();
                }
            });
        });

        closePreview.addEventListener('click', function() {
            previewOverlay.style.display = 'none';
        });

        previewOverlay.addEventListener('click', function(e) {
            if (e.target === this) {
                this.style.display = 'none';
            }
        });

        function getVisibleSlides() {
            if (window.innerWidth >= 1024) return 4;
            if (window.innerWidth >= 768) return 3;
            if (window.innerWidth >= 640) return 2;
            return 1;
        }

        function updateSliderLayout() {
            const visibleSlides = getVisibleSlides();
            const slideWidth = 100 / visibleSlides;
            photoItems.forEach(item => {
                item.style.flex = `0 0 ${slideWidth}%`;
                item.style.maxWidth = `${slideWidth}%`;
            });
            currentPosition = 0;
            updateSlidePosition();
            updateArrowVisibility();
        }

        function updateSlidePosition() {
            photosGrid.style.transform = `translateX(-${currentPosition}%)`;
        }

        function moveSlider(direction) {
            const slideWidth = 100 / getVisibleSlides();
            const maxPosition = (photoItems.length - getVisibleSlides()) * slideWidth;
            currentPosition = Math.max(0, Math.min(currentPosition + direction * slideWidth, maxPosition));
            updateSlidePosition();
            updateArrowVisibility();
        }

        function updateArrowVisibility() {
            const maxPosition = (photoItems.length - getVisibleSlides()) * (100 / getVisibleSlides());
            prevArrow.style.display = currentPosition <= 0 ? 'none' : 'flex';
            nextArrow.style.display = currentPosition >= maxPosition ? 'none' : 'flex';
        }

        prevArrow.addEventListener('click', () => moveSlider(-1));
        nextArrow.addEventListener('click', () => moveSlider(1));

        // タッチイベントの処理
        function handleTouchStart(e) {
            isDragging = true;
            startX = e.touches[0].pageX - sliderContainer.offsetLeft;
            scrollLeft = currentPosition;
            lastTouchX = e.touches[0].pageX;
            touchStartTime = Date.now();
            photosGrid.style.transition = 'none';
        }

        function handleTouchMove(e) {
            if (!isDragging) return;
            e.preventDefault();

            currentTouchX = e.touches[0].pageX;
            const touchDelta = lastTouchX - currentTouchX;
            lastTouchX = currentTouchX;

            const containerWidth = sliderContainer.offsetWidth;
            const movePercent = (touchDelta / containerWidth) * 100;

            currentPosition = Math.max(0, Math.min(currentPosition + movePercent, getMaxPosition()));
            updateSlidePosition();
        }

        function handleTouchEnd(e) {
            if (!isDragging) return;
            isDragging = false;
            photosGrid.style.transition = 'transform 0.3s ease';

            const touchEndTime = Date.now();
            const touchDuration = touchEndTime - touchStartTime;
            const touchDistance = currentTouchX - startX;
            const velocity = Math.abs(touchDistance) / touchDuration;

            if (velocity > 0.5) {
                const direction = touchDistance < 0 ? 1 : -1;
                moveToNextSlide(direction);
            } else {
                snapToNearestSlide();
            }

            updateArrowVisibility();
        }

        function moveToNextSlide(direction) {
            const slideWidth = 100 / getVisibleSlides();
            currentPosition += direction * slideWidth;
            currentPosition = Math.max(0, Math.min(currentPosition, getMaxPosition()));
            updateSlidePosition();
        }

        function snapToNearestSlide() {
            const slideWidth = 100 / getVisibleSlides();
            const nearestSlide = Math.round(currentPosition / slideWidth);
            currentPosition = nearestSlide * slideWidth;
            updateSlidePosition();
        }

        function getMaxPosition() {
            return (photoItems.length - getVisibleSlides()) * (100 / getVisibleSlides());
        }

        sliderContainer.addEventListener('touchstart', handleTouchStart, {
            passive: false
        });
        sliderContainer.addEventListener('touchmove', handleTouchMove, {
            passive: false
        });
        sliderContainer.addEventListener('touchend', handleTouchEnd);

        window.addEventListener('resize', () => {
            currentPosition = 0;
            updateSliderLayout();
        });

        updateSliderLayout();
    });
    </script>
</body>

</html>