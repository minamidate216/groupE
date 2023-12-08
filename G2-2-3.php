<?php
require 'db-connect.php';
require 'header.php';
?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>商品登録</title>
    <!-- 以下はお好みでCSSファイルを追加 -->
    <style>
        .container {
            max-width: 600px;
            margin: 20px auto;
        }

        h1, p, img {
            text-align: center;
        }

        .has-text-primary-dark {
            color: #363636; /* お好みの色に変更 */
        }

        .has-text-danger {
            color: #ff3860; /* エラーメッセージの色 */
        }

        .center {
            text-align: center;
        }
    </style>
</head>
<body>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $errors = []; // エラーメッセージを格納するための配列

    $product_name = $_POST['product_name'];
    $price = $_POST['price'];
    $description = $_POST['description'];
    $capacity = $_POST['capacity'];
    $category = $_POST['category'];
    $quantity = $_POST['quantity'];

    // 商品名、価格、説明、画像、内容量、カテゴリ、在庫数が空でないことを確認
    if (empty($product_name) || empty($price) || empty($description) || empty($capacity) || empty($category) || empty($quantity)) {
        $errors[] = "すべての必須フィールドを入力してください。";
    }

    // 画像がアップロードされていない場合もエラー
    if (empty($_FILES['product_img']['name'])) {
        $errors[] = "商品画像を選択してください。";
    } else {
        // ファイルの保存先
        $upload = './uploads/' . $_FILES['product_img']['name'];
        // アップロードが正しく完了したかチェック
        if (move_uploaded_file($_FILES['product_img']['tmp_name'], $upload)) {
            $product_img = $upload;
        } else {
            $errors[] = "商品画像のアップロードに失敗しました。";
        }
    }

    // 価格、内容量、在庫数が正の値であることを確認
    if (!is_numeric($price) || $price < 0 || !is_numeric($quantity) || $quantity < 0) {
        $errors[] = "価格、内容量、在庫数は正の値を入力してください。";
    }

    // エラーがない場合に確認画面を表示
    if (empty($errors)) {
        // 以下、確認画面の表示部分はそのままです
        echo "<div class='container'>";
        echo "<h1 class='has-text-primary-dark'>商品登録確認</h1>";
        echo "<p class='has-text-primary-dark'>商品名: $product_name</p>";
        echo "<p class='has-text-primary-dark'>商品価格: $price</p>";
        echo "<p class='has-text-primary-dark'>説明: $description</p>";
        echo "<p class='has-text-primary-dark'>商品画像: $product_img</p>";
        echo '<p class="has-text-primary-dark">画像:<img src="', $product_img, '" alt="商品画像" width="200px"></p>';
        echo "<p class='has-text-primary-dark'>内容量: $capacity</p>";
        echo "<p class='has-text-primary-dark'>カテゴリ: $category</p>";
        echo "<p class='has-text-primary-dark'>在庫数: $quantity</p>";

        echo '<form action="G2-2-4.php" method="post">';
        echo '<input type="hidden" name="product_name" value="', $product_name, '">';
        echo '<input type="hidden" name="price" value="', $price, '">';
        echo '<input type="hidden" name="description" value="', $description, '">';
        echo '<input type="hidden" name="product_img" value="', $product_img, '">';
        echo '<input type="hidden" name="capacity" value="', $capacity, '">';
        echo '<input type="hidden" name="category" value="', $category, '">';
        echo '<input type="hidden" name="quantity" value="', $quantity, '">';
        echo '<div class="center">'; // 中央寄せのクラスを追加
        echo '<button class="button is-primary">登録</button>';
        echo '<a href="G2-2-2.php"><button type="button" class="button is-primary">戻る</button></a>';
        echo '</div>';
        echo '</form>';
        echo '</div>';
    } else {
        // エラーがある場合にエラーメッセージを表示
        echo "<div class='container'>";
        foreach ($errors as $error) {
            echo "<p class='has-text-danger'>$error</p>";
        }
        echo "<a href='G2-2-2.php'><button type='button' class='button is-primary'>戻る</button></a>";
        echo '</div>';
    }
}
?>

</body>
</html>
