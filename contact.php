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
        <?php foreach ($topImg as $row) {
            echo 'background-image: url("'. htmlspecialchars($row['FILE_PATH']) . htmlspecialchars($row['FILE_NAME']) . '");';
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
            <div class="container-box contact">
                <h2>お問い合わせフォーム</h2>
                <iframe name="hidden_iframe" id="hidden_iframe" style="display:none;" onload="if(submitted) {window.location='contact-ok.php';}"></iframe>
                <form class="contact-form"
                    action="https://docs.google.com/forms/u/0/d/e/1FAIpQLSflqYHJxkyXDqxy0Z4fUTN6LXL44nxYm1-cWQKOmOsRYv4-xw/formResponse"
                    method="POST" target="hidden_iframe" onsubmit="submitted=true;">
                    <div class="form-group">
                        <label for="name">お名前<span class="required">必須</span></label>
                        <input type="text" id="name" name="entry.783831543" placeholder="山田太郎" required />
                    </div>
                    <div class="form-group">
                        <label for="email">メールアドレス<span class="required">必須</span></label>
                        <input type="email" id="email" name="entry.2031892057" placeholder="example@gmail.com"　required />
                    </div>
                    <div class="form-group">
                        <label for="tel">電話番号<span class="required"></span></label>
                        <input type="tel" id="tel" pattern="[0-9]{3}-[0-9]{4}-[0-9]{4}" name="entry.2108915669" placeholder="080-1234-5678" />
                    </div>
                    <div class="form-group">
                        <label for="subject">件名<span class="required">必須</span></label>
                        <input type="text" id="subject" name="entry.1414443987" placeholder="例、衣装制作について" required />
                    </div>
                    <div class="form-group">
                        <label for="content">質問内容<span class="required">必須</span></label>
                        <textarea id="content" name="entry.1111380753" rows="5" placeholder="問い合わせ内容をここに記載してください" required></textarea>
                    </div>
                    <!-- <div class="form-group checkbox-group">
                        <input type="checkbox" id="privacy-policy" name="privacy-policy" required />
                        <label for="privacy-policy">プライバシーポリシーに同意する</label>
                    </div> -->
                    <button type="submit" class="submit-button">送信する</button>
                </form>
            </div>
        </div>
    </main>

    <?php include 'footer.php'; ?>

    <script src="script.js"></script>
</body>

</html>