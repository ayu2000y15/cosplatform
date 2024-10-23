<?php

    require_once('db.php'); 
    $obj = new DbController();
    $topImg = $obj->getTopImg('202');

?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CONTACT - COSPLATFORM</title>
    <link rel="stylesheet" href="style.css">
    <style>
        .subpage-hero {
            <?php
            foreach ($topImg as $row) {
                echo 'background-image: url("' . htmlspecialchars($row['FILE_PATH']) . htmlspecialchars($row['FILE_NAME']) . '");';
            }
            ?>
        }
    </style>
</head>
<body>
    <?php include 'header.php'; ?>

    <main>
        <section class="subpage-hero">
            <h1>CONTACT</h1>
        </section>
        <div class="container">
            <div class="container-box">
                <h2>お問い合わせフォーム</h2>
                <form class="contact-form" action="submit_contact.php" method="POST">
                    <div class="form-group">
                        <label for="name">お名前<span class="required">必須</span></label>
                        <input type="text" id="name" name="name" required />
                    </div>
                    <div class="form-group">
                        <label for="email">メールアドレス<span class="required">必須</span></label>
                        <input type="email" id="email" name="email" required />
                    </div>
                    <div class="form-group">
                        <label for="subject">件名<span class="required">必須</span></label>
                        <input type="text" id="subject" name="subject" required />
                    </div>
                    <div class="form-group">
                        <label for="message">メッセージ<span class="required">必須</span></label>
                        <textarea id="message" name="message" rows="5" required></textarea>
                    </div>
                    <div class="form-group checkbox-group">
                        <input type="checkbox" id="privacy-policy" name="privacy-policy" required />
                        <label for="privacy-policy">プライバシーポリシーに同意する</label>
                    </div>
                    <button type="submit" class="submit-button">送信する</button>
                </form>
            </div>
        </div>
    </main>
    
    <?php include 'footer.php'; ?>

    <script src="script.js"></script>
</body>
</html>