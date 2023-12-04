<?php session_start(); ?>
<?php require 'db-connect.php'; ?>
<?php
// データベースの接続情報
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $pdo=new PDO($connect,USER,PASS);
    // フォームから送信されたデータを取得
    $admin_name = $_POST["admin_name"];
    $email = $_POST["email"];
    $admin_id = $_POST["admin_id"];
    $password = $_POST["password"];

    // IDが既に存在するか確認するクエリを作成
    $check_query = "SELECT admin_id FROM Admins WHERE admin_id = ?";
    $result = $pdo->prepare($check_query);
    $result->execute([$admin_id]);

    if ($result->rowCount() > 0) {
        echo "<p>このIDは既に使われています</p>";
        echo '<a href="G2-1-1.php">戻る</a>';
        // 既に存在するIDの処理を行う場合はここにコードを追加します
    } else {
        // この例では単純なmd5ハッシュを使用していますが、実際のアプリケーションではセキュリティを考慮した方法を使用してください
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        // データベースにデータを挿入
        $sql = "INSERT INTO Admins (admin_id, admin_name, password, email) VALUES (?, ?, ?, ?)";
        $result = $pdo->prepare($sql);
        $result->execute([$admin_id, $admin_name, $hashed_password, $email]);
            echo "<h2>管理者の登録を完了しました。</h2>";
            echo '<a href="G2-2-1.php">商品管理画面へ</a>';
    }
}
?>
<?php require 'footer.php'; ?>