<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CONTACT - COSPLATFORM</title>
    <link rel="stylesheet" href="style.css">
    <style>
        .subpage-hero {
            background-image: url('src/top3.jpg');
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
                        <label htmlFor="name">お名前</label>
                        <input type="text" id="name" name="name" required />
                    </div>
                    <div class="form-group">
                        <label htmlFor="email">メールアドレス</label>
                        <input type="email" id="email" name="email" required />
                    </div>
                    <div class="form-group">
                        <label htmlFor="subject">件名</label>
                        <input type="text" id="subject" name="subject" required />
                    </div>
                    <div class="form-group">
                        <label htmlFor="message">メッセージ</label>
                        <textarea id="message" name="message" rows="5" required></textarea>
                    </div>
                    <button type="submit" class="submit-button">送信</button>
                </form>
            </div>
        </div>
    </main>
    
    <?php include 'footer.php'; ?>

    <script src="script.js"></script>
</body>
</html>