<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.3/css/bulma.min.css">
    <title>ログイン画面</title>
    <style>
        body {
            display: flex;
            align-items: center;
            justify-content: center;
            height: 35vh;
            margin: 0;
            flex-direction: column; 
        }
        
        h1 {
            margin-bottom: 10px; 
            font-size: 35px;
        }

        .input {
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
            margin: 0;
            flex-direction: column;
        }

        .miyo {
            margin-top: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        
        .awich {
            margin-top: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
        }
    </style>
</head>
<body>
    <h1>管理者ログイン</h1>
    <div class="input">
        <form action="G2-1-4login-output.php" method="post">
            <input type="text" placeholder="ID"name="admin_id"><br>
            パスワード<input type="password"  placeholder="パスワード" name="password"><br>
            <div class="miyo">
                <button class="button is-primary">ログイン</button>
            </div>
            <p class="awich">
                <a href="G2-1-1.php" class="button is-primary is-light"><button type="button">新規登録</button></a>
            </p>
        </form>
    </div>
</body>
</html>
