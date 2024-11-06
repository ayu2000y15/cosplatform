<?php

    $talentId = (string)$_REQUEST['TALENT_ID'];
    require_once('admin-db.php'); 
    $obj = new DbController();

    $talent = $obj->getTalent($talentId);
    $viewInfo = $obj->getTalentInfoCtl($talentId);

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
            <h2>タレント情報変更</h2>

            <?php foreach ($talent as $row): ?>
            <?php foreach ($viewInfo as $view): ?>
            <form onsubmit="return checkSubmit('登録');" action="10-talent-admin.php" method="POST">
                <input type="hidden" name="EXE_ID" value="11">
                <input type="hidden" name="active_tab" value="talent-edit">
                <input type="hidden" name="TALENT_ID" value="<?php echo $talentId ?>">

                <div class="form-group">
                    <label for="TALENT_NAME">タレント名（本名）<span class="required">※HPには表示されません</span></label>
                    <input type="text" id="TALENT_NAME" name="TALENT_NAME" placeholder="山田太郎"
                        value="<?php echo htmlspecialchars($row['TALENT_NAME']); ?>" />
                </div>
                <div class="form-group">
                    <label for="TALENT_FURIGANA_JP">タレント名　ふりがな（ひらがな）<span class="required">※HPには表示されません</span></label>
                    <input type="text" id="TALENT_FURIGANA_JP" name="TALENT_FURIGANA_JP" placeholder="やまだたろう"
                        value="<?php echo htmlspecialchars($row['TALENT_FURIGANA_JP']); ?>" />
                </div>
                <div class="form-group">
                    <label for="TALENT_FURIGANA_EN">タレント名　ふりがな（ローマ字）<span class="required">※HPには表示されません</span></label>
                    <input type="text" id="TALENT_FURIGANA_EN" name="TALENT_FURIGANA_EN" placeholder="YamadaTaro"
                        value="<?php echo htmlspecialchars($row['TALENT_FURIGANA_EN']); ?>" />
                </div>
                <div class="form-group">
                    <label for="LAYER_NAME">レイヤーネーム（HPに表示する名前）<span class="required">必須</span></label>
                    <input type="text" id="LAYER_NAME" name="LAYER_NAME" placeholder="やまだ"
                        value="<?php echo htmlspecialchars($row['LAYER_NAME']); ?>" required />
                </div>
                <div class="form-group">
                    <label for="LAYER_FURIGANA_JP">レイヤーネーム　ふりがな（ひらがな）<span class="required">必須</span></label>
                    <input type="text" id="LAYER_FURIGANA_JP" name="LAYER_FURIGANA_JP" placeholder="やまだ"
                        value="<?php echo htmlspecialchars($row['LAYER_FURIGANA_JP']); ?>" required />
                </div>
                <div class="form-group">
                    <label for="LAYER_FURIGANA_EN">レイヤーネーム　ふりがな（ローマ字）<span class="required">必須</span></label>
                    <input type="text" id="LAYER_FURIGANA_EN" name="LAYER_FURIGANA_EN" placeholder="Yamada"
                        value="<?php echo htmlspecialchars($row['LAYER_FURIGANA_EN']); ?>" required />
                </div>
                <div class="form-group">
                    <label for="AFFILIATION_DATE">所属日<span class="required"></span></label>
                    <input type="date" id="AFFILIATION_DATE" name="AFFILIATION_DATE"
                        value="<?php echo htmlspecialchars($row['AFFILIATION_DATE']); ?>" />
                </div>
                <div class="form-group">
                    <label for="RETIREMENT_DATE">退職日<span class="required"></span></label>
                    <input type="date" id="RETIREMENT_DATE" name="RETIREMENT_DATE"
                        value="<?php echo htmlspecialchars($row['RETIREMENT_DATE']); ?>" />
                </div>
                <div class="form-group">
                    <label for="MAIL">メールアドレス<span class="required"></span></label>
                    <input type="mail" id="MAIL" name="MAIL" placeholder="example@gmail.com"
                        value="<?php echo htmlspecialchars($row['MAIL']); ?>" />
                </div>
                <div class="form-group">
                    <label for="TEL_NO">電話番号<span class="required"></span></label>
                    <input type="tel" id="TEL_NO" name="TEL_NO" pattern="[0-9]{3}-[0-9]{4}-[0-9]{4}"
                        value="<?php echo htmlspecialchars($row['TEL_NO']); ?>" placeholder="080-1234-5678" />
                </div>

                <!-- ここから表示情報 -->
                <div class="form-group">
                    <div class="check-area">
                        <label for="FOLLOWERS">フォロワー数（およそ）<span class="required"></span></label>
                        <div class="check-box">
                            <?php if($view['FOLLOWERS_FLG']==='0'): ?>
                            <label class="checkbox-label">
                                <input type="radio" name="FOLLOWERS_FLG" value="0" checked />
                                非公開
                            </label>
                            <label class="checkbox-label">
                                <input type="radio" id="FOLLOWERS_FLG" name="FOLLOWERS_FLG" value="1" />
                                公開する
                            </label>
                            <?php endif; ?>
                            <?php if($view['FOLLOWERS_FLG']==='1'): ?>
                            <label class="checkbox-label">
                                <input type="radio" name="FOLLOWERS_FLG" value="0" />
                                非公開
                            </label>
                            <label class="checkbox-label">
                                <input type="radio" id="FOLLOWERS_FLG" name="FOLLOWERS_FLG" value="1" checked />
                                公開する
                            </label>
                            <?php endif; ?>
                        </div>
                    </div>
                    <input type="number" id="FOLLOWERS" name="FOLLOWERS" placeholder="100"
                        value="<?php echo htmlspecialchars($row['FOLLOWERS']); ?>" />
                </div>
                <div class="form-group">
                    <label for="STREAM_FLG">配信可・不可<span class="required"></span></label>
                    <?php if($row['STREAM_FLG']==='0') : ?>
                    <select id="STREAM_FLG" name="STREAM_FLG">
                        <option value="0">配信不可</option>
                        <option value="1">配信可</option>
                    </select>
                    <?php endif; ?>
                    <?php if($row['STREAM_FLG']==='1') : ?>
                    <select id="STREAM_FLG" name="STREAM_FLG">
                        <option value="1">配信可</option>
                        <option value="0">配信不可</option>
                    </select>
                    <?php endif; ?>
                </div>
                <div class="form-group">
                    <label for="COS_FLG">コスプレの種類（男装、女装）<span class="required"></span></label>
                    <?php if($row['COS_FLG']==='1' || empty($row['COS_FLG'])) : ?>
                    <select id="COS_FLG" name="COS_FLG">
                        <option value="1">男装</option>
                        <option value="2">女装</option>
                        <option value="3">男装・女装</option>
                    </select>
                    <?php endif; ?>
                    <?php if($row['COS_FLG']==='2') : ?>
                    <select id="COS_FLG" name="COS_FLG">
                        <option value="2">女装</option>
                        <option value="1">男装</option>
                        <option value="3">男装・女装</option>
                    </select>
                    <?php endif; ?>
                    <?php if($row['COS_FLG']==='3') : ?>
                    <select id="COS_FLG" name="COS_FLG">
                        <option value="3">男装・女装</option>
                        <option value="1">男装</option>
                        <option value="2">女装</option>
                    </select>
                    <?php endif; ?>
                </div>
                <div class="form-group">
                    <div class="check-area">
                        <label for="HEIGHT">身長<span class="required"></span></label>
                        <div class="check-box">
                            <?php if($view['HEIGHT_FLG']==='0'): ?>
                            <label class="checkbox-label">
                                <input type="radio" name="HEIGHT_FLG" value="0" checked />
                                非公開
                            </label>
                            <label class="checkbox-label">
                                <input type="radio" id="HEIGHT_FLG" name="HEIGHT_FLG" value="1" />
                                公開する
                            </label>
                            <?php endif; ?>
                            <?php if($view['HEIGHT_FLG']==='1'): ?>
                            <label class="checkbox-label">
                                <input type="radio" name="HEIGHT_FLG" value="0" />
                                非公開
                            </label>
                            <label class="checkbox-label">
                                <input type="radio" id="HEIGHT_FLG" name="HEIGHT_FLG" value="1" checked />
                                公開する
                            </label>
                            <?php endif; ?>
                        </div>
                    </div>
                    <input type="number" id="HEIGHT" name="HEIGHT"
                        value="<?php echo htmlspecialchars($row['HEIGHT']); ?>" placeholder="172" />
                </div>
                <div class="form-group">
                    <div class="check-area">
                        <label for="AGE">年齢<span class="required"></span></label>
                        <div class="check-box">
                            <?php if($view['AGE_FLG']==='0'): ?>
                            <label class="checkbox-label">
                                <input type="radio" name="AGE_FLG" value="0" checked />
                                非公開
                            </label>
                            <label class="checkbox-label">
                                <input type="radio" id="AGE_FLG" name="AGE_FLG" value="1" />
                                公開する
                            </label>
                            <?php endif; ?>
                            <?php if($view['AGE_FLG']==='1'): ?>
                            <label class="checkbox-label">
                                <input type="radio" name="AGE_FLG" value="0" />
                                非公開
                            </label>
                            <label class="checkbox-label">
                                <input type="radio" id="AGE_FLG" name="AGE_FLG" value="1" checked />
                                公開する
                            </label>
                            <?php endif; ?>
                        </div>
                    </div>
                    <input type="number" id="AGE" name="AGE" value="<?php echo htmlspecialchars($row['AGE']); ?>"
                        placeholder="25" />
                </div>
                <div class="form-group">
                    <div class="check-area">
                        <label for="BIRTHDAY">誕生日<span class="required"></span></label>
                        <div class="check-box">
                            <?php if($view['BIRTHDAY_FLG']==='0'): ?>
                            <label class="checkbox-label">
                                <input type="radio" name="BIRTHDAY_FLG" value="0" checked />
                                非公開
                            </label>
                            <label class="checkbox-label">
                                <input type="radio" id="BIRTHDAY_FLG" name="BIRTHDAY_FLG" value="1" />
                                公開する
                            </label>
                            <?php endif; ?>
                            <?php if($view['BIRTHDAY_FLG']==='1'): ?>
                            <label class="checkbox-label">
                                <input type="radio" name="BIRTHDAY_FLG" value="0" />
                                非公開
                            </label>
                            <label class="checkbox-label">
                                <input type="radio" id="BIRTHDAY_FLG" name="BIRTHDAY_FLG" value="1" checked />
                                公開する
                            </label>
                            <?php endif; ?>
                        </div>
                    </div>
                    <input type="date" id="BIRTHDAY" name="BIRTHDAY"
                        value="<?php echo htmlspecialchars($row['BIRTHDAY']); ?>" />
                </div>
                <div class="form-group">
                    <div class="check-area">
                        <label for="THREE_SIZES_B">スリーサイズ　バスト<span class="required"></span></label>
                        <div class="check-box">
                            <?php if($view['THREE_SIZES_B_FLG']==='0'): ?>
                            <label class="checkbox-label">
                                <input type="radio" name="THREE_SIZES_B_FLG" value="0" checked />
                                非公開
                            </label>
                            <label class="checkbox-label">
                                <input type="radio" id="THREE_SIZES_B_FLG" name="THREE_SIZES_B_FLG" value="1" />
                                公開する
                            </label>
                            <?php endif; ?>
                            <?php if($view['THREE_SIZES_B_FLG']==='1'): ?>
                            <label class="checkbox-label">
                                <input type="radio" name="THREE_SIZES_B_FLG" value="0" />
                                非公開
                            </label>
                            <label class="checkbox-label">
                                <input type="radio" id="THREE_SIZES_B_FLG" name="THREE_SIZES_B_FLG" value="1" checked />
                                公開する
                            </label>
                            <?php endif; ?>
                        </div>
                    </div>
                    <input type="number" id="THREE_SIZES_B" name="THREE_SIZES_B"
                        value="<?php echo htmlspecialchars($row['THREE_SIZES_B']); ?>" placeholder="75" />
                </div>
                <div class="form-group">
                    <div class="check-area">
                        <label for="THREE_SIZES_W">スリーサイズ　ウエスト<span class="required"></span></label>
                        <div class="check-box">
                            <?php if($view['THREE_SIZES_W_FLG']==='0'): ?>
                            <label class="checkbox-label">
                                <input type="radio" name="THREE_SIZES_W_FLG" value="0" checked />
                                非公開
                            </label>
                            <label class="checkbox-label">
                                <input type="radio" id="THREE_SIZES_W_FLG" name="THREE_SIZES_W_FLG" value="1" />
                                公開する
                            </label>
                            <?php endif; ?>
                            <?php if($view['THREE_SIZES_W_FLG']==='1'): ?>
                            <label class="checkbox-label">
                                <input type="radio" name="THREE_SIZES_W_FLG" value="0" />
                                非公開
                            </label>
                            <label class="checkbox-label">
                                <input type="radio" id="THREE_SIZES_W_FLG" name="THREE_SIZES_W_FLG" value="1" checked />
                                公開する
                            </label>
                            <?php endif; ?>
                        </div>
                    </div>
                    <input type="number" id="THREE_SIZES_W" name="THREE_SIZES_W"
                        value="<?php echo htmlspecialchars($row['THREE_SIZES_W']); ?>" placeholder="55" />
                </div>
                <div class="form-group">
                    <div class="check-area">
                        <label for="THREE_SIZES_H">スリーサイズ　ヒップ<span class="required"></span></label>
                        <div class="check-box">
                            <?php if($view['THREE_SIZES_H_FLG']==='0'): ?>
                            <label class="checkbox-label">
                                <input type="radio" name="THREE_SIZES_H_FLG" value="0" checked />
                                非公開
                            </label>
                            <label class="checkbox-label">
                                <input type="radio" id="THREE_SIZES_H_FLG" name="THREE_SIZES_H_FLG" value="1" />
                                公開する
                            </label>
                            <?php endif; ?>
                            <?php if($view['THREE_SIZES_H_FLG']==='1'): ?>
                            <label class="checkbox-label">
                                <input type="radio" name="THREE_SIZES_H_FLG" value="0" />
                                非公開
                            </label>
                            <label class="checkbox-label">
                                <input type="radio" id="THREE_SIZES_H_FLG" name="THREE_SIZES_H_FLG" value="1" checked />
                                公開する
                            </label>
                            <?php endif; ?>
                        </div>
                    </div>
                    <input type="number" id="THREE_SIZES_H" name="THREE_SIZES_H"
                        value="<?php echo htmlspecialchars($row['THREE_SIZES_H']); ?>" placeholder="75" />
                </div>
                <div class="form-group">
                    <div class="check-area">
                        <label for="HOBBY_SPECIALTY">趣味・特技<span class="required"></span></label>
                        <div class="check-box">
                            <?php if($view['HOBBY_SPECIALTY_FLG']==='0'): ?>
                            <label class="checkbox-label">
                                <input type="radio" name="HOBBY_SPECIALTY_FLG" value="0" checked />
                                非公開
                            </label>
                            <label class="checkbox-label">
                                <input type="radio" id="HOBBY_SPECIALTY_FLG" name="HOBBY_SPECIALTY_FLG" value="1" />
                                公開する
                            </label>
                            <?php endif; ?>
                            <?php if($view['HOBBY_SPECIALTY_FLG']==='1'): ?>
                            <label class="checkbox-label">
                                <input type="radio" name="HOBBY_SPECIALTY_FLG" value="0" />
                                非公開
                            </label>
                            <label class="checkbox-label">
                                <input type="radio" id="HOBBY_SPECIALTY_FLG" name="HOBBY_SPECIALTY_FLG" value="1"
                                    checked />
                                公開する
                            </label>
                            <?php endif; ?>
                        </div>
                    </div>
                    <input type="text" id="HOBBY_SPECIALTY" name="HOBBY_SPECIALTY"
                        value="<?php echo htmlspecialchars($row['HOBBY_SPECIALTY']); ?>" placeholder="カラオケ・食べること" />
                </div>
                <div class="form-group">
                    <div class="check-area">
                        <label for="COMMENT">紹介文・コメント<span class="required"></span></label>
                        <div class="check-box">
                            <?php if($view['COMMENT_FLG']==='0'): ?>
                            <label class="checkbox-label">
                                <input type="radio" name="COMMENT_FLG" value="0" checked />
                                非公開
                            </label>
                            <label class="checkbox-label">
                                <input type="radio" id="COMMENT_FLG" name="COMMENT_FLG" value="1" />
                                公開する
                            </label>
                            <?php endif; ?>
                            <?php if($view['COMMENT_FLG']==='1'): ?>
                            <label class="checkbox-label">
                                <input type="radio" name="COMMENT_FLG" value="0" />
                                非公開
                            </label>
                            <label class="checkbox-label">
                                <input type="radio" id="COMMENT_FLG" name="COMMENT_FLG" value="1" checked />
                                公開する
                            </label>
                            <?php endif; ?>
                        </div>
                    </div>
                    <textarea id="COMMENT" name="COMMENT" rows="5"
                        placeholder="ここに紹介文を入れる"><?php echo $row['COMMENT']; ?></textarea>
                </div>
                <div class="form-group">
                    <div class="check-area">
                        <label for="SNS_1">X(旧Twitter) ID<span class="required"></span></label>
                        <div class="check-box">
                            <?php if($view['SNS_1_FLG']==='0'): ?>
                            <label class="checkbox-label">
                                <input type="radio" name="SNS_1_FLG" value="0" checked />
                                非公開
                            </label>
                            <label class="checkbox-label">
                                <input type="radio" id="SNS_1_FLG" name="SNS_1_FLG" value="1" />
                                公開する
                            </label>
                            <?php endif; ?>
                            <?php if($view['SNS_1_FLG']==='1'): ?>
                            <label class="checkbox-label">
                                <input type="radio" name="SNS_1_FLG" value="0" />
                                非公開
                            </label>
                            <label class="checkbox-label">
                                <input type="radio" id="SNS_1_FLG" name="SNS_1_FLG" value="1" checked />
                                公開する
                            </label>
                            <?php endif; ?>
                        </div>
                    </div>
                    <input type="text" id="SNS_1" name="SNS_1" value="<?php echo htmlspecialchars($row['SNS_1']); ?>"
                        placeholder="https://x.com/" />
                </div>
                <div class="form-group">
                    <div class="check-area">
                        <label for="SNS_2">Instagram ID<span class="required"></span></label>
                        <div class="check-box">
                            <?php if($view['SNS_2_FLG']==='0'): ?>
                            <label class="checkbox-label">
                                <input type="radio" name="SNS_2_FLG" value="0" checked />
                                非公開
                            </label>
                            <label class="checkbox-label">
                                <input type="radio" id="SNS_2_FLG" name="SNS_2_FLG" value="1" />
                                公開する
                            </label>
                            <?php endif; ?>
                            <?php if($view['SNS_2_FLG']==='1'): ?>
                            <label class="checkbox-label">
                                <input type="radio" name="SNS_2_FLG" value="0" />
                                非公開
                            </label>
                            <label class="checkbox-label">
                                <input type="radio" id="SNS_2_FLG" name="SNS_2_FLG" value="1" checked />
                                公開する
                            </label>
                            <?php endif; ?>
                        </div>
                    </div>
                    <input type="text" id="SNS_2" name="SNS_2" value="<?php echo htmlspecialchars($row['SNS_2']); ?>"
                        placeholder="https://www.instagram.com/" />
                </div>
                <div class="form-group">
                    <div class="check-area">
                        <label for="SNS_3">TikTok ID<span class="required"></span></label>
                        <div class="check-box">
                            <?php if($view['SNS_3_FLG']==='0'): ?>
                            <label class="checkbox-label">
                                <input type="radio" name="SNS_3_FLG" value="0" checked />
                                非公開
                            </label>
                            <label class="checkbox-label">
                                <input type="radio" id="SNS_3_FLG" name="SNS_3_FLG" value="1" />
                                公開する
                            </label>
                            <?php endif; ?>
                            <?php if($view['SNS_3_FLG']==='1'): ?>
                            <label class="checkbox-label">
                                <input type="radio" name="SNS_3_FLG" value="0" />
                                非公開
                            </label>
                            <label class="checkbox-label">
                                <input type="radio" id="SNS_3_FLG" name="SNS_3_FLG" value="1" checked />
                                公開する
                            </label>
                            <?php endif; ?>
                        </div>
                    </div>
                    <input type="text" id="SNS_3" name="SNS_3" value="<?php echo htmlspecialchars($row['SNS_3']); ?>"
                        placeholder="https://www.tiktok.com/" />
                </div>
                <?php endforeach; ?>
                <?php endforeach; ?>
                <button type="submit" class="submit-button">送信する</button>
            </form>
        </div>
    </main>
</body>

</html>