<?php require 'header_admin.php'; ?>
<?php require 'db-connect.php';

// データベース接続
$conn = new PDO($connect, USER, PASS);

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (isset($_POST['post_img'])) {
        $post_img = $_POST['post_img'];

        // ファイルのフルパスを取得する（例えば、uploadsディレクトリ内に画像が保存されていると仮定）
        $file_path = 'uploads/' . basename($post_img);

        // ファイルを削除する
        if (file_exists($file_path)) {
            if (unlink($file_path)) {
                // ファイルの削除が成功した場合、データベースからも削除する
                $sql = "DELETE FROM Columns WHERE post_img = ?";
                $stmt = $conn->prepare($sql);
                $stmt->execute([$post_img]);

                // 削除が完了したら別のページにリダイレクトするなどの処理を行う
                // 例: ホームページにリダイレクトする
                echo "コラムを削除しました。";
            } else {
                echo "ファイルの削除に失敗しました";
            }
        } else {
            echo "ファイルが見つかりません";
        }
    }
}

?>
<p><button onclick = "location.href='G2-3-1.php'">コラム管理画面へ</button></p>