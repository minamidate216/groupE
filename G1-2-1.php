<?php require 'header.php'; ?>
<?php
echo '<div class="has-text-centered is-size-2">LOGIN PAGE</div>';
if(isset($_SESSION['Users'])){
    echo '<div class="has-text-centered">',$_SESSION['Users']['user_name'],'さんで、ログイン済みです。</div>';
}else{
    if(isset($_POST['judge']) && isset($_POST['user_name']) && $_POST['password']!= null){
        unset($_SESSION['Users']);
        $pdo = new PDO($connect,USER,PASS);
        $sql=$pdo->prepare('select * from Users where user_name=?');
        $sql->execute([$_POST['user_name']]);
        foreach($sql as $row){
            if($_POST['password'] == $row['password']){ 
            $_SESSION['Users']=[
                'user_name'=>$row['user_name'],
                'address'=>$row['address'], 'user_id'=>$row['user_id'],
                'password'=>$row['password'], 'email'=>$row['email']] ;
            }
        }
        if(isset($_SESSION['Users'])) {
            echo '<div class="has-text-centered">いらっしゃいませ、', $_SESSION['Users']['user_name'], 'さん';
            echo '<form action="G1-1-1.php">';
            echo '<button type="submit">トップへ</button>';
            echo '</form></div>';
            $judge=1;
        }else{
            echo '<div class="has-text-centered is-size-4 has-text-danger"><h1>ユーザーネームまたはパスワードが違います。</h1></div>';
            unset($_SESSION['Users']);
            $judge=0;
        }
    }
    else{
        $judge=0;
        echo '<div class="has-text-centered is-size-4">ログイン情報を入力してください。</div>';
    } /*未入力の時の表示を考えたいにゃ　*/
    if($judge!=1){
        echo '<form method="post">';
        echo '<div class="text is-size-5 has-text-centered">ユーザーネーム&ensp;&ensp;&emsp;&emsp;<input type="text" name="user_name"><br/></div>';
        echo '<div class="text is-size-5 has-text-centered">パスワード&emsp;&emsp;&emsp;&emsp;&emsp;<div style="display: inline"><input type="password" name="password"><br/></div></div>';
        echo '<input type="hidden" name="judge" value=1>';
        echo '<div class="has-text-centered" style="text-align: center"><button type="submit">ログイン</button></div>';
        echo '</form><br>';
        echo '<div class="has-text-centered" style="margin: 20px auto"><a href="G1-2-2.php">パスワードを忘れた方はこちら</a><br/></div>';
        echo '<div class="has-text-centered" style="margin: 30px auto"><a href="G1-2-4.php">新規登録の方はこちら</a></div>';
    }
}
?>
<style>
    .text{
        margin: 40px auto;
    }
</style>
<?php require 'footer.php'; ?>
