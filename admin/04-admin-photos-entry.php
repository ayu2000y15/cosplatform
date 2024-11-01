<?php

    require_once('admin-db.php'); 
    $obj = new DbController();

?>

<!DOCTYPE html>
<html lang="ja">

<body>
    <main>
        <div class="admin-photos-insert">
            <form class="form-area" onsubmit="return checkSubmit();" action="00-admin.php" method="POST">
                <h2>HP画像登録・変更</h2>
                <p>※タレントに紐つく写真はタレント編集より行ってください<br>
                    　ここではHP全体の画像登録が行えます。</p>
            </form>
        </div>
    </main>
</body>

</html>