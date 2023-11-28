<?php require 'db-connect.php'; ?>
<?php require 'midasi.php'; ?>

<?php
// データベース接続
$conn = new PDO($connect,USER, PASS);

// 接続確認
if (!$conn) {
    die("データベース接続エラー: " );
}

// Columnsテーブルからデータ取得
$sql = "SELECT c.column_id, c.column_title, a.admin_name, c.post_data, c.admin_id
        FROM Columns c
        INNER JOIN Admins a ON c.admin_id = a.admin_id";
$result = $conn->query($sql);

if ($result->rowCount() > 0) {
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

<button onclick="location.href='G2-3-2.php'">登録</button>