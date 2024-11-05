<?php
require_once('admin-db.php');
$obj = new DbController();
$imgList = $obj->getTalentImg($talentId);

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
            <h2 class="section-title">タレント写真登録・変更</h2>

            <!-- 写真登録 -->
            <div class="photo-upload-section">
                <h3 class="subsection-title">◆写真新規登録</h3>
                <form onsubmit="return checkSubmit('登録');" action="10-talent-admin.php" method="POST"
                    enctype="multipart/form-data" class="upload-form">
                    <input type="hidden" name="TALENT_ID" value="<?php echo $talentId ?>">
                    <input type="hidden" name="EXE_ID" value="12_3">
                    <input type="hidden" name="active_tab" value="talent-photos">

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
                <div class="photo-grid">
                    <?php foreach ($imgList as $img): ?>
                    <div class="photo-item">
                        <img class="photo-thumbnail"
                            src="../<?php echo htmlspecialchars($img['FILE_PATH'] . $img['FILE_NAME']) ?>"
                            alt="<?php echo htmlspecialchars($img['COMMENT']) ?>" onclick="openImagePreview(this.src)">
                        <div class="photo-actions">
                            <form onsubmit="return checkSubmit('変更');" action="10-talent-admin.php" method="POST"
                                class="change-form">
                                <input type="hidden" name="EXE_ID" value="12_2">
                                <input type="hidden" name="active_tab" value="talent-photos">
                                <input type="hidden" name="TALENT_ID" value="<?php echo $talentId ?>">
                                <input type="hidden" name="FILE_NAME"
                                    value="<?php echo htmlspecialchars($img['FILE_NAME']);  ?>">
                                <input type="hidden" name="VIEW_FLG_BEF"
                                    value="<?php echo htmlspecialchars($img['VIEW_FLG']);  ?>">

                                <div class="select-wrapper">
                                    <select name="VIEW_FLG_AFT" class="view-select">
                                        <?php $selectList = $obj->getViewFlg(); foreach ($selectList as $select): ?>
                                        <option value="<?php echo $select['VIEW_FLG']; ?>"
                                            <?php echo ($select['VIEW_FLG'] == $img['VIEW_FLG']) ? 'selected' : ''; ?>>
                                            <?php echo $select['COMMENT']; ?>
                                        </option>
                                        <?php endforeach; ?>
                                    </select>
                                    <button type="submit" class="change-button">変更</button>
                                </div>
                            </form>
                            <form onsubmit="return checkSubmit('削除');" action="10-talent-admin.php" method="POST"
                                class="delete-form">
                                <input type="hidden" name="EXE_ID" value="12_1">
                                <input type="hidden" name="active_tab" value="talent-photos">
                                <input type="hidden" name="TALENT_ID" value="<?php echo $talentId ?>">
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
                    li.textContent = input.files[i].name;
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
        </script>
    </main>
</body>

</html>