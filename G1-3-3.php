<?php session_start();?>
<?php require 'db-connect.php'; ?>
<?php

$pdo = new PDO($connect, USER, PASS);

    echo 'マイページ';

    foreach ($pdo->query('select * from Users') as $row) {

        echo '<form action="G1-3-4" method="post">';
        echo '<table>';
        echo '<tr><td>氏名</td><td>';
        echo $row['user_name'];
        echo '</td></tr>';
        echo '<tr><td>メールアドレス</td><td>';
        echo $row['email'];
        echo '</td></tr>';
        echo '<tr><td>パスワード</td><td>';
        $hashedPassword = $row['password'];
        $displayedPassword = str_repeat('*', strlen($hashedPassword));
        echo $displayedPassword, '</td></tr>';
        echo '<tr><td>住所</td><td>';
        echo $row['address'];
        echo '</td></tr>';
        echo '</table>';
        echo '<input type="submit" value="登録情報を更新する">';
        echo '</form>';
    }
    ?>