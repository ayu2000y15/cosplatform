<?php
    $talentId = (string)$_REQUEST['TALENT_ID'];
    require_once('admin-db.php'); 
    $obj = new DbController();

    $talent = $obj->getTalent($talentId);
    foreach ($talent as $row){
        $layerName = $row['LAYER_NAME'];
    }

    $viewInfo = $obj->getTalentInfoCtl($talentId);

?>
<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>管理者ページ - COSPLATFORM</title>
    <link rel="stylesheet" href="admin-style.css">
</head>

<body>
    <?php include '00-admin-header.php'; ?>
    <main>
        <section class="subpage-hero">
            <h1>タレント情報編集ページ</h1>
        </section>
        <div class="container">
            <div class="container-box">
                <a href="00-admin.php">管理画面トップに戻る</a>
                
                <h3>タレントID：<?php echo htmlspecialchars($talentId); ?></h3>
                <h3>レイヤーネーム：<?php echo htmlspecialchars($layerName); ?></h3>

                <div class="tabs">
                    <div class="tab-buttons">
                        <button class="tab-button active" data-tab="talent-edit">タレント情報変更</button>
                        <button class="tab-button" data-tab="talent-photos">タレント写真登録・変更</button>
                        <button class="tab-button" data-tab="talent-career">タレント経歴登録・変更</button>
                        <button class="tab-button" data-tab="talent-tag">ハッシュタグ登録・変更</button>
                    </div>

                    <div class="tab-content active" id="talent-edit">
                        <?php include '11-talent-edit.php'; ?>
                    </div>

                    <div class="tab-content" id="talent-photos">
                        <?php include '12-talent-photos.php'; ?>
                    </div>

                    <div class="tab-content" id="talent-career">
                        <?php include '13-talent-career.php'; ?>
                    </div>

                    <div class="tab-content" id="talent-tag">
                        <?php include '14-talent-tag.php'; ?>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <script src="admin-script.js"></script>
</body>

</html>