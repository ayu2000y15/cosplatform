<?php
    require_once('admin-db.php'); 
    $obj = new DbController();
    $talentList = $obj->getTalentList();
?>

<!DOCTYPE html>
<html lang="ja">

<head>
    <link rel="stylesheet" href="admin-style.css">
</head>

<body>
    <main>
        <div class="form-area list">
            <h2>登録済みタレント一覧</h2>
            <p>※タレント名をクリックすることでタレント詳細ページに遷移します。<br>
                　タレント詳細ページではタレントの写真や経歴、ハッシュタグの情報の更新が行えます。<br></p>
            <br>
            <div class="table-container">
                <table>
                    <tr>
                        <th>タレントID</th>
                        <th>レイヤーネーム</th>
                        <th>所属日</th>
                        <th>退職日</th>
                        <th>在籍状況</th>
                    </tr>
                    <?php foreach ($talentList as $row): ?>
                    <tr data-talent-id="<?php echo htmlspecialchars($row['TALENT_ID']); ?>">
                        <td><?php echo htmlspecialchars($row['TALENT_ID']) ; ?></td>
                        <td><?php echo htmlspecialchars($row['LAYER_NAME']); ?></td>
                        <td><?php echo htmlspecialchars($row['AFFILIATION_DATE']); ?></td>
                        <td>
                            <?php 
                                if($row['RETIREMENT_DATE'] <> '2099-01-01'){
                                    echo htmlspecialchars($row['RETIREMENT_DATE']);
                                }
                            ?>
                        </td>
                        <td>
                            <?php 
                            if( $row['RETIREMENT_DATE'] <= date("Y-m-d") && $row['DEL_FLG'] === '1') {
                                echo '退職済み';
                            }else{
                                echo '在籍';
                            }
                            ?>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </table>
            </div>
        </div>
    </main>

    <script>
    document.addEventListener('DOMContentLoaded', function() {
        const table = document.querySelector('table');
        table.addEventListener('click', function(e) {
            const row = e.target.closest('tr');
            if (row && row.dataset.talentId) {
                // 選択された行のクラスを切り替える
                row.classList.toggle('selected');

                // フォームを作成して送信
                const form = document.createElement('form');
                form.method = 'post';
                form.action = '10-talent-admin.php';

                const talentIdInput = document.createElement('input');
                talentIdInput.type = 'hidden';
                talentIdInput.name = 'TALENT_ID';
                talentIdInput.value = row.dataset.talentId;

                const exeIdInput = document.createElement('input');
                exeIdInput.type = 'hidden';
                exeIdInput.name = 'EXE_ID';
                exeIdInput.value = '01';

                form.appendChild(talentIdInput);
                form.appendChild(exeIdInput);
                document.body.appendChild(form);
                form.submit();
            }
        });
    });
    </script>
</body>

</html>