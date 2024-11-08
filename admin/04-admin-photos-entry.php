<?php

    require_once('admin-db.php'); 
    $obj = new DbController();
    $imgList = $obj->getHpImg();
    $talentImgList = $obj->getTalentImgList();
?>

<!DOCTYPE html>
<html lang="ja">

<head>
    <link rel="stylesheet" href="admin-style.css">
    <link rel="stylesheet" href="talent-photos.css">
</head>

<body>
    <main>
        <script src="admin-script.js"></script>
        <div class="form-area">
            <h2>HP画像登録・変更</h2>
            <div class="action-buttons">
                <button class="button photos-button" active>タレント以外</button>
                <button class="button talent-button">TOPページのタレント</button>
            </div>
            <div class="photos-info">
                <!-- 写真登録 -->
                <div class="photo-upload-section">
                    <h3 class="subsection-title">◆写真新規登録</h3>
                    <p>※最大5Mまで。それ以上大きいファイルはアップロードできません。</p>
                    <form onsubmit="return checkSubmit('登録');" action="00-admin.php" method="POST"
                        enctype="multipart/form-data" class="upload-form">
                        <input type="hidden" name="EXE_ID" value="04_1">
                        <input type="hidden" name="active_tab" value="photos-entry">

                        <div class="file-upload-wrapper">
                            <input type="file" name="upfile[]" id="photo-upload" class="file-upload-input" multiple
                                onchange="updateFileNames(this)">
                            <label for="photo-upload" class="file-upload-label">写真を選択</label>
                        </div>
                        <div id="selected-files" class="selected-files"></div>
                        <button type="submit" class="submit-button">アップロード</button>
                    </form>
                </div>

                <hr class="hr-line">
                <!-- 写真一覧 -->
                <div class="photo-list-section">
                    <h3 class="subsection-title">◆登録済みの写真一覧</h3>
                    <p>TOPページのCOSPLAYは6枚まで設定可/p>
                    <div class="photo-grid">
                        <?php foreach ($imgList as $img): ?>
                        <div class="photo-item">
                            <img class="photo-thumbnail"
                                src="../<?php echo htmlspecialchars($img['FILE_PATH'] . $img['FILE_NAME']) ?>"
                                alt="<?php echo htmlspecialchars($img['COMMENT']) ?>"
                                onclick="openImagePreview(this.src)">
                            <div class="photo-actions">
                                <form onsubmit="return checkSubmit('変更');" action="00-admin.php" method="POST"
                                    class="change-form">
                                    <input type="hidden" name="EXE_ID" value="04_2">
                                    <input type="hidden" name="active_tab" value="photos-entry">
                                    <input type="hidden" name="FILE_NAME"
                                        value="<?php echo htmlspecialchars($img['FILE_NAME']);  ?>">
                                    <input type="hidden" name="VIEW_FLG_BEF"
                                        value="<?php echo htmlspecialchars($img['VIEW_FLG']);  ?>">

                                    <div class="select-wrapper">
                                        <label>優先度(数字が若いほど優先度高)
                                            <input type="number" name="PRIORITY"
                                                value="<?php echo htmlspecialchars($img['PRIORITY']);  ?>">
                                        </label>
                                        <select name="VIEW_FLG_AFT" class="view-select">
                                            <?php $selectList = $obj->getHpViewFlg(); foreach ($selectList as $select): ?>
                                            <option value="<?php echo $select['VIEW_FLG']; ?>"
                                                <?php echo ($select['VIEW_FLG'] == $img['VIEW_FLG']) ? 'selected' : ''; ?>>
                                                <?php echo $select['COMMENT']; ?>
                                            </option>
                                            <?php endforeach; ?>
                                        </select>
                                        <button type="submit" class="change-button">変更</button>
                                    </div>
                                </form>
                                <form onsubmit="return checkSubmit('削除');" action="00-admin.php" method="POST"
                                    class="delete-form">
                                    <input type="hidden" name="EXE_ID" value="04_3">
                                    <input type="hidden" name="active_tab" value="photos-entry">
                                    <input type="hidden" name="FILE_NAME"
                                        value="<?php echo htmlspecialchars($img['FILE_NAME']);  ?>">
                                    <input type="hidden" name="VIEW_FLG"
                                        value="<?php echo htmlspecialchars($img['VIEW_FLG']);  ?>">
                                    <button type="submit" class="delete-button">削除</button>
                                </form>
                            </div>
                        </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>

            <div class="talent-info" style="display: none;">
                <h3>TOPページのタレント選択</h3>
                <p>※1~4の数字を入れて登録ボタンを押下してください。</p>
                <div class="photo-grid">
                    <?php foreach ($talentImgList as $img): ?>
                    <div class="photo-item">
                        <img class="photo-thumbnail"
                            src="../<?php echo htmlspecialchars($img['FILE_PATH'] . $img['FILE_NAME']) ?>"
                            alt="<?php echo htmlspecialchars($img['COMMENT']) ?>" onclick="openImagePreview(this.src)">
                        <div class="photo-actions">
                            <form onsubmit="return checkSubmit('登録');" action="00-admin.php" method="POST"
                                class="change-form">
                                <input type="hidden" name="EXE_ID" value="04_2">
                                <input type="hidden" name="active_tab" value="photos-entry">
                                <input type="hidden" name="FILE_NAME"
                                    value="<?php echo htmlspecialchars($img['FILE_NAME']);  ?>">
                                <input type="hidden" name="VIEW_FLG_BEF"
                                    value="<?php echo htmlspecialchars($img['VIEW_FLG']);  ?>">
                                <input type="hidden" name="VIEW_FLG_AFT"
                                    value="<?php echo htmlspecialchars($img['VIEW_FLG']);  ?>">

                                <div class="select-wrapper">
                                    <label><?php echo htmlspecialchars($img['LAYER_NAME']);  ?></label>
                                    <label>優先度(数字が若いほど優先度高 1~4までのみ)<br>
                                        <input type="number" name="PRIORITY"
                                            value="<?php echo htmlspecialchars($img['PRIORITY']);  ?>">
                                    </label>
                                    <button type="submit" class="change-button">変更</button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>

        <!-- Image Preview Modal -->
        <div id="imagePreviewModal" class="modal">
            <span class="close">&times;</span>
            <img class="modal-content" id="previewImage">
        </div>

        <script>
        function updateFileNames(input) {
            const filesDiv = document.getElementById('selected-files');
            filesDiv.innerHTML = '';
            if (input.files && input.files.length > 0) {
                const fileList = document.createElement('ul');
                fileList.className = 'file-list';
                for (let i = 0; i < input.files.length; i++) {
                    const li = document.createElement('li');
                    const file = input.files[i];
                    const fileSize = (file.size / 1024 / 1024).toFixed(2); // サイズをMBに変換
                    li.textContent = `${file.name} (${fileSize} MB)`;
                    fileList.appendChild(li);
                }
                filesDiv.appendChild(fileList);
            }
        }


        // Image Preview Modal
        function openImagePreview(imgSrc) {
            const modal = document.getElementById('imagePreviewModal');
            const modalImg = document.getElementById('previewImage');
            modal.style.display = 'block';
            modalImg.src = imgSrc;
        }

        const modal = document.getElementById('imagePreviewModal');
        const span = document.getElementsByClassName('close')[0];

        span.onclick = function() {
            modal.style.display = 'none';
        }

        window.onclick = function(event) {
            if (event.target == modal) {
                modal.style.display = 'none';
            }
        }
        document.addEventListener('DOMContentLoaded', function() {
            const talentButton = document.querySelector('.talent-button');
            const photosButton = document.querySelector('.photos-button');
            const talentInfo = document.querySelector('.talent-info');
            const photosInfo = document.querySelector('.photos-info');

            function hideAllSections() {
                talentInfo.style.display = 'none';
                photosInfo.style.display = 'none';
                talentButton.classList.remove('active');
                photosButton.classList.remove('active');
            }

            talentButton.addEventListener('click', function() {
                hideAllSections();
                talentInfo.style.display = 'block';
                talentButton.classList.add('active');
            });

            photosButton.addEventListener('click', function() {
                hideAllSections();
                photosInfo.style.display = 'block';
                photosButton.classList.add('active');
                updateSliderLayout();
            });

            hideAllSections();
            photosInfo.style.display = 'block';
            photosButton.classList.add('active');
        });
        </script>
    </main>
</body>

</html>