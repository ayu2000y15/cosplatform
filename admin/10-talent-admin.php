<?php
    // アクティブなタブを保持する変数を追加
    $activeTab = isset($_POST['active_tab']) ? $_POST['active_tab'] : 'talent-edit';

    $talentId = (string)$_POST['TALENT_ID'];
    $exeId = $_POST['EXE_ID'];

    require_once('admin-db.php'); 
    $obj = new DbController();

    $talent = $obj->getTalent($talentId);
    foreach ($talent as $row){
        $layerName = $row['LAYER_NAME'];
    }

    //タレント情報更新
    if ($exeId === '11'){
        $exeId = '11 ok';

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
            "RETIREMENT_DATE"       => $_POST['RETIREMENT_DATE'],
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

        //TALENT更新
        $obj->updateTalent($talentId, $talentInfo);
        //TALENT_INFO_CTL更新
        $obj->updateTalentInfoCtl($talentId, $viewInfo);

        //TALENT_TAG更新(更新前に一度削除する)
        $obj->deleteTalentTag($talentId, '1');
        $obj->deleteTalentTag($talentId, '2');
        //COS_FLG = '1' 男装
        if($_POST['COS_FLG'] === '1'){
            $obj->insertTalentTag($talentId, '1');
        }
        //COS_FLG = '2' 女装
        if($_POST['COS_FLG'] === '2'){
            $obj->insertTalentTag($talentId, '2');
        }
        //COS_FLG = '3' 男装・女装
        if($_POST['COS_FLG'] === '3'){
            $obj->insertTalentTag($talentId, '1');
            $obj->insertTalentTag($talentId, '2');
        }
        $message = "タレント情報の更新が行われました。";
    }

    $dirName = $talentId . '_' . $row['LAYER_NAME'];
    //タレント写真削除
    if ($exeId === '12_1'){
        $exeId = '12_1 ok';
        if (unlink('../img/' . $dirName . '/' . $_POST["FILE_NAME"])){
            $obj->deleteTalentImg($_POST["FILE_NAME"], $talentId);
            $message = $_POST['FILE_NAME'].'の削除に成功しました。';
        }else{
            $error = $_POST['FILE_NAME'].'の削除に失敗しました。';
        }
    }

    //タレント写真変更
    if ($exeId === '12_2'){
        $exeId = '12_2 ok';
        $obj->updateTalentImg($_POST["FILE_NAME"], $_POST["VIEW_FLG_BEF"], $_POST["VIEW_FLG_AFT"]);
        $message = "タレントの写真が変更されました。";
    }

    //タレント写真登録
    if ($exeId === '12_3'){
        $exeId = '12_3 ok';
        // ディレクトリの命名規則
        $uploadDir = 'img/' . $dirName . '/' ; 
        if (!file_exists('../' . $uploadDir)) {
            mkdir('../' .$uploadDir, 0777, true);
        }
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (isset($_FILES['upfile'])) {
                $uploadedFiles = $_FILES['upfile'];
                require_once('file-upload.php'); 
                $obj = new FileUpload();
                $result = $obj->uploadFiles($uploadedFiles, $uploadDir, $talentId);
                if ($result['success']) {
                    $message = "ファイルが正常にアップロードされました。登録済みの写真一覧から表示先を設定してください。";
                } else {
                    $error = "ファイルのアップロードに失敗しました: " . $result['message'];
                }
            }
        }
        

    }

    //タレント経歴登録
    if ($exeId === '13_1'){
        $exeId = '13_1 ok';
        $obj->insertTalentCareer($talentId, $_POST["CAREER_CATEGORY_ID"], $_POST["CONTENT"],$_POST["ACTIVE_DATE"], $_POST["DETAIL"]);
        $message = "タレントの経歴が登録されました。";
    }

    //タレント経歴削除
    if ($exeId === '13_2'){
        $exeId = '13_2 ok';
        $obj->deleteTalentCareer($_POST["CAREER_ID"]);
        $message = "タレントの経歴が削除されました。";
    }

    //タレント経歴更新
    if ($exeId === '13_3'){
        $exeId = '13_3 ok';
        $careerList = [
            "CAREER_ID"          => $_POST['CAREER_ID'],
            "CAREER_CATEGORY_ID" => $_POST['CAREER_CATEGORY_ID'],
            "CONTENT"            => $_POST['CONTENT'],
            "ACTIVE_DATE"        => $_POST['ACTIVE_DATE'],
            "DETAIL"             => $_POST['DETAIL']
        ];
        $obj->updateTalentCareer($careerList);
        $message = "タレントの経歴が更新されました。";
    }

    //タレントのタグを削除
    if ($exeId === '14_1') {
        $exeId = '14_1 ok'; 
        $obj->deleteTalentTag($talentId, $_POST['TAG_ID']);
        $message = "タグが削除されました。";
    }
    //タレント情報にタグを登録
    if ($exeId === '14_2') {
        $exeId = '14_2 ok'; 
        $obj->insertTalentTag($talentId, $_POST['TAG_ID']);
        $message = "タグが登録されました。";
    }
    //新規タグを登録
    if ($exeId === '14_3') {
        $exeId = '14_3 ok'; 
        $obj->insertMTag($_POST['TAG_NAME'], $_POST['TAG_COLOR']);
        $message = "新しいタグが追加されました。タレントにタグを追加してください。";
    }

    //タレント削除処理
    if($exeId === '15'){
        $exeId = '15 ok'; 
        $obj->deleteTalent( $_POST["RETIREMENT_DATE"],$talentId);
        $message = "タレントの退職日を登録しました。";
    }

