<?php

    require_once('admin-db.php'); 
    $obj = new DbController();

?>

<!DOCTYPE html>
<html lang="ja">

<body>
    <main>
        <div class="talent-career">
            <form class="form-area" onsubmit="checkSubmit();" action="00-admin.php" method="POST">
                <h2>タレント経歴登録・変更</h2>
            </form>
        </div>
    </main>
</body>

</html>