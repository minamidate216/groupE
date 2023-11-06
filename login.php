<?php require 'db-connect.php'; ?>
<?php session_start() ?>
<?php require 'header.php'; ?>
<?php
if(isset($_SESSION['customer'])){
    echo $_SESSION['customer']['name'],'さんで、ログイン済みです。';
}else{
    if(isset($_POST['judge'])){
        unset($_SESSION['customer']);
        $pdo = new PDO($connect,USER,PASS);
        $sql=$pdo->prepare('select * from customer where login=?');
        $sql->execute([$_POST['id']]);
        foreach($sql as $row){
            if(password_verify($_POST['password'],$row['password'])){
            $_SESSION['customer']=[
                'id'=>$row['id'], 'name'=>$row['name'],
                'address'=>$row['address'], 'login'=>$row['login'],
                'password'=>$row['password']];
            }
        }
        if(isset($_SESSION['customer'])) {
            echo 'いらっしゃいませ、', $_SESSION['customer']['name'], 'さん';
            echo '<form action="syouhinkensaku.php">';
            echo '<button type="submit">商品一覧へ</button>';
            echo '</form>';
            $judge=1;
        }else{
            echo '<h1>ログイン名またはパスワードが違います。</h1>';
            unset($_SESSION['customer']);
            $judge=0;
        }
    }
    else{
        $judge=0;
    } /*未入力の時の表示を考えたいにゃ　*/
    if($judge!=1){
        echo '<form method="post">';
        echo 'ID  <input type="text" name="id"><br/>';
        echo 'パスワード  <input type="password" name="password"><br/>';
        echo '<input type="hidden" name="judge" value=1>';
        echo '<button type="submit">ログイン</button>';
        echo '</form>';
        echo '<a href="mail.php">ID・パスワードを忘れた方はこちら</a><br/>';
        echo '<a href="kaiinntouroku.php">新規登録の方はこちら</a>';
    
}
}
?>
<?php require 'footer.php'; ?>