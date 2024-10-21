<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ABOUT - COSPLATFORM</title>
    <link rel="stylesheet" href="style.css">
    <style>
        .subpage-hero{
            background-image: url('img/hp/top3.jpg');
        }
        
        .about-diagram {
            width: 100%;
            max-width: 500px;
            margin: 2rem auto;
        }
        .company-info{
            margin:2rem 0px;
        }

        .company-info table {
            width: 100%;
        }

        .google-map {
            height: 300px;
            background-color: #ddd;
            display: flex;
            justify-content: center;
            align-items: center;
            margin-top: 2rem;
            border-radius: 10px;
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
            <div class="container-box">
                <section class="about-content">
                    <h2>コスプレで世界とコネクト</h2>
                    <img src="img/hp/top3.jpg" alt="COS PLAT FORM Diagram" class="about-diagram">
                    <p>日本のポップカルチャーとして浸透しているアニメ、ゲーム、マンガ。そこから生まれた新たな文化"コスプレ"を通じて世界とつながる。</p>
                    <p>COS PLAT FORMは、コスプレを通じて世界中のファンとクリエイターを繋ぐプラットフォームです。私たちは以下の3つの柱を中心に活動しています。</p>
                    <p><strong>TALENT:</strong> 才能あるコスプレイヤーの発掘と支援</p>
                    <p><strong>COSPLAY:</strong> コスプレイベントの企画と運営</p>
                    <p><strong>COSTUME:</strong> 高品質なコスチュームの制作と販売</p>
                    <p>私たちは、コスプレを通じて文化の架け橋となり、創造性と多様性を称える世界を目指しています。COS PLAT FORMで、あなたの想像力を現実に変えましょう。</p>
                    
                    <div class="company-info">
                        <h3>会社概要</h3>
                        <table>
                            <tr>
                                <th>社名</th>
                                <td>株式会社 コスプラットフォーム</td>
                            </tr>
                            <tr>
                                <th>設立</th>
                                <td>2020年10月</td>
                            </tr>
                            <tr>
                                <th>代表者</th>
                                <td>山田 太郎</td>
                            </tr>
                            <tr>
                                <th>所在地</th>
                                <td>〒000-0000 東京都渋谷区○○町0-00-000</td>
                            </tr>
                            <tr>
                                <th>事業内容</th>
                                <td>タレントマネジメント、衣装販売、レンタル、製作</td>
                            </tr>
                        </table>
                    </div>
                    
                    <div class="google-map">
                        <p>Google Map プレースホルダー</p>
                    </div>
                </section>
            </div>
        </div>
    </main>
    

    <?php include 'footer.php'; ?>

    <script src="script.js"></script>
</body>
</html>