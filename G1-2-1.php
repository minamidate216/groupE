<?php require 'db-connect.php'; ?>
<?php require 'header.php'; ?>
<?php
if(isset($_SESSION['Users'])){
    echo $_SESSION['Users']['user_name'],'さんで、ログイン済みです。';
}else{
    if(isset($_POST['judge'])){
        unset($_SESSION['Users']);
        $pdo = new PDO($connect,USER,PASS);
        $sql=$pdo->prepare('select * from Users where user_id=?');
        $sql->execute([$_POST['id']]);
        foreach($sql as $row){
            //if(password_verify($_POST['password'],$row['password'])){ ハッシュ化するか協議
            $_SESSION['Users']=[
                'user_name'=>$row['user_name'],
                'address'=>$row['address'], 'user_id'=>$row['user_id'],
                'password'=>$row['password']];
            //}
        }
        if(isset($_SESSION['Users'])) {
            echo 'いらっしゃいませ、', $_SESSION['Users']['user_name'], 'さん';
            echo '<form action="G1-1-1.php">';
            echo '<button type="submit">トップへ</button>';
            echo '</form>';
            $judge=1;
        }else{
            echo '<h1>ログイン名またはパスワードが違います。</h1>';
            unset($_SESSION['Users']);
            $judge=0;
        }
    }
    else{
        $judge=0;
    } /*未入力の時の表示を考えたいにゃ　*/
    if($judge!=1){
        echo '<form method="post">';
        echo 'ログイン名  <input type="text" name="id"><br/>';
        echo 'パスワード  <input type="password" name="password"><br/>';
        echo '<input type="hidden" name="judge" value=1>';
        echo '<button type="submit">ログイン</button>';
        echo '</form>';
        echo '<a href="G1-2-2.php">ID・パスワードを忘れた方はこちら</a><br/>';
        echo '<a href="G1-2-4.php">新規登録の方はこちら</a>';
    
}
}
?>
<?php require 'footer.php'; ?>