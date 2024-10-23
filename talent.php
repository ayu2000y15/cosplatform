<?php

require_once('db.php');
$obj = new DbController();
$topImg = $obj->getTopImg('201');
$talentImg = $obj->getTalentImg();
?>
<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TALENT - COSPLATFORM</title>
    <link rel="stylesheet" href="style.css">
    <style>
        .subpage-hero {
            <?php
            foreach ($topImg as $row) {
                echo 'background-image: url("' . htmlspecialchars($row['FILE_PATH']) . htmlspecialchars($row['FILE_NAME']) . '");';
            }
            ?>
        }
    </style>
</head>

<body>
    <?php include 'header.php'; ?>

    <main>
        <section class="subpage-hero">
            <h1>TALENT</h1>
        </section>
        <div class="container">
            <div class="container-box">
                <section class="talent-page">
                    <div class="talent-grid">
                    <form method="post" name="talentAction" action="talent-profile.php">
                        <?php foreach ($talentImg as $row): ?>
                            <div class="talent-item">
                                    <input type="hidden" name="TALENT_ID"
                                        value="<?php echo htmlspecialchars($row['TALENT_ID']); ?>">
                    </form>
                                    <a href="javascript:talentAction.submit()">
                                        <img style="background: linear-gradient(to right, #ffd1dc, #e6e6fa); border-radius: 10px; padding:10px;"
                                            src="<?php echo htmlspecialchars($row['FILE_PATH1'] . $row['FILE_NAME1']); ?>"
                                            onmouseover="this.src='<?php echo htmlspecialchars($row['FILE_PATH2'] . $row['FILE_NAME2']); ?>'"
                                            onmouseout="this.src='<?php echo htmlspecialchars($row['FILE_PATH1'] . $row['FILE_NAME1']); ?>'">
                                    </a>
                                
                                <h2><?php echo htmlspecialchars($row['LAYER_NAME']); ?></h2>
                            </div>
                        <?php endforeach; ?>

                    </div>
                </section>
            </div>
        </div>
    </main>


    <?php include 'footer.php'; ?>

    <script src="script.js"></script>
</body>

</html>