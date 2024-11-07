<?php

    require_once('admin-db.php'); 
    $obj = new DbController();
    $tagList = $obj -> getMTag();
?>

<!DOCTYPE html>
<html lang="ja">

<head>
    <link rel="stylesheet" href="admin-style.css">
</head>

<body>
    <main>
        <script src="admin-script.js"></script>
        <div class="form-area">
            <h2>ハッシュタグ登録・変更</h2>

            <p>※タレントに紐つくハッシュタグはタレント編集より行ってください。<br>
                　ここではハッシュタグの登録や削除が行えます。</p>

            <hr class="hr-line">
            <h3>◆タグを新しく作成</h3>
            <form onsubmit="return checkSubmit('登録');" action="00-admin.php" method="POST">
                <input type="hidden" name="EXE_ID" value="05_1">
                <input type="hidden" name="active_tab" value="tag-entry">
                <div class="form-group">
                    <label for="TAG_NAME">タグ名<span class="required"></span></label>
                    <input type="text" id="TAG_NAME" name="TAG_NAME" placeholder="Vtuber" required />
                </div>
                <div class="form-group">
                    <label for="TAG_COLOR">カラー<span class="required">※HPに表示されるときに使用します</span></label>
                    <div class="color-input-wrapper">
                        <input type="color" id="TAG_COLOR" name="TAG_COLOR" value="#999999" required />
                        <div id="colorPreview" class="color-preview">サンプル</div>
                    </div>
                    <p>※文字色は白になります。</p>
                </div>
                <button type="submit" class="submit-button">送信する</button>
            </form>

            <hr class="hr-line">
            <h3>◆タグ一覧</h3>

            <table class="tag-table">
                <div class="tag-container">
                    <?php foreach ($tagList as $tag): ?>
                    <tr>
                        <td>
                            <span class="tag"
                                style="background-color: <?php echo htmlspecialchars($tag['TAG_COLOR']) ?>">
                                <?php echo '#' . htmlspecialchars($tag['TAG_NAME']) ; ?>
                            </span>
                        </td>
                        <td>
                            <form onsubmit="return checkSubmit('削除');" action="00-admin.php" method="POST">
                                <input type="hidden" name="EXE_ID" value="05_2">
                                <input type="hidden" name="active_tab" value="tag-entry">
                                <input type="hidden" name="TAG_ID"
                                    value="<?php echo htmlspecialchars($tag['TAG_ID']);  ?>">
                                <button type="submit" class="multi-button delete-button">削除する</button>
                            </form>
                        </td>
                    </tr>


                    <?php endforeach; ?>
                </div>
            </table>
        </div>
    </main>
    <!-- カラー選択のプレビューを更新するスクリプトを追加 -->
    <script>
    document.getElementById('TAG_COLOR').addEventListener('input', function(e) {
        document.getElementById('colorPreview').style.backgroundColor = e.target.value;
    });
    </script>
</body>

</html>