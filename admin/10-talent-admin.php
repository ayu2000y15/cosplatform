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
                <h3>タレントID：<?php echo htmlspecialchars($talentId); ?></h3>
                <h3>レイヤーネーム：<?php echo htmlspecialchars($layerName); ?></h3>

                <div class="action-buttons">
                    <?php
                    $buttons = [
                        ['class' => 'talent-edit-button', 'text' => 'タレント情報変更'],
                        ['class' => 'talent-photos-button', 'text' => 'タレント写真登録・変更'],
                        ['class' => 'talent-career-button', 'text' => 'タレント経歴登録・変更'],
                        ['class' => 'talent-tag-button', 'text' => 'ハッシュタグ登録・変更']
                    ];
                    foreach ($buttons as $button) {
                        echo "<button class='button {$button['class']}'>{$button['text']}</button>";
                    }
                ?>
                </div>

                <div class="talent-edit-info" style="display: none;">
                    <?php include '11-talent-edit.php'; ?>
                </div>

                <div class="talent-photos-info" style="display: none;">
                    <?php include '12-talent-photos.php'; ?>
                </div>

                <div class="talent-career-info" style="display: none;">
                    <?php include '13-talent-career.php'; ?>
                </div>

                <div class="talent-tag-info" style="display: none;">
                    <?php include '14-talent-tag.php'; ?>
                </div>

            </div>
        </div>
    </main>
    <script src="admin-script.js"></script>
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        const buttons = document.querySelectorAll('.action-buttons .button');
        const sections = {
            'talent-edit-button': '.talent-edit-info',
            'talent-photos-button': '.talent-photos-info',
            'talent-career-button': '.talent-career-info',
            'talent-tag-button' : '.talent-tag-info'
        };

        function hideAllSections() {
            Object.values(sections).forEach(selector => {
                document.querySelector(selector).style.display = 'none';
            });
            buttons.forEach(btn => btn.classList.remove('active'));
        }

        buttons.forEach(button => {
            button.addEventListener('click', function() {
                hideAllSections();
                const sectionSelector = sections[this.classList[1]];
                document.querySelector(sectionSelector).style.display = 'block';
                this.classList.add('active');
            });
        });
    });
    </script>
</body>

</html>