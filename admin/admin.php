<?php

    require_once('admin-db.php'); 
    $obj = new DbController();
    $talentList = $obj->getTalentList();

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
            <h1>管理者ページ</h1>
        </section>
        <div class="container">
            <div class="container-box">
                <div class="talentList">
                    <?php foreach ($talentList as $row): ?>
                    <form method="post" name="<?php echo 'talent' . $row['TALENT_ID'] ?>" action="talent-info.php">
                        <input type="hidden" name="TALENT_ID"
                            value="<?php echo htmlspecialchars($row['TALENT_ID']); ?>">
                    <a href="<?php echo 'javascript:talent' . $row['TALENT_ID'] . '.submit()'?>"><?php echo htmlspecialchars($row['LAYER_NAME']); ?></a>
                    </form>
                    <?php endforeach; ?>
                </div>
                <hr class="hr-line">
                <div class="talent-insert">
                    <form class="talent-form" action="admin.php" method="POST">
                    <h2>新規タレント登録</h2>
                        <div class="form-group">
                            <label for="TALENT_NAME">タレント名（本名）<span class="required">※HPには表示されません</span></label>
                            <input type="text" id="TALENT_NAME" name="TALENT_NAME" />
                        </div>
                        <div class="form-group">
                            <label for="TALENT_FURIGANA_JP">タレント名　ふりがな（ひらがな）<span class="required">※HPには表示されません</span></label>
                            <input type="text" id="TALENT_FURIGANA_JP" name="TALENT_FURIGANA_JP" />
                        </div>
                        <div class="form-group">
                            <label for="TALENT_FURIGANA_JP">タレント名　ふりがな（ローマ字）<span class="required">※HPには表示されません</span></label>
                            <input type="text" id="TALENT_FURIGANA_JP" name="TALENT_FURIGANA_JP" />
                        </div>
                        <div class="form-group">
                            <label for="LAYER_NAME">レイヤーネーム（HPに表示する名前）<span class="required">必須</span></label>
                            <input type="text" id="LAYER_NAME" name="LAYER_NAME" required />
                        </div>
                        <div class="form-group">
                            <label for="LAYER_FURIGANA_JP">レイヤーネーム　ふりがな（ひらがな）<span class="required">必須</span></label>
                            <input type="text" id="LAYER_FURIGANA_JP" name="LAYER_FURIGANA_JP" required />
                        </div>
                        <div class="form-group">
                            <label for="LAYER_FURIGANA_EN">レイヤーネーム　ふりがな（ローマ字）<span class="required">必須</span></label>
                            <input type="text" id="LAYER_FURIGANA_EN" name="LAYER_FURIGANA_EN" required />
                        </div>
                        <div class="form-group">
                            <label for="AFFILIATION_DATE">所属日<span class="required"></span></label>
                            <input type="text" id="AFFILIATION_DATE" name="AFFILIATION_DATE" />
                        </div>
                        <div class="form-group">
                            <label for="RETIREMENT_DATE">退職日<span class="required"></span></label>
                            <input type="text" id="RETIREMENT_DATE" name="RETIREMENT_DATE" />
                        </div>
                        <div class="form-group">
                            <label for="FOLLOWERS">フォロワー数（およそ）<span class="required"></span></label>
                            <input type="text" id="FOLLOWERS" name="FOLLOWERS" />
                        </div>
                        <div class="form-group">
                            <label for="STREAM_FLG">配信可・不可<span class="required"></span></label>
                            <input type="text" id="STREAM_FLG" name="STREAM_FLG" />
                        </div>
                        <div class="form-group">
                            <label for="COS_FLG">コスプレの種類（男装、女装）<span class="required"></span></label>
                            <input type="text" id="COS_FLG" name="COS_FLG" />
                        </div>
                        <div class="form-group">
                            <label for="HEIGHT">身長<span class="required"></span></label>
                            <input type="text" id="HEIGHT" name="HEIGHT" />
                        </div>
                        <div class="form-group">
                            <label for="AGE">年齢<span class="required"></span></label>
                            <input type="text" id="AGE" name="AGE" />
                        </div>
                        <div class="form-group">
                            <label for="BIRTHDAY">誕生日<span class="required"></span></label>
                            <input type="text" id="BIRTHDAY" name="BIRTHDAY" />
                        </div>
                        <div class="form-group">
                            <label for="THREE_SIZES_B">スリーサイズ　バスト<span class="required"></span></label>
                            <input type="text" id="THREE_SIZES_B" name="THREE_SIZES_B" />
                        </div>
                        <div class="form-group">
                            <label for="THREE_SIZES_W">スリーサイズ　ウエスト<span class="required"></span></label>
                            <input type="text" id="THREE_SIZES_W" name="THREE_SIZES_W" />
                        </div>
                        <div class="form-group">
                            <label for="THREE_SIZES_H">スリーサイズ　ヒップ<span class="required"></span></label>
                            <input type="text" id="THREE_SIZES_H" name="THREE_SIZES_H" />
                        </div>
                        <div class="form-group">
                            <label for="HOBBY_SPECIALTY">趣味・特技<span class="required"></span></label>
                            <input type="text" id="HOBBY_SPECIALTY" name="HOBBY_SPECIALTY" />
                        </div>
                        <div class="form-group">
                            <label for="COMMENT">紹介文・コメント<span class="required"></span></label>
                            <input type="text" id="COMMENT" name="COMMENT" />
                        </div>
                        <div class="form-group">
                            <label for="MAIL">メールアドレス<span class="required"></span></label>
                            <input type="MAIL" id="MAIL" name="MAIL" />
                        </div>
                        <div class="form-group">
                            <label for="TEL_NO">電話番号<span class="required"></span></label>
                            <input type="text" id="TEL_NO" name="TEL_NO" />
                        </div>
                        <div class="form-group">
                            <label for="SNS_1">X(旧Twitter) ID<span class="required"></span></label>
                            <input type="text" id="SNS_1" name="SNS_1" />
                        </div>
                        <div class="form-group">
                            <label for="SNS_2">Instagram ID<span class="required"></span></label>
                            <input type="text" id="SNS_2" name="SNS_2" />
                        </div>
                        <div class="form-group">
                            <label for="SNS_3">TikTok ID<span class="required"></span></label>
                            <input type="text" id="SNS_3" name="SNS_3" />
                        </div>
                        <button type="submit" class="submit-button">送信する</button>
                    </form>
                </div>
            </div>
        </div>
    </main>
    <script src="admin-script.js"></script>
</body>

</html>