<?php session_start();?>
<?php require 'db-connect.php';?>

<?php
    unset($_SESSION['admin']);
    $pdo=new PDO($connect,USER,PASS);
    $sql=$pdo->prepare('select * from Admins where admin_id=? and password=?');
    $sql->execute([$_POST['id'],$_POST['password']]);
    foreach($sql as $row){
        $_SESSION['admin']=[
            'id'=>$row['admin_id'],'name'=>$row['admin_name'],
            'password'=>$row['password'],'email'=>$row['email']];
    }
    if(isset($_SESSION['admins'])){
        echo 'いらっしゃいませ、',$_SESSION['admin']['admin_name'],'さん。';
    }else{
        echo 'ログイン名またはパスワードが違います。';
    }
    ?>