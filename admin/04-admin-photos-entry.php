<?php

    require_once('admin-db.php'); 
    $obj = new DbController();

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
            <h2>HP画像登録・変更</h2>

            <p>※タレントに紐つく写真はタレント編集より行ってください。<br>
                　ここではHP全体の画像登録が行えます。</p>
            <form onsubmit="return checkSubmit('登録');" action="00-admin.php" method="POST">
                <input type="hidden" name="EXE_ID" value="04">
                <input type="hidden" name="active_tab" value="photos-entry">
            </form>
        </div>
    </main>
</body>

</html>