<?php

    require_once('admin-db.php'); 
    $obj = new DbController();
    $careerCategories = $obj->getCareerCategory();
    $talentCareer = $obj->getTalentCareer($talentId);
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
            <h2>タレント経歴登録・変更</h2>

            <h3>◆経歴登録</h3>
            <form onsubmit="return checkSubmit('登録');" action="10-talent-admin.php" method="POST">
                <input type="hidden" name="EXE_ID" value="13_1">
                <input type="hidden" name="active_tab" value="talent-career">
                <input type="hidden" name="TALENT_ID" value="<?php echo $talentId ?>">

                <div class="form-group">
                    <label for="CAREER_CATEGORY_ID">経歴カテゴリ<span class="required">必須</span></label>
                    <select name="CAREER_CATEGORY_ID">
                        <?php foreach ($careerCategories as $select): ?>
                        <option value="<?php echo $select['CAREER_CATEGORY_ID']; ?>">
                            <?php echo $select['CAREER_CATEGORY_NAME']; ?>
                        </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="CONTENT">経歴タイトル<span class="required">必須</span></label>
                    <input type="text" id="CONTENT" name="CONTENT" placeholder="○○に出演" required />
                </div>
                <div class="form-group">
                    <label for="DETAIL">経歴詳細<span class="required"></span></label>
                    <textarea id="DETAIL" name="DETAIL" rows="3" placeholder="詳細があれば記載してください"></textarea>
                </div>
                <button type="submit" class="submit-button">送信する</button>
            </form>

            <hr class="hr-line">
            <h3>◆経歴一覧</h3>
            <div class="table-container">
                <table>
                    <tr>
                        <th>経歴カテゴリ</th>
                        <th>経歴タイトル</th>
                        <th>経歴詳細</th>
                        <th></th>
                    </tr>
                    <?php foreach ($talentCareer as $career): ?>
                    <form onsubmit="return checkSubmit('削除');" action="10-talent-admin.php" method="POST">
                        <input type="hidden" name="EXE_ID" value="13_2">
                        <input type="hidden" name="active_tab" value="talent-career">
                        <input type="hidden" name="TALENT_ID" value="<?php echo $talentId ?>">
                        <input type="hidden" name="CAREER_CATEGORY_ID"
                            value="<?php echo $career['CAREER_CATEGORY_ID'] ?>">
                        <input type="hidden" name="CONTENT" value="<?php echo $career['CONTENT'] ?>">
                        <tr>
                            <td>
                                <?php echo htmlspecialchars($career['CAREER_CATEGORY_NAME']) ; ?>
                            </td>
                            <td>
                                <?php echo htmlspecialchars($career['CONTENT']) ; ?>
                            </td>
                            <td>
                                <?php echo htmlspecialchars($career['DETAIL']) ; ?>
                            </td>
                            <td>
                                <button type="submit" class="multi-button delete-button">削除する</button>
                            </td>
                        </tr>
                    </form>
                    <?php endforeach; ?>
                </table>
            </div>
        </div>
    </main>
</body>

</html>