<?php require 'midasi.php'; ?>
<?php
// データベースの接続情報
$servername = "mysql215.phy.lolipop.lan";
$username = "LAA1517365";
$password = "Pass0916";
$dbname = "LAA1517365-shop";

// データベースに接続
$conn = new mysqli($servername, $username, $password, $dbname);

// 接続確認
if ($conn->connect_error) {
    die("データベース接続エラー: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // フォームから送信されたデータを取得
    $admin_name = $_POST["admin_name"];
    $email = $_POST["email"];
    $admin_id = $_POST["admin_id"];
    $password = $_POST["password"];

    // IDが既に存在するか確認するクエリを作成
    $check_query = "SELECT admin_id FROM Admins WHERE admin_id = '$admin_id'";
    $result = $conn->query($check_query);

    if ($result->num_rows > 0) {
        echo "<p>このIDは既に使われています</p>";
        echo '<a href="G2-1-1.php">戻る</a>';
        // 既に存在するIDの処理を行う場合はここにコードを追加します
    } else {
        // パスワードはセキュリティ上、適切な方法でハッシュ化してください
        // この例では単純なmd5ハッシュを使用していますが、実際のアプリケーションではセキュリティを考慮した方法を使用してください
        $hashed_password = md5($password);

        // データベースにデータを挿入
        $sql = "INSERT INTO Admins (admin_id, admin_name, password, email) VALUES ('$admin_id', '$admin_name', '$hashed_password', '$email')";

        if ($conn->query($sql) === TRUE) {
            echo "<h2>管理者の登録を完了しました。</h2>";
            echo '<a href="G2-1-1.php">商品管理画面へ</a>';
        } else {
            echo "データベースエラー: " . $conn->error;
        }
    }
}
?>
<?php require 'footer.php'; ?>