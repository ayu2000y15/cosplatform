<?php

    $talentId = (string)$_REQUEST['TALENT_ID'];
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
            <h2>タレント退職</h2>

            <form method="post" onsubmit="return checkSubmit('登録');" action="10-talent-admin.php">
                <input type="hidden" name="EXE_ID" value="15">
                <input type="hidden" name="active_tab" value="talent-retire">
                <div class="form-group">
                    <input type="hidden" name="TALENT_ID" value="<?php echo $talentId ?>">
                    <input type="hidden" name="MESS" value="退職日を登録しました">
                    <label for="RETIREMENT_DATE">退職日</label>
                    <input type="date" id="RETIREMENT_DATE" name="RETIREMENT_DATE" />
                </div>
                <button type="submit" class="submit-button">送信する</button>
            </form>
        </div>
    </main>
</body>

</html>