<?php

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
            <h2>ニュース登録・変更</h2>

            <!-- 送信が行われたらメッセージを表示する -->
            <?php if(isset($_POST["MESS"])): ?>
            <br>
            <h4 style="color:blue;"><?php echo htmlspecialchars($_POST["MESS"]); ?></h4>
            <?php endif; ?>

            <p>※ここではニュースの登録・変更を行うことができます。</p>
            <form onsubmit="return checkSubmit('登録');" action="00-admin.php" method="POST">

                <input type="hidden" name="EXE_ID" value="03">
                <input type="hidden" name="active_tab" value="news-entry">
            </form>
        </div>
    </main>
</body>

</html>