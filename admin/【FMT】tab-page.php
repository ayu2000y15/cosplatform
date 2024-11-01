<?php

    require_once('admin-db.php'); 
    $obj = new DbController();

?>

<!DOCTYPE html>
<html lang="ja">

<body>
    <main>
        <script src="admin-script.js"></script>
        <div class="form-area">
        <h2></h2>
            <form onsubmit="return checkSubmit();" action="00-admin.php" method="POST">
                
            </form>
        </div>
    </main>
</body>

</html>