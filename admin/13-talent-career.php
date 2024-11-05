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
            <h2>タレント経歴登録・変更</h2>

            <form onsubmit="return checkSubmit('登録');" action="10-talent-admin.php" method="POST">
                <input type="hidden" name="EXE_ID" value="13">
                <input type="hidden" name="active_tab" value="talent-career">
            </form>
        </div>
    </main>
</body>

</html>