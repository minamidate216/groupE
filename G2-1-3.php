<?php session_start(); ?>
<?php require 'db-connect.php'; ?>
<head>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.3/css/bulma.min.css" />
</head>
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

        echo '<div class="content">';
        echo '<div class="container">';
    if ($result->rowCount() > 0) {

        echo '<div class="has-text-centered">';
        echo "<p>このIDは既に使われています</p>";
        echo '</div>';
        echo '<nav class="level">';
        // <!-- 中央揃え -->
        echo '<div class="level-item">';
        echo '<a href="G2-1-1.php"><button class="button has-background-success-dark has-text-white" type="button">戻る</button></a>';
        echo '</div>';
        echo '</nav>';
        // 既に存在するIDの処理を行う場合はここにコードを追加します
    } else {
        // この例では単純なmd5ハッシュを使用していますが、実際のアプリケーションではセキュリティを考慮した方法を使用してください
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        // データベースにデータを挿入
        $sql = "INSERT INTO Admins (admin_id, admin_name, password, email) VALUES (?, ?, ?, ?)";
        $result = $pdo->prepare($sql);
        $result->execute([$admin_id, $admin_name, $hashed_password, $email]);

        echo '<div class="has-text-centered">';
        echo "<p>管理者の登録を完了しました。</p>";
        echo '</div>';

        echo '<nav class="level">';
        // <!-- 中央揃え -->
        echo '<div class="level-item">';
        echo '<a href="G2-2-1.php"><button class="button has-background-success-dark has-text-white" type="button">商品管理画面へ</button></a>';
        echo '</div>';
        echo '</nav>';
    }
        echo '</div>';
        echo '</div>';
}
?>
<?php require 'footer.php'; ?>