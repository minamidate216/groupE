<?php require 'header_admin.php'; ?>
<?php require 'db-connect.php';
// データベースに接続
if(!isset($_SESSION['admin'])){
    echo 'ログインしてください<br>';
    echo '<a href="G2-1-4-input.php">ログイン</a>';
    exit();
}

$pdo=new PDO($connect,USER,PASS);
 
// 接続確認
// セッションから情報を取得
$column_title = isset($_SESSION['column']['column_title']) ? $_SESSION['column']['column_title'] : '';
$content = isset($_SESSION['column']['content']) ? $_SESSION['column']['content'] : '';
$post_data = date("Y-m-d");
$admin_id = isset($_SESSION['admin']['id']) ? $_SESSION['admin']['id'] : '';

// アップロード用ディレクトリ
$upload_directory = 'uploads/';

// セッションから画像データとMIMEタイプを取得
$image_data = isset($_SESSION['column']['post_img_data']) ? $_SESSION['column']['post_img_data'] : '';
$image_type = isset($_SESSION['column']['post_img_type']) ? $_SESSION['column']['post_img_type'] : '';

if ($image_data && $image_type) {
    // アップロード用ディレクトリにファイルを保存
    $file_name = uniqid() . '.jpg'; // ファイル名を一意にする
    $upload_path = $upload_directory . $file_name;

    // ファイルを保存
    if (file_put_contents($upload_path, $image_data) !== false) {

        // データベースに保存するファイルパス
        $target_file = $upload_path;

        // ここで取得した情報をデータベースに保存する処理を実行する
        $sql = "INSERT INTO Columns (column_title, content, post_data, post_img, admin_id) VALUES (?, ?, ?, ?, ?)";
        $result = $pdo->prepare($sql);
        $result->execute([$column_title, $content, $post_data, $target_file, $admin_id]);

        // データベースへの保存が完了したら、不要になったセッション変数を削除する
        unset($_SESSION['column']);

        echo '<div class="content">';
        echo '<div class="container">';
        echo '<nav class="level">';
        // <!-- 中央揃え -->
        echo '<div class="level-item">';
        
        // データベースへの保存が完了したことをユーザーに表示するなどの処理を行う
        echo "コラムの登録を完了しました";

        echo '</div>';
        echo '</nav>';
    }
}
?>
<nav class="level">
<!-- 中央揃え -->
<div class="level-item">
<p><button onclick = "location.href='G2-3-1.php'">コラム管理画面へ</button></p>
</div>
</nav>
</div>
</diV>