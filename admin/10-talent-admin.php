<?php
    // アクティブなタブを保持する変数を追加
    $activeTab = isset($_POST['active_tab']) ? $_POST['active_tab'] : 'talent-edit';

    $talentId = (string)$_POST['TALENT_ID'];
    $exeId = $_POST['EXE_ID'];

    require_once('admin-db.php'); 
    $obj = new DbController();

    $talent = $obj->getTalent($talentId);
    foreach ($talent as $row){
        $layerName = $row['LAYER_NAME'];
    }
    
    //タレントのタグを削除
    if ($exeId === '14_1') {
        $exeId = '14_1 ok'; 
        $obj->deleteTalentTag($talentId, $_POST['TAG_ID']);
    }
    //タレント情報にタグを登録
    if ($exeId === '14_2') {
        $exeId = '14_2 ok'; 
        $obj->insertTalentTag($talentId, $_POST['TAG_ID']);
    }
    //新規タグを登録
    if ($exeId === '14_3') {
        $exeId = '14_3 ok'; 
        $obj->insertMTag($_POST['TAG_NAME'], $_POST['TAG_COLOR']);
    }

    //タレント削除処理
    if($exeId === '15'){
        $exeId = '15 ok'; 
        $obj->deleteTalent( $_POST["RETIREMENT_DATE"],$talentId);
    }

?>

<script>
console.log('<?php echo $_SERVER["REQUEST_METHOD"] . ':' . $exeId; ?>')
</script>
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
                <div class="talent-header">
                    <a href="00-admin.php">管理画面トップに戻る</a>
                    <h3>タレントID：<?php echo htmlspecialchars($talentId); ?></h3>
                    <h3>レイヤーネーム：<?php echo htmlspecialchars($layerName); ?></h3>
                </div>

                <div class="tabs">
                    <div class="tab-buttons">
                        <button class="tab-button <?php echo $activeTab === 'talent-edit' ? 'active' : ''; ?>" data-tab="talent-edit">タレント情報変更</button>
                        <button class="tab-button <?php echo $activeTab === 'talent-photos' ? 'active' : ''; ?>" data-tab="talent-photos">タレント写真登録・変更</button>
                        <button class="tab-button <?php echo $activeTab === 'talent-career' ? 'active' : ''; ?>" data-tab="talent-career">タレント経歴登録・変更</button>
                        <button class="tab-button <?php echo $activeTab === 'talent-tag' ? 'active' : ''; ?>" data-tab="talent-tag">ハッシュタグ登録・変更</button>
                        <button class="tab-button <?php echo $activeTab === 'talent-retire' ? 'active' : ''; ?>" data-tab="talent-retire">タレント退職</button>
                    </div>

                    <div class="tab-content <?php echo $activeTab === 'talent-edit' ? 'active' : ''; ?>" id="talent-edit">
                        <?php include '11-talent-edit.php'; ?>
                    </div>

                    <div class="tab-content <?php echo $activeTab === 'talent-photos' ? 'active' : ''; ?>" id="talent-photos">
                        <?php include '12-talent-photos.php'; ?>
                    </div>

                    <div class="tab-content <?php echo $activeTab === 'talent-career' ? 'active' : ''; ?>" id="talent-career">
                        <?php include '13-talent-career.php'; ?>
                    </div>

                    <div class="tab-content <?php echo $activeTab === 'talent-tag' ? 'active' : ''; ?>" id="talent-tag">
                        <?php include '14-talent-tag.php'; ?>
                    </div>

                    <div class="tab-content <?php echo $activeTab === 'talent-retire' ? 'active' : ''; ?>" id="talent-retire">
                        <?php include '15-talent-retire.php'; ?>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <script src="admin-script.js"></script>
</body>

</html>