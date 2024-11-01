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
            <form onsubmit="return checkSubmit('登録');" action="00-admin.php" method="POST">
                <h2>ニュース登録・変更</h2>
                <p>※ここではニュースの登録・変更を行うことができます</p>

                <input type="hidden" name="EXE_ID" value="03">
            </form>
        </div>
    </main>
</body>

</html>