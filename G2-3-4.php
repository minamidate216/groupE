<?php session_start(); ?>
<?php require 'midasi.php'; // このファイルの中で、$conn も正しく定義されているものとします

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

// セッションから情報を取得
$column_title = isset($_SESSION['column_title']) ? $_SESSION['column_title'] : '';
$content = isset($_SESSION['content']) ? $_SESSION['content'] : '';
$post_data = isset($_SESSION['post_data']) ? $_SESSION['post_data'] : '';
$admin_id = isset($_SESSION['admin_id']) ? $_SESSION['admin_id'] : '';

// アップロード用ディレクトリ
$upload_directory = 'uploads/';

// セッションから画像データとMIMEタイプを取得
$image_data = isset($_SESSION['post_img_data']) ? $_SESSION['post_img_data'] : '';
$image_type = isset($_SESSION['post_img_type']) ? $_SESSION['post_img_type'] : '';

if ($image_data && $image_type) {
    // アップロード用ディレクトリにファイルを保存
    $file_name = uniqid() . '.jpg'; // ファイル名を一意にする
    $upload_path = $upload_directory . $file_name;

    // ファイルを保存
    if (file_put_contents($upload_path, $image_data) !== false) {
        echo '<p>画像をアップロードしました: ' . $file_name;

        // データベースに保存するファイルパス
        $target_file = $upload_path;

        // ここで取得した情報をデータベースに保存する処理を実行する
        $sql = "INSERT INTO Columns (column_title, content, post_data, post_img, admin_id) VALUES ('$column_title', '$content', '$post_data', '$target_file', '$admin_id')";

        // クエリの実行と結果の確認
        if ($conn->query($sql) === TRUE) {
            echo "新しいコラムが登録されました";
        } else {
            echo "エラー: " . $sql . "<br>" . $conn->error;
        }

        // データベースへの保存が完了したら、不要になったセッション変数を削除する
        unset($_SESSION['column_title']);
        unset($_SESSION['post_img']);
        unset($_SESSION['content']);
        unset($_SESSION['post_data']);
        unset($_SESSION['admin_id']);

        // データベースへの保存が完了したことをユーザーに表示するなどの処理を行う
        echo "データベースへの保存が完了しました";
    }
}
?>
<p><button onclick = "location.href='G2-3-1.php'">トップへ戻る</button></p>