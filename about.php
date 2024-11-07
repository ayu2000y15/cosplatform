<?php

    require_once('db.php'); 
    $obj = new DbController();
    $topImg = $obj->getTopImg('S201');
    $company = $obj->getCompany();
    $aboutImg = $obj->getTopImg('S401');

?>
<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ABOUT - COSPLATFORM</title>
    <link rel="stylesheet" href="style.css">
    <style>
    .subpage-hero {
        <?php foreach ($topImg as $row) {
            echo 'background-image: url("'. $row['FILE_PATH'] . $row['FILE_NAME'] . '");';
        }

        ?>
    }
    </style>

</head>

<body>
    <?php include 'header.php'; ?>

    <main>
        <section class="subpage-hero">
            <h1>ABOUT</h1>
        </section>
        <div class="container">
            <div class="container-box about">
                <section class="about-content">
                    <div class="company-philosophy">
                        <?php foreach ($aboutImg as $row): ?>
                        <div class="about-diagram">
                            <img src="<?php echo htmlspecialchars($row['FILE_PATH'] . $row['FILE_NAME'] ); ?>"
                                alt="<?php echo htmlspecialchars($row['ALT']); ?>" class="about-diagram-img">
                        </div>
                        <?php endforeach; ?>
                        <p>日本のポップカルチャーとして浸透しているアニメ、ゲーム、マンガ。</p>
                        <p>そこから生まれた新たな文化"コスプレ"を通じて世界とつながる。</p>
                        <p>あああああ</p>
                        <p>あああああ</p>
                        <br>
                        <p>あああああ</p>
                        <p>あああああ</p>

                    </div>
                    <br>
                    <hr class="hr-line">
                    <div class="company-profile">
                        <div class="company-info">
                            <h2>会社情報</h2>
                            <table>
                                <?php foreach ($company as $row): ?>
                                <tr>
                                    <th>社名</th>
                                    <td><?php echo htmlspecialchars($row['COMPANY_NAME']); ?></td>
                                </tr>
                                <tr>
                                    <th>設立</th>
                                    <td><?php echo htmlspecialchars($row['ESTABLISHMENT_DATE']); ?></td>
                                </tr>
                                <tr>
                                    <th>代表者</th>
                                    <td><?php echo htmlspecialchars($row['DIRECTOR']); ?></td>
                                </tr>
                                <tr>
                                    <th>所在地</th>
                                    <td>〒<?php echo htmlspecialchars($row['POST_CODE']); ?><br>
                                        <?php echo htmlspecialchars($row['LOCATION']); ?></td>
                                </tr>
                                <tr>
                                    <th>事業内容</th>
                                    <td><?php echo htmlspecialchars($row['CONTENT']); ?></td>
                                </tr>
                                <?php endforeach; ?>
                            </table>
                        </div>
                        <div class="company-map">
                            <div class="google-map">
                                <iframe
                                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3242.037965847441!2d139.7522089744507!3d35.65143623161238!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x60188bc9aa4d5501%3A0xe102ca70d90a035!2z44CSMTA1LTAwMTQg5p2x5Lqs6YO95riv5Yy66Iqd77yR5LiB55uu77yZ4oiS77ySIOODmeODq-ODoeOCvuODs-iKnQ!5e0!3m2!1sja!2sjp!4v1729588892291!5m2!1sja!2sjp"
                                    style="border:0;" allowfullscreen="" loading="lazy"
                                    referrerpolicy="no-referrer-when-downgrade"></iframe>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </main>


    <?php include 'footer.php'; ?>

    <script src="script.js"></script>
</body>

</html>