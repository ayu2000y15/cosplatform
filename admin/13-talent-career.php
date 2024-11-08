<?php
    require_once('admin-db.php');
    $obj = new DbController();
    $careerCategories = $obj->getCareerCategory();
    $talentCareer = $obj->getTalentCareer($talentId);

    $pageTitle = "タレント経歴管理";
    $itemName = "経歴";
    $submitExeId = "13_1";
    $updateExeId = "13_3";
    $deleteExeId = "13_2";

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
                <h2>タレント経歴登録・編集</h2>
                <form id="adminForm" onsubmit="return checkSubmit();" action="10-talent-admin.php" method="POST">
                    <input type="hidden" name="EXE_ID" id="EXE_ID" value="<?php echo $submitExeId; ?>">
                    <input type="hidden" name="active_tab" value="talent-career">
                    <input type="hidden" name="TALENT_ID" value="<?php echo $talentId; ?>">
                    <input type="hidden" name="CAREER_ID" id="CAREER_ID">
                    <div class="form-group">
                        <label for="CAREER_CATEGORY_ID">経歴カテゴリ</label>
                        <select name="CAREER_CATEGORY_ID" id="CAREER_CATEGORY_ID" required>
                            <?php foreach ($careerCategories as $select): ?>
                            <option value="<?php echo $select['CAREER_CATEGORY_ID']; ?>">
                                <?php echo $select['CAREER_CATEGORY_NAME']; ?>
                            </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="CONTENT">経歴内容</label>
                        <input type="text" id="CONTENT" name="CONTENT" required>
                    </div>
                    <div class="form-group">
                        <label for="ACTIVE_DATE">活動日</label>
                        <input type="date" id="ACTIVE_DATE" name="ACTIVE_DATE" required>
                    </div>
                    <div class="form-group">
                        <label for="DETAIL">経歴詳細</label>
                        <textarea id="DETAIL" name="DETAIL" rows="5"></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary" id="submitBtn">登録</button>
                    <button type="button" class="btn btn-secondary" onclick="resetForm()">リセット</button>
                </form>
            </div>
            <div class="list-area">
                <h2>経歴一覧</h2>
                <table class="table-container">
                    <thead>
                        <tr>
                            <th>活動日</th>
                            <th>経歴カテゴリ</th>
                            <th>経歴内容</th>
                            <th>操作</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($talentCareer as $career): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($career['ACTIVE_DATE']); ?></td>
                            <td><?php echo htmlspecialchars($career['CAREER_CATEGORY_NAME']); ?></td>
                            <td><?php echo htmlspecialchars($career['CONTENT']); ?></td>
                            <td>
                                <button class="btn btn-edit"
                                    onclick="editItem(<?php echo htmlspecialchars(json_encode($career)); ?>)">編集</button>
                                <form onsubmit="return checkSubmit('削除');" action="10-talent-admin.php" method="POST"
                                    style="display: inline;">
                                    <input type="hidden" name="EXE_ID" value="<?php echo $deleteExeId; ?>">
                                    <input type="hidden" name="active_tab" value="talent-career">
                                    <input type="hidden" name="TALENT_ID" value="<?php echo $talentId; ?>">
                                    <input type="hidden" name="CAREER_ID"
                                        value="<?php echo htmlspecialchars($career['CAREER_ID']); ?>">
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
    document.getElementById('CAREER_ID').value = item.CAREER_ID;
    document.getElementById('CAREER_CATEGORY_ID').value = item.CAREER_CATEGORY_ID;
    document.getElementById('CONTENT').value = item.CONTENT;
    document.getElementById('ACTIVE_DATE').value = item.ACTIVE_DATE;
    document.getElementById('DETAIL').value = item.DETAIL;
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
    <script src="admin-script.js"></script>
    <?php if (isset($pageSpecificScript)) echo $pageSpecificScript; ?>
</body>

</html>