<?php session_start(); ?>
<?php require 'db-connect.php'; ?>
<?php
$errors = [];
$user_name='';
$password = '';
$email =  '';
$address = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // 入力値を取得
    $user_name = $_POST['user_name'];
    $password = $_POST['password'];
    $email = $_POST['email'];
    $address = $_POST['address'];

    // 入力項目のチェック
    $pdo = new PDO($connect, USER, PASS);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    //名前の重複チェック
    $check_name = $pdo->prepare('SELECT COUNT(*) FROM Users WHERE user_name = ?');
    $check_name->execute([$user_name]);
    $check_name_count = $check_name->fetchColumn();
    if ($check_name_count > 0) {
        $errors[] = '入力された名前は既に使用されています。';
    }
    //emilの重複チェック
    $check_email = $pdo->prepare('SELECT COUNT(*) FROM Users WHERE email = ?');
    $check_email->execute([$email]);
    $check_email_count = $check_email->fetchColumn();
    if ($check_email_count > 0) {
        $errors[] = '入力されたメールアドレスは既に使用されています。';
    }   
    if (empty($user_name)) {
        $errors[] = "氏名を入力してください。";
    }elseif (mb_strlen($user_name, 'UTF-8') > 20) {
        $errors[] = '氏名は20文字以内で入力してください。';
    }
    if (empty($password)) {
        $errors[] = "パスワードを入力してください。";
    }elseif (strlen($password) > 20) {
        $errors[] = 'パスワードは20字以下で入力してください。';
    }
    if (empty($email)) {
        $errors[] = "メールアドレスを入力してください。";
    }else if(strlen($email) > 50){
        $errors[] = 'パスワードは50字以下で入力してください。';
    }else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "正しい形式のメールアドレスを入力してください。";
    }
    if (empty($address)) {
        $errors[] = "住所を入力してください。";
    }elseif (mb_strlen($address, 'UTF-8') > 50) {
        $errors[] = '住所は50文字以内で入力してください。';
    }

    // エラーがなければ次の処理へ
    if (empty($errors)) {
        $_SESSION['User']['user_name'] = $user_name;
        $_SESSION['User']['password'] = $password;
        $_SESSION['User']['email'] = $email;
        $_SESSION['User']['address'] = $address;
        header('Location: G1-2-5.php');
        exit;
    }
}
?>
<?php require 'header.php'; ?>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.3/css/bulma.min.css">
<?php
echo '<div class="content">';
    echo '<div class="container is-fluid">';
        
        echo '<div class="field is-grouped-centered">';
            echo '<form action="" method="post">';
            
            echo '<input type="hidden" name="user_id" value="', $user_id, '">';
            
            echo '<div class="box">';
            echo '<div class="has-text-centered">';
            echo '<h3>会員登録</h3>';
            echo '</div>';
            echo '<div class="column is-half is-offset-3">';
            
            echo '<label class="label has-text-primary">氏名</label>';
            echo '<input class="input is-normal is-primary" type="text" placeholder="氏名を入力してください。" name="user_name" value="' . $user_name . '">';

            echo '<label class="label has-text-primary">メールアドレス</label>';
            echo '<input class="input is-normal is-primary" type="text" placeholder="メールアドレスを入力してください。" name="email" value="', $email, '">';

            echo '<label class="label has-text-primary">パスワード</label>';
            echo '<input class="input is-normal is-primary" type="password" placeholder="パスワードを入力してください。" name="password" value="', $password, '">';

            echo '<label class="label has-text-primary">住所</label>';
            echo '<input class="input is-normal is-primary" type="text" placeholder="住所を入力してください。" name="address" value="', $address, '">';

            if (!empty($errors)) {
                echo '<ul style="color: red;">';
                foreach ($errors as $error) {
                    echo '<li>', $error, '</li>';
                }
                echo '</ul>';
            }
                echo '<div class="has-text-centered">';
                echo '<label class="label has-text-primary"></label>';
                echo '<input class="button is-primary" type="submit" name="submit" value="　確認へ　" ></button>';
                echo '</div>';
            echo '</div>';
            echo '</div>';
            echo '</div>';
            echo '</form>';
            echo '</div>';
    echo '</div>';
echo '</div>';
?>
<?php require 'footer.php'; ?>