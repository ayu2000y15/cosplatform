<?php
require_once('admin-db.php');
$obj = new DbController();
$newsList = $obj->getNewsList();

$pageTitle = "ニュース管理";
$itemName = "ニュース";
$submitExeId = "03_1";
$updateExeId = "03_2";
$deleteExeId = "03_3";

?>
<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="admin-style.css">
    <link rel="stylesheet" href="admin-common.css">
    <title><?php echo $pageTitle; ?></title>
</head>

<body>
    <main>
        <div class="form-area">
            <div class="form-area-common">
                <h2>ニュース登録・編集</h2>
                <form id="adminForm" onsubmit="return checkSubmit();" action="00-admin.php" method="POST">
                    <input type="hidden" name="EXE_ID" id="EXE_ID" value="<?php echo $submitExeId; ?>">
                    <input type="hidden" name="active_tab" value="news-entry">
                    <input type="hidden" name="NEWS_ID" id="NEWS_ID">
                    <div class="form-group">
                        <label for="TITLE">タイトル</label>
                        <input type="text" id="TITLE" name="TITLE" required>
                    </div>
                    <div class="form-group">
                        <label for="POST_DATE">投稿日</label>
                        <input type="date" id="POST_DATE" name="POST_DATE" required>
                    </div>
                    <div class="form-group">
                        <label for="CONTENT">詳細</label>
                        <textarea id="CONTENT" name="CONTENT" rows="5" required></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary" id="submitBtn">登録</button>
                    <button type="button" class="btn btn-secondary" onclick="resetForm()">リセット</button>
                </form>
            </div>
            <div class="list-area">
                <h2>ニュース一覧</h2>
                <table class="table-container">
                    <thead>
                        <tr>
                            <th>投稿日</th>
                            <th>タイトル</th>
                            <th>操作</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($newsList as $news): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($news['POST_DATE']); ?></td>
                            <td><?php echo htmlspecialchars($news['TITLE']); ?></td>
                            <td>
                                <button class="btn btn-edit"
                                    onclick="editItem(<?php echo htmlspecialchars(json_encode($news)); ?>)">編集</button>
                                <form onsubmit="return checkSubmit('削除');" action="00-admin.php" method="POST"
                                    style="display: inline;">
                                    <input type="hidden" name="EXE_ID" value="<?php echo $deleteExeId; ?>">
                                    <input type="hidden" name="active_tab" value="news-entry">
                                    <input type="hidden" name="NEWS_ID"
                                        value="<?php echo htmlspecialchars($news['NEWS_ID']); ?>">
                                    <button type="submit" class="btn btn-delete">削除</button>
                                </form>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>

        <?php
$pageSpecificScript = <<<EOT
<script>
var itemName = '{$itemName}';
var submitExeId = '{$submitExeId}';
var updateExeId = '{$updateExeId}';

function editItem(item) {
    document.getElementById('NEWS_ID').value = item.NEWS_ID;
    document.getElementById('TITLE').value = item.TITLE;
    document.getElementById('POST_DATE').value = item.POST_DATE;
    document.getElementById('CONTENT').value = item.CONTENT;
    document.getElementById('EXE_ID').value = updateExeId;
    document.getElementById('submitBtn').textContent = '更新';

    window.scrollTo({
        top: 0,
        behavior: 'smooth'
    });
}
</script>
EOT;

?>

    </main>
    <script src="admin-common.js"></script>
    <?php if (isset($pageSpecificScript)) echo $pageSpecificScript; ?>
</body>

</html>