<?php require 'header_admin.php'; ?>
<?php require 'db-connect.php'; ?>
<?php
if(!isset($_SESSION['admin'])){
    echo 'ログインしてください<br>';
    echo '<a href="G2-1-4-input.php">ログイン</a>';
    exit();
}
// 接続確認
// データベース接続
$conn = new PDO($connect,USER, PASS);
// Columnsテーブルからデータ取得
$sql = "SELECT c.column_id, c.column_title, a.admin_name, c.post_data, c.admin_id
        FROM Columns c
        INNER JOIN Admins a ON c.admin_id = a.admin_id";
$result = $conn->query($sql);
echo '<div class="content">';
echo '<div class="container">';
echo '<h3 class="title is-3 has-text-centered">コラム一覧</h3>';

if ($result->rowCount() > 0) {
    // テーブルヘッダー
    echo '<table class="table is-fullwidth">
            <tr class="has-background-success-dark">
                <th class="has-text-light">コラム名</th>
                <th class="has-text-light">追加者</th>
                <th class="has-text-light">更新日時</th>
                <th></th>
                <th></th>
            </tr>';

    // データ表示
    $data = $result->fetchAll(PDO::FETCH_ASSOC);
    foreach ($data as $row) {
        echo "<tr>
                <td>" . $row["column_title"] . "</td>
                <td>" . $row["admin_name"] . "</td>
                <td>" . $row["post_data"] . "</td>
                <td><a href='G2-3-5.php?column_id=" . $row["column_id"] . "'>更新</a></td>
                <td><a href='G2-3-8.php?column_id=" . $row["column_id"] . "'>削除</a></td>
              </tr>";
    }
    echo "</table>";
} else {
    echo "データがありません";
}
$conn=null;
?>
<nav class="level">
  <!-- 中央揃え -->
  <div class="level-item">
<form action="G2-3-2.php" method="post">
<input class="button has-background-success-dark has-text-white " type="submit" value="新規登録">
</form>
</div>
</div>
</div>
</nav>