<?php

    require_once('admin-db.php'); 
    $obj = new DbController();
    $talentList = $obj->getTalentList();

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        header("Location:admin.php");
    }
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
            <h1>管理者ページ</h1>
        </section>
        <div class="container">
            <div class="container-box">
                <section class="admin">
                    <div class="talent-list">
                        <h2>登録済みタレント一覧</h2>
                        <p>※リンクをクリックすることでタレント詳細ページに遷移します<br>
                            　タレント詳細ページではタレントの写真や経歴、ハッシュタグの情報の更新が行えます<br></p>
                        <br>
                        <?php foreach ($talentList as $row): ?>
                        <form method="post" name="<?php echo 'talent' . $row['TALENT_ID'] ?>" action="10-talent-admin.php">
                            <input type="hidden" name="TALENT_ID"
                                value="<?php echo htmlspecialchars($row['TALENT_ID']); ?>">
                            <a href="<?php echo 'javascript:talent' . $row['TALENT_ID'] . '.submit()'?>">
                                <?php echo htmlspecialchars($row['TALENT_ID']) . '：' . htmlspecialchars($row['LAYER_NAME']); ?>
                            </a>
                        </form>
                        <?php endforeach; ?>
                    </div>

                    <hr class="hr-line">
                    <div class="action-buttons">
                        <?php
                        $buttons = [
                            ['class' => 'talent-entry-button', 'text' => 'タレント登録'],
                            ['class' => 'retire-entry-button', 'text' => 'タレント退職・削除登録'],
                            ['class' => 'photos-entry-button', 'text' => 'HP画像登録・変更']
                        ];
                        foreach ($buttons as $button) {
                            echo "<button class='button {$button['class']}'>{$button['text']}</button>";
                        }
                        ?>
                    </div>

                    <div class="talent-entry-info" style="display: none;">
                        <?php include '01-admin-talent-entry.php'; ?>
                    </div>

                    <div class="retire-entry-info" style="display: none;">
                        <?php include '02-admin-retire-entry.php'; ?>
                    </div>

                    <div class="photos-entry-info" style="display: none;">
                        <?php include '03-admin-photos-entry.php'; ?>
                    </div>

                </section>
            </div>
        </div>
    </main>
    <script src="admin-script.js"></script>
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        const buttons = document.querySelectorAll('.action-buttons .button');
        const sections = {
            'talent-entry-button': '.talent-entry-info',
            'retire-entry-button': '.retire-entry-info',
            'photos-entry-button': '.photos-entry-info'
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