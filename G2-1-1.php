<?php session_start(); ?>
<head>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.3/css/bulma.min.css" />
</head>
<div class="content">
    <div class="container">
        <h3 class="title is-3 has-text-centered">管理者登録</h3>
        <form action="G2-1-2.php" method="post" class="is-centered">
            <div class="has-text-centered"> 
                <label for="admin_name"></label>
                <input type="text" placeholder="氏名" name="admin_name" maxlength="50" required><br>

                <label for="email"></label>
                <input type="email" placeholder="メールアドレス" name="email" maxlength="100" required><br>

                <label for="admin_id"></label>
                <input type="text" placeholder="ID" name="admin_id" maxlength="8" required><br>

                <label for="password"></label>
                <input type="password" placeholder="パスワード" name="password" maxlength="30" required><br>

                <input class="button has-background-success-dark has-text-white" type="submit" value="新規登録">
            </div>
        </form>
    </div>
</div>
<?php require 'footer.php'; ?>