?>

<script>
console.log('<?php echo $_SERVER["REQUEST_METHOD"] . ':' . $exeId; ?>')
</script>
<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>管理者ページ - COSPLATFORM</title>
    <link rel="stylesheet" href="admin-style.css">
</head>

<body>
    <a id="top"></a>
    <?php include '00-admin-header.php'; ?>
    <main>
        <section class="subpage-hero">
            <h1>タレント管理</h1>
        </section>
        <a href="#top" class="back-to-top">トップへ戻る</a>
        <div class="container">
            <div class="container-box">
                <div class="talent-header">
                    <a href="00-admin.php">管理画面トップに戻る</a>
                    <h3>タレントID：<?php echo htmlspecialchars($talentId); ?></h3>
                    <h3>レイヤーネーム：<?php echo htmlspecialchars($layerName); ?></h3>
                </div>

                <!-- 送信が行われたらメッセージを表示する -->
                <?php if (isset($message)): ?>
                <div class="success-message"><?php echo $message; ?></div>
                <?php endif; ?>
                <?php if (isset($error)): ?>
                <div class="error-message"><?php echo $error; ?></div>
                <?php endif; ?>

                <div class="tabs">
                    <div class="tab-buttons">
                        <button class="tab-button <?php echo $activeTab === 'talent-edit' ? 'active' : ''; ?>"
                            data-tab="talent-edit">タレント情報変更</button>
                        <button class="tab-button <?php echo $activeTab === 'talent-photos' ? 'active' : ''; ?>"
                            data-tab="talent-photos">タレント写真登録・変更</button>
                        <button class="tab-button <?php echo $activeTab === 'talent-career' ? 'active' : ''; ?>"
                            data-tab="talent-career">タレント経歴登録・変更</button>
                        <button class="tab-button <?php echo $activeTab === 'talent-tag' ? 'active' : ''; ?>"
                            data-tab="talent-tag">ハッシュタグ登録・変更</button>
                        <button class="tab-button <?php echo $activeTab === 'talent-retire' ? 'active' : ''; ?>"
                            data-tab="talent-retire">タレント退職</button>
                    </div>

                    <div class="tab-content <?php echo $activeTab === 'talent-edit' ? 'active' : ''; ?>"
                        id="talent-edit">
                        <?php include '11-talent-edit.php'; ?>
                    </div>

                    <div class="tab-content <?php echo $activeTab === 'talent-photos' ? 'active' : ''; ?>"
                        id="talent-photos">
                        <?php include '12-talent-photos.php'; ?>
                    </div>

                    <div class="tab-content <?php echo $activeTab === 'talent-career' ? 'active' : ''; ?>"
                        id="talent-career">
                        <?php include '13-talent-career.php'; ?>
                    </div>

                    <div class="tab-content <?php echo $activeTab === 'talent-tag' ? 'active' : ''; ?>" id="talent-tag">
                        <?php include '14-talent-tag.php'; ?>
                    </div>

                    <div class="tab-content <?php echo $activeTab === 'talent-retire' ? 'active' : ''; ?>"
                        id="talent-retire">
                        <?php include '15-talent-retire.php'; ?>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <script src="admin-script.js"></script>
</body>

</html>