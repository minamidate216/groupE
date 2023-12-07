<?php require 'header.php'; ?>
<?php
$a=0;
if(!empty($_POST['email'])){
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // 入力値を取得
        $email = $_POST['email'];
            
        // 入力項目のチェック
        $pdo = new PDO($connect, USER, PASS);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
       
        //emilの重複チェック
        $check_email = $pdo->prepare('SELECT COUNT(*) FROM Users WHERE email = ?');
        $check_email->execute([$email]);
        $check_email_count = $check_email->fetchColumn();
        $check=0;
        if ($check_email_count > 0) {
            $errors[] = '入力されたメールアドレスは既に使用されています。';
        }   
        
        if (empty($email) && $check==0) {
            $errors[] = 'メールアドレスを入力してください。';
            $check=1;

        }
        if (!filter_var($email, FILTER_VALIDATE_EMAIL) && $check==0) {
            $errors[] = '正しい形式のメールアドレスを入力してください。';
            $check=1;
        }
        // エラーがなければ次の処理へ
        if (empty($errors)) {
            $_SESSION['User']['email'] = $email;
            echo 'ご入力いただいたメールアドレス宛に<br/>ID・パスワード変更のメールを送信いたしました。<br>';
            echo '<form action="G1-2-1.php">';
            echo '<button type="submit">ログインへ</button>';
            echo '</form>';
            $a=1;
        }
    }
}
if($a!=1){
    echo '<h1>メールアドレスを入力してください</h1>';
    echo '<div id="app">';
    echo '<form action="G1-2-2.php" method="post">';
    if (!empty($errors)) {
        echo '<ul style="color: red;">';
        foreach ($errors as $error) {
            echo '<li>', $error, '</li>';
        }
        echo '</ul>';
    }
    echo '<input type="email" name="email"><br>';
    echo '<button type="submit">送信</button>';
    echo '</form>';
    echo '</div>';
}
?>
<script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
<script src="./script/script.js"></script>
<?php require 'footer.php'; ?>