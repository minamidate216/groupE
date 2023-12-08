<?php require 'header.php'; ?>
<?php
echo '<div class="has-text-centered is-size-2">LOGIN PAGE</div>';
if(isset($_SESSION['Users'])){
    echo '<div class="has-text-centered">',$_SESSION['Users']['user_name'],'さんで、ログイン済みです。</div>';
}else{
    if(isset($_POST['judge'])){
        unset($_SESSION['Users']);
        $pdo = new PDO($connect,USER,PASS);
        $sql=$pdo->prepare('select * from Users where user_name=?');
        $sql->execute([$_POST['user_name']]);
        foreach($sql as $row){
            //if(password_verify($_POST['password'],$row['password'])){ ハッシュ化するか協議
            $_SESSION['Users']=[
                'user_name'=>$row['user_name'],
                'address'=>$row['address'], 'user_id'=>$row['user_id'],
                'password'=>$row['password'], 'email'=>$row['email']] ;
            //}
        }
        if(isset($_SESSION['Users'])) {
            echo '<div class="has-text-centered">いらっしゃいませ、', $_SESSION['Users']['user_name'], 'さん';
            echo '<form action="G1-1-1.php">';
            echo '<button type="submit">トップへ</button>';
            echo '</form></div>';
            $judge=1;
        }else{
            echo '<h1>ユーザーネームまたはパスワードが違います。</h1>';
            unset($_SESSION['Users']);
            $judge=0;
        }
    }
    else{
        $judge=0;
    } /*未入力の時の表示を考えたいにゃ　*/
    if($judge!=1){
        echo '<form method="post">';
        echo 'ユーザーネーム  <input type="text" name="user_name"><br/>';
        echo 'パスワード  <input type="password" name="password"><br/>';
        echo '<input type="hidden" name="judge" value=1>';
        echo '<button type="submit">ログイン</button>';
        echo '</form><br>';
        echo '<a href="G1-2-2.php">パスワードを忘れた方はこちら</a><br/>';
        echo '<a href="G1-2-4.php">新規登録の方はこちら</a>';
    
}
}
?>
<?php require 'footer.php'; ?>