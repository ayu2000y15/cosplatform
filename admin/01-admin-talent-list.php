<?php
    require_once('admin-db.php'); 
    $obj = new DbController();
    $talentList = $obj->getTalentList();
?>

<!DOCTYPE html>
<html lang="ja">

<body>
    <main>
        <div class="admin-talent-list">
            <div class="talent-list">
                <h2>登録済みタレント一覧</h2>
                <p>※リンクをクリックすることでタレント詳細ページに遷移します。<br>
                    　タレント詳細ページではタレントの写真や経歴、ハッシュタグの情報の更新が行えます。<br></p>
                <br>
                <?php foreach ($talentList as $row): ?>
                <form method="post" name="<?php echo 'talent' . $row['TALENT_ID'] ?>" action="10-talent-admin.php">
                    <input type="hidden" name="TALENT_ID" value="<?php echo htmlspecialchars($row['TALENT_ID']); ?>">
                    <a href="<?php echo 'javascript:talent' . $row['TALENT_ID'] . '.submit()'?>">
                        <?php echo htmlspecialchars($row['TALENT_ID']) . '：' . htmlspecialchars($row['LAYER_NAME']); ?>
                    </a>
                </form>
                <?php endforeach; ?>
            </div>
        </div>
    </main>
</body>

</html>