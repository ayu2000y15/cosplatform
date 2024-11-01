<?php

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        header("Location:00-admin.php");
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
                    <div class="tabs">
                        <div class="tab-buttons">
                            <button class="tab-button active" data-tab="talent-list">タレント一覧</button>
                            <button class="tab-button" data-tab="talent-entry">タレント登録</button>
                            <button class="tab-button" data-tab="retire-entry">タレント退職・削除登録</button>
                            <button class="tab-button" data-tab="photos-entry">HP画像登録・変更</button>
                        </div>

                        <div class="tab-content active" id="talent-list">
                            <?php include '01-admin-talent-list.php'; ?>
                        </div>

                        <div class="tab-content" id="talent-entry">
                            <?php include '02-admin-talent-entry.php'; ?>
                        </div>

                        <div class="tab-content" id="retire-entry">
                            <?php include '03-admin-retire-entry.php'; ?>
                        </div>

                        <div class="tab-content" id="photos-entry">
                            <?php include '04-admin-photos-entry.php'; ?>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </main>
    <script src="admin-script.js"></script>
</body>

</html>