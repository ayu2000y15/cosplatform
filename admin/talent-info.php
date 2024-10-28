<?php
    $talentId = (string)$_REQUEST['TALENT_ID'];
    require_once('admin-db.php'); 
    $obj = new DbController();
    $talent = $obj->getTalent($talentId);

?>
<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>管理者ページ - COSPLATFORM</title>
    <link rel="stylesheet" href="admin-style.css">
</head>

<body>
    <?php include 'admin-header.php'; ?>
    <main>
        <section class="subpage-hero">
            <h1>タレント情報編集ページ</h1>
        </section>
        <div class="container">
            <div class="container-box">
                <div class="talent-edit">
                    <form class="talent-form" action="admin.php" method="POST">
                        <h2>タレント情報編集</h2>
                        <?php foreach ($talent as $row): ?>
                        <label>タレントID：<?php echo htmlspecialchars($row['TALENT_ID']); ?></label>
                        <div class="form-group">
                            <label for="TALENT_NAME">タレント名（本名）<span class="required">※HPには表示されません</span></label>
                            <input type="text" id="TALENT_NAME" name="TALENT_NAME"
                                value="<?php echo htmlspecialchars($row['TALENT_NAME']); ?>" />
                        </div>
                        <div class="form-group">
                            <label for="TALENT_FURIGANA_JP">タレント名　ふりがな（ひらがな）<span
                                    class="required">※HPには表示されません</span></label>
                            <input type="text" id="TALENT_FURIGANA_JP" name="TALENT_FURIGANA_JP"
                                value="<?php echo htmlspecialchars($row['TALENT_FURIGANA_JP']); ?>" />
                        </div>
                        <div class="form-group">
                            <label for="TALENT_FURIGANA_EP">タレント名　ふりがな（ローマ字）<span
                                    class="required">※HPには表示されません</span></label>
                            <input type="text" id="TALENT_FURIGANA_EN" name="TALENT_FURIGANA_EN"
                                value="<?php echo htmlspecialchars($row['TALENT_FURIGANA_EN']); ?>" />
                        </div>
                        <div class="form-group">
                            <label for="LAYER_NAME">レイヤーネーム（HPに表示する名前）<span class="required">必須</span></label>
                            <input type="text" id="LAYER_NAME" name="LAYER_NAME"
                                value="<?php echo htmlspecialchars($row['LAYER_NAME']); ?>" required />
                        </div>
                        <div class="form-group">
                            <label for="LAYER_FURIGANA_JP">レイヤーネーム　ふりがな（ひらがな）<span class="required">必須</span></label>
                            <input type="text" id="LAYER_FURIGANA_JP" name="LAYER_FURIGANA_JP"
                                value="<?php echo htmlspecialchars($row['LAYER_FURIGANA_JP']); ?>" required />
                        </div>
                        <div class="form-group">
                            <label for="LAYER_FURIGANA_EN">レイヤーネーム　ふりがな（ローマ字）<span class="required">必須</span></label>
                            <input type="text" id="LAYER_FURIGANA_EN" name="LAYER_FURIGANA_EN"
                                value="<?php echo htmlspecialchars($row['LAYER_FURIGANA_EN']); ?>" required />
                        </div>
                        <div class="form-group">
                            <label for="AFFILIATION_DATE">所属日<span class="required"></span></label>
                            <input type="text" id="AFFILIATION_DATE" name="AFFILIATION_DATE" value="<?php echo htmlspecialchars($row['AFFILIATION_DATE']); ?>" />
                        </div>
                        <div class="form-group">
                            <label for="RETIREMENT_DATE">退職日<span class="required"></span></label>
                            <input type="text" id="RETIREMENT_DATE" name="RETIREMENT_DATE" value="<?php echo htmlspecialchars($row['RETIREMENT_DATE']); ?>" />
                        </div>
                        <div class="form-group">
                            <label for="FOLLOWERS">フォロワー数（およそ）<span class="required"></span></label>
                            <input type="text" id="FOLLOWERS" name="FOLLOWERS"
                                value="<?php echo htmlspecialchars($row['FOLLOWERS']); ?>" />
                        </div>
                        <div class="form-group">
                            <label for="STREAM_FLG">配信可・不可<span class="required"></span></label>
                            <input type="text" id="STREAM_FLG" name="STREAM_FLG"
                                value="<?php echo htmlspecialchars($row['STREAM_FLG']); ?>" />
                        </div>
                        <div class="form-group">
                            <label for="COS_FLG">コスプレの種類（男装、女装）<span class="required"></span></label>
                            <input type="text" id="COS_FLG" name="COS_FLG"
                                value="<?php echo htmlspecialchars($row['COS_FLG']); ?>" />
                        </div>
                        <div class="form-group">
                            <label for="HEIGHT">身長<span class="required"></span></label>
                            <input type="text" id="HEIGHT" name="HEIGHT"
                                value="<?php echo htmlspecialchars($row['HEIGHT']); ?>" />
                        </div>
                        <div class="form-group">
                            <label for="AGE">年齢<span class="required"></span></label>
                            <input type="text" id="AGE" name="AGE"
                                value="<?php echo htmlspecialchars($row['AGE']); ?>" />
                        </div>
                        <div class="form-group">
                            <label for="BIRTHDAY">誕生日<span class="required"></span></label>
                            <input type="text" id="BIRTHDAY" name="BIRTHDAY"
                                value="<?php echo htmlspecialchars($row['BIRTHDAY']); ?>" />
                        </div>
                        <div class="form-group">
                            <label for="THREE_SIZES_B">スリーサイズ　バスト<span class="required"></span></label>
                            <input type="text" id="THREE_SIZES_B" name="THREE_SIZES_B"
                                value="<?php echo htmlspecialchars($row['THREE_SIZES_B']); ?>" />
                        </div>
                        <div class="form-group">
                            <label for="THREE_SIZES_W">スリーサイズ　ウエスト<span class="required"></span></label>
                            <input type="text" id="THREE_SIZES_W" name="THREE_SIZES_W"
                                value="<?php echo htmlspecialchars($row['THREE_SIZES_W']); ?>" />
                        </div>
                        <div class="form-group">
                            <label for="THREE_SIZES_H">スリーサイズ　ヒップ<span class="required"></span></label>
                            <input type="text" id="THREE_SIZES_H" name="THREE_SIZES_H"
                                value="<?php echo htmlspecialchars($row['THREE_SIZES_H']); ?>" />
                        </div>
                        <div class="form-group">
                            <label for="HOBBY_SPECIALTY">趣味・特技<span class="required"></span></label>
                            <input type="text" id="HOBBY_SPECIALTY" name="HOBBY_SPECIALTY"
                                value="<?php echo htmlspecialchars($row['HOBBY_SPECIALTY']); ?>" />
                        </div>
                        <div class="form-group">
                            <label for="COMMENT">紹介文・コメント<span class="required"></span></label>
                            <input type="text" id="COMMENT" name="COMMENT"
                                value="<?php echo htmlspecialchars($row['COMMENT']); ?>" />
                        </div>
                        <div class="form-group">
                            <label for="MAIL">メールアドレス<span class="required"></span></label>
                            <input type="MAIL" id="MAIL" name="MAIL"
                                value="<?php echo htmlspecialchars($row['MAIL']); ?>" />
                        </div>
                        <div class="form-group">
                            <label for="TEL_NO">電話番号<span class="required"></span></label>
                            <input type="text" id="TEL_NO" name="TEL_NO"
                                value="<?php echo htmlspecialchars($row['TEL_NO']); ?>" />
                        </div>
                        <div class="form-group">
                            <label for="SNS_1">X(旧Twitter) ID<span class="required"></span></label>
                            <input type="text" id="SNS_1" name="SNS_1"
                                value="<?php echo htmlspecialchars($row['SNS_1']); ?>" />
                        </div>
                        <div class="form-group">
                            <label for="SNS_2">Instagram ID<span class="required"></span></label>
                            <input type="text" id="SNS_2" name="SNS_2"
                                value="<?php echo htmlspecialchars($row['SNS_2']); ?>" />
                        </div>
                        <div class="form-group">
                            <label for="SNS_3">TikTok ID<span class="required"></span></label>
                            <input type="text" id="SNS_3" name="SNS_3"
                                value="<?php echo htmlspecialchars($row['SNS_3']); ?>" />
                        </div>
                        <?php endforeach; ?>
                        <button type="submit" class="submit-button">送信する</button>
                    </form>
                </div>
            </div>
        </div>
    </main>
    <script src="admin-script.js"></script>
</body>

</html>