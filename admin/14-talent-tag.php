<?php

    require_once('admin-db.php'); 
    $obj = new DbController();
    $tagList = $obj -> getTalentTag($talentId);
    $tagNotList = $obj -> getTalentNotTag($talentId);

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

            <h3>◆登録済みのハッシュタグ一覧</h3>
            <?php foreach ($tagList as $tag): ?>
            <form onsubmit="return checkSubmit('削除');" action="10-talent-admin.php" method="POST">
                <input type="hidden" name="EXE_ID" value="14_1">
                <input type="hidden" name="MESS" value="タグを削除しました">
                <input type="hidden" name="TALENT_ID" value="<?php echo $talentId ?>">
                <input type="hidden" name="TAG_ID" value="<?php echo htmlspecialchars($tag['TAG_ID']);  ?>">
                <div class="tag-container">
                    <table class="tag-table">
                        <td>
                            <span class="tag"
                                style="background-color: <?php echo htmlspecialchars($tag['TAG_COLOR']) ?>">
                                <?php echo '#' . htmlspecialchars($tag['TAG_NAME']) ; ?>
                            </span>
                        <td>
                        <td>
                            <button type="submit" class="multi-button">削除する</button>
                        </td>
                    </table>
                </div>

            </form>
            <?php endforeach; ?>

            <hr class="hr-line">
            <h3>◆既存のタグから選択</h3>
            <form onsubmit="return checkSubmit('登録');" action="10-talent-admin.php" method="POST">
                <input type="hidden" name="EXE_ID" value="14_2">
                <input type="hidden" name="MESS" value="タレント情報にタグを追加しました">
                <input type="hidden" name="TALENT_ID" value="<?php echo $talentId ?>">
                <div class="form-group">
                    <select id="TAG_ID" name="TAG_ID">
                        <?php foreach ($tagNotList as $tag): ?>
                        <option value="<?php echo htmlspecialchars($tag['TAG_ID']); ?>">
                            <?php echo htmlspecialchars($tag['TAG_NAME']); ?>
                        </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <button type="submit" class="submit-button">送信する</button>
            </form>

            <hr class="hr-line">
            <h3>◆タグを新しく作成</h3>
            <p>※タグを作成後、上記から選択して登録してください。</p>
            <form onsubmit="return checkSubmit('登録');" action="10-talent-admin.php" method="POST">
                <input type="hidden" name="EXE_ID" value="14_3">
                <input type="hidden" name="MESS" value="タグを新しく追加しました">
                <input type="hidden" name="TALENT_ID" value="<?php echo $talentId ?>">
                <div class="form-group">
                    <label for="TAG_NAME">タグ名<span class="required"></span></label>
                    <input type="text" id="TAG_NAME" name="TAG_NAME" placeholder="Vtuber" required />
                </div>
                <div class="form-group">
                    <label for="TAG_COLOR">カラー<span class="required">※HPに表示されるときに使用します</span></label>
                    <input type="color" id="TAG_COLOR" name="TAG_COLOR" value="#999999" required />
                </div>
                <button type="submit" class="submit-button">送信する</button>
            </form>
        </div>
    </main>
</body>

</html>