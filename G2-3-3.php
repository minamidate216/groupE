<?php require 'header_admin.php';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // フォームから送信された情報をセッションに一時保存する
    $_SESSION['column']=[];
    $_SESSION['column']['column_title'] = $_POST['column_title'];
    $_SESSION['column']['content'] = $_POST['content'];
    
    if(isset($_FILES['post_img']) && $_FILES['post_img']['error'] === UPLOAD_ERR_OK) {
        // アップロードされたファイルの一時保存先からデータを取得し、セッションに保存
        $temp_path = $_FILES['post_img']['tmp_name'];
        $_SESSION['column']['post_img_data'] = file_get_contents($temp_path);
        $_SESSION['column']['post_img_type'] = $_FILES['post_img']['type'];
    }
}
?>
<h2></h2>
<form action="G2-3-4.php" method="post">
<?php
    if (isset($_SESSION['column']['post_img_data']) && isset($_SESSION['column']['post_img_type'])) {
       $img_data = $_SESSION['column']['post_img_data'];
       $img_type = $_SESSION['column']['post_img_type'];
       $base64_img = 'data:' . $img_type . ';base64,' . base64_encode($img_data);
    // 画像を表示し、widthとheight属性でサイズを指定する
       echo '<img src="' . $base64_img . '" alt="Uploaded Image" width="300" height="200">';
    }
?>
    <p><?php echo isset($_SESSION['column']['column_title']) ? $_SESSION['column']['column_title'] : ''; ?></p>
    <p><?php echo isset($_SESSION['column']['content']) ? $_SESSION['column']['content'] : ''; ?></p>
    <!-- 登録ボタン -->
    <p>登録しますか？</p>
    <p><input class="button has-background-success-dark has-text-white" type="submit" value="登録">
    <a href="G2-3-1.php"><button class="button has-background-success-dark has-text-white" type="button">戻る</button></a>
</form>
<?php require 'footer.php'; ?>