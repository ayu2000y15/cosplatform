<?php
    // アクティブなタブを保持する変数を追加
    $activeTab = isset($_POST['active_tab']) ? $_POST['active_tab'] : 'talent-list';

    require_once('admin-db.php'); 
    $obj = new DbController();

    $exeId = '0';
    if(isset($_POST["EXE_ID"])){
        $exeId = (string)$_POST['EXE_ID'];
    }

    if ($exeId === '02') {
        $talentInfo = [
            "TALENT_NAME"           => $_POST['TALENT_NAME'],
            "TALENT_FURIGANA_JP"    => $_POST['TALENT_FURIGANA_JP'],
            "TALENT_FURIGANA_EN"    => $_POST['TALENT_FURIGANA_EN'],
            "LAYER_NAME"            => $_POST['LAYER_NAME'],
            "LAYER_FURIGANA_JP"     => $_POST['LAYER_FURIGANA_JP'],
            "LAYER_FURIGANA_EN"     => $_POST['LAYER_FURIGANA_EN'],
            "FOLLOWERS"             => (int)$_POST['FOLLOWERS'],
            "STREAM_FLG"            => $_POST['STREAM_FLG'],
            "COS_FLG"               => $_POST['COS_FLG'],
            "HEIGHT"                => (int)$_POST['HEIGHT'],
            "AGE"                   => (int)$_POST['AGE'],
            "BIRTHDAY"              => $_POST['BIRTHDAY'],
            "THREE_SIZES_B"         => (int)$_POST['THREE_SIZES_B'],
            "THREE_SIZES_W"         => (int)$_POST['THREE_SIZES_W'],
            "THREE_SIZES_H"         => (int)$_POST['THREE_SIZES_H'],
            "HOBBY_SPECIALTY"       => $_POST['HOBBY_SPECIALTY'],
            "COMMENT"               => $_POST['COMMENT'],
            "AFFILIATION_DATE"      => $_POST['AFFILIATION_DATE'],
            "RETIREMENT_DATE"       => null,
            "MAIL"                  => $_POST['MAIL'],
            "TEL_NO"                => $_POST['TEL_NO'],
            "SNS_1"                 => $_POST['SNS_1'],
            "SNS_2"                 => $_POST['SNS_2'],
            "SNS_3"                 => $_POST['SNS_3']
        ];

        $threeSizesFlg = '0';
        if($_POST['THREE_SIZES_B_FLG'] === '1' || $_POST['THREE_SIZES_W_FLG'] === '1' || $_POST['THREE_SIZES_H_FLG'] === '1'){
            $threeSizesFlg = '1';
        }

        $viewInfo = [
            "FOLLOWERS_FLG"       => $_POST['FOLLOWERS_FLG'],
            "HEIGHT_FLG"          => $_POST['HEIGHT_FLG'],
            "AGE_FLG"             => $_POST['AGE_FLG'],
            "BIRTHDAY_FLG"        => $_POST['BIRTHDAY_FLG'],
            "THREE_SIZES_FLG"     => $threeSizesFlg,
            "THREE_SIZES_B_FLG"   => $_POST['THREE_SIZES_B_FLG'],
            "THREE_SIZES_W_FLG"   => $_POST['THREE_SIZES_W_FLG'],
            "THREE_SIZES_H_FLG"   => $_POST['THREE_SIZES_H_FLG'],
            "HOBBY_SPECIALTY_FLG" => $_POST['HOBBY_SPECIALTY_FLG'],
            "COMMENT_FLG"         => $_POST['COMMENT_FLG'],
            "SNS_1_FLG"           => $_POST['SNS_1_FLG'],
            "SNS_2_FLG"           => $_POST['SNS_2_FLG'],
            "SNS_3_FLG"           => $_POST['SNS_3_FLG']
        ];

        //TALENTに登録
        $obj->insertTalent($talentInfo);
        //TALENT_INFO_CTLに登録
        $obj->insertTalentInfoCtl($viewInfo);

        //TALENT_TAGに登録
        //COS_FLG = '1' 男装
        if($_POST['COS_FLG'] === '1'){
            $obj->insertTalentTagF('男装');
        }
        //COS_FLG = '2' 女装
        if($_POST['COS_FLG'] === '2'){
            $obj->insertTalentTagF('女装');
        }
        //COS_FLG = '3' 男装・女装
        if($_POST['COS_FLG'] === '3'){
            $obj->insertTalentTagF('男装');
            $obj->insertTalentTagF('女装');
        }

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            header("Location:00-admin.php");
        }
    }
?>

<!DOCTYPE html>
<html lang="ja">

<script>
console.log('<?php echo $_SERVER["REQUEST_METHOD"] . ':' . $exeId; ?>')
</script>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>管理者ページ - COSPLATFORM</title>
    <link rel="stylesheet" href="admin-style.css">
</head>

<body>
    <?php include '00-admin-header.php'; ?>
    <main>
        <section class="subpage-hero">
            <h1>管理者ページ</h1>
        </section>
        <div class="container">
            <div class="container-box">
                <section class="admin">
                    <!-- 送信が行われたらメッセージを表示する -->
                    <?php if(isset($_POST["MESS"])): ?>
                    <br>
                    <h4 style="color:blue;"><?php echo htmlspecialchars($_POST["MESS"]); ?></h4>
                    <?php endif; ?>
                    <div class="tabs">
                        <div class="tab-buttons">
                            <button class="tab-button <?php echo $activeTab === 'talent-list' ? 'active' : ''; ?>"
                                data-tab="talent-list">タレント一覧</button>
                            <button class="tab-button <?php echo $activeTab === 'talent-entry' ? 'active' : ''; ?>"
                                data-tab="talent-entry">タレント登録</button>
                            <button class="tab-button <?php echo $activeTab === 'news-entry' ? 'active' : ''; ?>"
                                data-tab="news-entry">ニュース登録・変更</button>
                            <button class="tab-button <?php echo $activeTab === 'photos-entry' ? 'active' : ''; ?>"
                                data-tab="photos-entry">HP画像登録・変更</button>
                            <button class="tab-button <?php echo $activeTab === 'tag-entry' ? 'active' : ''; ?>"
                                data-tab="tag-entry">ハッシュタグ登録・変更</button>
                        </div>

                        <div class="tab-content <?php echo $activeTab === 'talent-list' ? 'active' : ''; ?>"
                            id="talent-list">
                            <?php include '01-admin-talent-list.php'; ?>
                        </div>

                        <div class="tab-content <?php echo $activeTab === 'talent-entry' ? 'active' : ''; ?>"
                            id="talent-entry">
                            <?php include '02-admin-talent-entry.php'; ?>
                        </div>

                        <div class="tab-content <?php echo $activeTab === 'news-entry' ? 'active' : ''; ?>"
                            id="news-entry">
                            <?php include '03-admin-news-entry.php'; ?>
                        </div>

                        <div class="tab-content <?php echo $activeTab === 'photos-entry' ? 'active' : ''; ?>"
                            id="photos-entry">
                            <?php include '04-admin-photos-entry.php'; ?>
                        </div>

                        <div class="tab-content <?php echo $activeTab === 'tag-entry' ? 'active' : ''; ?>"
                            id="tag-entry">
                            <?php include '05-admin-tag-entry.php'; ?>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </main>
    <script src="admin-script.js"></script>
</body>

</html>