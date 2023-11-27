<?php require 'midasi.php'; ?>
<?php
// データベース接続情報
$servername = "mysql215.phy.lolipop.lan";
$username = "LAA1517365";
$password = "Pass0916";
$dbname = "LAA1517365-shop";
 
// データベース接続
$conn = new mysqli($servername, $username, $password, $dbname);
 
// 接続確認
if ($conn->connect_error) {
    die("データベース接続エラー: " . $conn->connect_error);
}
 
// Columnsテーブルからデータ取得
$sql = "SELECT c.column_title, a.admin_name, c.post_data, c.admin_id
        FROM Columns c
        INNER JOIN Admins a ON c.admin_id = a.admin_id";
$result = $conn->query($sql);
 
if ($result->num_rows > 0) {
    // テーブルヘッダー
    echo "<table border='1'>
            <tr>
                <th>コラム名</th>
                <th>追加者</th>
                <th>更新日時</th>
                <th>更新</th>
                <th>削除</th>
            </tr>";
 
    // データ表示
    while($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>" . $row["column_title"] . "</td>
                <td>" . $row["admin_name"] . "</td>
                <td>" . $row["post_data"] . "</td>
                <td><a href='update.php?column_id=" . $row["admin_id"] . "'>更新</a></td>
                <td><a href='delete.php?column_id=" . $row["admin_id"] . "'>削除</a></td>
              </tr>";
    }
    echo "</table>";
} else {
    echo "データがありません";
}
 
$conn->close();
?>
<button onclick="location.href='G2-3-2.php'">登録</button>