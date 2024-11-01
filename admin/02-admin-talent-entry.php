<?php

    require_once('admin-db.php'); 
    $obj = new DbController();
    $talentList = $obj->getTalentList();

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
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
            $obj->insertTalentTag('男装');
        }
        //COS_FLG = '2' 女装
        if($_POST['COS_FLG'] === '2'){
            $obj->insertTalentTag('女装');
        }
        //COS_FLG = '3' 男装・女装
        if($_POST['COS_FLG'] === '3'){
            $obj->insertTalentTag('男装');
            $obj->insertTalentTag('女装');
        }

    }

?>
<script>
<?php foreach ($talentInfo as $key => $value): ?>
console.log("<?php echo $key . ':' . $value ;?>");
<?php endforeach; ?>
</script>
<!DOCTYPE html>
<html lang="ja">

<body>
    <main>
        <script src="admin-script.js"></script>
        <div class="admin-talent-insert">
            <form class="form-area" onsubmit="return checkSubmit();" action="01-admin-talent-list.php" method="POST">
                <h2>新規タレント登録</h2>
                <p>※タレントの写真や経歴、ハッシュタグについては、<br>　タレント登録完了後、タレント詳細情報から登録してください。<br>
                　写真を登録しないとHPには表示されません。
                </p>
                <div class="form-group">
                    <label for="TALENT_NAME">タレント名（本名）<span class="required">※HPには表示されません</span></label>
                    <input type="text" id="TALENT_NAME" name="TALENT_NAME" placeholder="山田太郎" />
                </div>
                <div class="form-group">
                    <label for="TALENT_FURIGANA_JP">タレント名　ふりがな（ひらがな）<span class="required">※HPには表示されません</span></label>
                    <input type="text" id="TALENT_FURIGANA_JP" name="TALENT_FURIGANA_JP" placeholder="やまだたろう" />
                </div>
                <div class="form-group">
                    <label for="TALENT_FURIGANA_EN">タレント名　ふりがな（ローマ字）<span class="required">※HPには表示されません</span></label>
                    <input type="text" id="TALENT_FURIGANA_EN" name="TALENT_FURIGANA_EN" placeholder="YamadaTaro" />
                </div>
                <div class="form-group">
                    <label for="LAYER_NAME">レイヤーネーム（HPに表示する名前）<span class="required">必須</span></label>
                    <input type="text" id="LAYER_NAME" name="LAYER_NAME" placeholder="やまだ" required />
                </div>
                <div class="form-group">
                    <label for="LAYER_FURIGANA_JP">レイヤーネーム　ふりがな（ひらがな）<span class="required">必須</span></label>
                    <input type="text" id="LAYER_FURIGANA_JP" name="LAYER_FURIGANA_JP" placeholder="やまだ" required />
                </div>
                <div class="form-group">
                    <label for="LAYER_FURIGANA_EN">レイヤーネーム　ふりがな（ローマ字）<span class="required">必須</span></label>
                    <input type="text" id="LAYER_FURIGANA_EN" name="LAYER_FURIGANA_EN" placeholder="Yamada" required />
                </div>
                <div class="form-group">
                    <label for="AFFILIATION_DATE">所属日<span class="required"></span></label>
                    <input type="date" value="2024-01-01" id="AFFILIATION_DATE" name="AFFILIATION_DATE" />
                </div>
                <!-- <div class="form-group">
                                    <label for="RETIREMENT_DATE">退職日<span class="required"></span></label>
                                    <input type="date" value="2099-01-01" id="RETIREMENT_DATE" name="RETIREMENT_DATE" />
                                </div> -->
                <div class="form-group">
                    <label for="MAIL">メールアドレス<span class="required"></span></label>
                    <input type="mail" id="MAIL" name="MAIL" placeholder="example@gmail.com" />
                </div>
                <div class="form-group">
                    <label for="TEL_NO">電話番号<span class="required"></span></label>
                    <input type="tel" id="TEL_NO" name="TEL_NO" pattern="[0-9]{3}-[0-9]{4}-[0-9]{4}"
                        placeholder="080-1234-5678" />
                </div>

                <!-- ここから表示情報 -->
                <div class="form-group">
                    <div class="check-area">
                        <label for="FOLLOWERS">フォロワー数（およそ）<span class="required"></span></label>
                        <div class="check-box">
                            <label class="checkbox-label">
                                <input type="radio" name="FOLLOWERS_FLG" value="0" checked />
                                非公開
                            </label>
                            <label class="checkbox-label">
                                <input type="radio" id="FOLLOWERS_FLG" name="FOLLOWERS_FLG" value="1" />
                                公開する
                            </label>
                        </div>
                    </div>
                    <input type="number" id="FOLLOWERS" name="FOLLOWERS" placeholder="100" />
                </div>
                <div class="form-group">
                    <label for="STREAM_FLG">配信可・不可<span class="required"></span></label>
                    <select id="STREAM_FLG" name="STREAM_FLG">
                        <option value="0">配信不可</option>
                        <option value="1">配信可</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="COS_FLG">コスプレの種類（男装、女装）<span class="required"></span></label>
                    <select id="COS_FLG" name="COS_FLG">
                        <option value="1">男装</option>
                        <option value="2">女装</option>
                        <option value="3">男装・女装</option>
                    </select>
                </div>
                <div class="form-group">
                    <div class="check-area">
                        <label for="HEIGHT">身長<span class="required"></span></label>
                        <div class="check-box">
                            <label class="checkbox-label">
                                <input type="radio" name="HEIGHT_FLG" value="0" checked />
                                非公開
                            </label>
                            <label class="checkbox-label">
                                <input type="radio" id="HEIGHT_FLG" name="HEIGHT_FLG" value="1" />
                                公開する
                            </label>
                        </div>
                    </div>
                    <input type="number" id="HEIGHT" name="HEIGHT" placeholder="172" />
                </div>
                <div class="form-group">
                    <div class="check-area">
                        <label for="AGE">年齢<span class="required"></span></label>
                        <div class="check-box">
                            <label class="checkbox-label">
                                <input type="radio" name="AGE_FLG" value="0" checked />
                                非公開
                            </label>
                            <label class="checkbox-label">
                                <input type="radio" id="AGE_FLG" name="AGE_FLG" value="1" />
                                公開する
                            </label>
                        </div>
                    </div>
                    <input type="number" id="AGE" name="AGE" placeholder="25" />
                </div>
                <div class="form-group">
                    <div class="check-area">
                        <label for="BIRTHDAY">誕生日<span class="required"></span></label>
                        <div class="check-box">
                            <label class="checkbox-label">
                                <input type="radio" name="BIRTHDAY_FLG" value="0" checked />
                                非公開
                            </label>
                            <label class="checkbox-label">
                                <input type="radio" id="BIRTHDAY_FLG" name="BIRTHDAY_FLG" value="1" />
                                公開する
                            </label>
                        </div>
                    </div>
                    <input type="date" value="2000-01-01" id="BIRTHDAY" name="BIRTHDAY" />
                </div>
                <div class="form-group">
                    <div class="check-area">
                        <label for="THREE_SIZES_B">スリーサイズ　バスト<span class="required"></span></label>
                        <div class="check-box">
                            <label class="checkbox-label">
                                <input type="radio" name="THREE_SIZES_B_FLG" value="0" checked />
                                非公開
                            </label>
                            <label class="checkbox-label">
                                <input type="radio" id="THREE_SIZES_B_FLG" name="THREE_SIZES_B_FLG" value="1" />
                                公開する
                            </label>
                        </div>
                    </div>
                    <input type="number" id="THREE_SIZES_B" name="THREE_SIZES_B" placeholder="75" />
                </div>
                <div class="form-group">
                    <div class="check-area">
                        <label for="THREE_SIZES_W">スリーサイズ　ウエスト<span class="required"></span></label>
                        <div class="check-box">
                            <label class="checkbox-label">
                                <input type="radio" name="THREE_SIZES_W_FLG" value="0" checked />
                                非公開
                            </label>
                            <label class="checkbox-label">
                                <input type="radio" id="THREE_SIZES_W_FLG" name="THREE_SIZES_W_FLG" value="1" />
                                公開する
                            </label>
                        </div>
                    </div>
                    <input type="number" id="THREE_SIZES_W" name="THREE_SIZES_W" placeholder="55" />
                </div>
                <div class="form-group">
                    <div class="check-area">
                        <label for="THREE_SIZES_W">スリーサイズ　ヒップ<span class="required"></span></label>
                        <div class="check-box">
                            <label class="checkbox-label">
                                <input type="radio" name="THREE_SIZES_H_FLG" value="0" checked />
                                非公開
                            </label>
                            <label class="checkbox-label">
                                <input type="radio" id="THREE_SIZES_H_FLG" name="THREE_SIZES_H_FLG" value="1" />
                                公開する
                            </label>
                        </div>
                    </div>
                    <input type="number" id="THREE_SIZES_H" name="THREE_SIZES_H" placeholder="75" />
                </div>
                <div class="form-group">
                    <div class="check-area">
                        <label for="HOBBY_SPECIALTY">趣味・特技<span class="required"></span></label>
                        <div class="check-box">
                            <label class="checkbox-label">
                                <input type="radio" name="HOBBY_SPECIALTY_FLG" value="0" checked />
                                非公開
                            </label>
                            <label class="checkbox-label">
                                <input type="radio" id="HOBBY_SPECIALTY_FLG" name="HOBBY_SPECIALTY_FLG" value="1" />
                                公開する
                            </label>
                        </div>
                    </div>
                    <input type="text" id="HOBBY_SPECIALTY" name="HOBBY_SPECIALTY" placeholder="カラオケ・食べること" />
                </div>
                <div class="form-group">
                    <div class="check-area">
                        <label for="COMMENT">紹介文・コメント<span class="required"></span></label>
                        <div class="check-box">
                            <label class="checkbox-label">
                                <input type="radio" name="COMMENT_FLG" value="0" checked />
                                非公開
                            </label>
                            <label class="checkbox-label">
                                <input type="radio" id="COMMENT_FLG" name="COMMENT_FLG" value="1" />
                                公開する
                            </label>
                        </div>
                    </div>
                    <textarea id="COMMENT" name="COMMENT" rows="5" placeholder="ここに紹介文を入れる"></textarea>
                </div>
                <div class="form-group">
                    <div class="check-area">
                        <label for="SNS_1">X(旧Twitter) ID<span class="required"></span></label>
                        <div class="check-box">
                            <label class="checkbox-label">
                                <input type="radio" name="SNS_1_FLG" value="0" checked />
                                非公開
                            </label>
                            <label class="checkbox-label">
                                <input type="radio" id="SNS_1_FLG" name="SNS_1_FLG" value="1" />
                                公開する
                            </label>
                        </div>
                    </div>
                    <input type="text" id="SNS_1" name="SNS_1" placeholder="twitter" />
                </div>
                <div class="form-group">
                    <div class="check-area">
                        <label for="SNS_1">X(旧Twitter) ID<span class="required"></span></label>
                        <div class="check-box">
                            <label class="checkbox-label">
                                <input type="radio" name="SNS_2_FLG" value="0" checked />
                                非公開
                            </label>
                            <label class="checkbox-label">
                                <input type="radio" id="SNS_2_FLG" name="SNS_2_FLG" value="1" />
                                公開する
                            </label>
                        </div>
                    </div>
                    <input type="text" id="SNS_2" name="SNS_2" placeholder="insta_000" />
                </div>
                <div class="form-group">
                    <div class="check-area">
                        <label for="SNS_1">X(旧Twitter) ID<span class="required"></span></label>
                        <div class="check-box">
                            <label class="checkbox-label">
                                <input type="radio" name="SNS_3_FLG" value="0" checked />
                                非公開
                            </label>
                            <label class="checkbox-label">
                                <input type="radio" id="SNS_3_FLG" name="SNS_3_FLG" value="1" />
                                公開する
                            </label>
                        </div>
                    </div>
                    <input type="text" id="SNS_3" name="SNS_3" placeholder="tiktok1212" />
                </div>
                <button type="submit" class="submit-button">送信する</button>
            </form>
        </div>
    </main>
</body>

</html>