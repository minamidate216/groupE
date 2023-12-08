<?php require 'header.php'; ?>

<?php
echo '<h1 class="has-text-centered is-size-2">Miyoshi Columns</h1><br><br>';
$pdo = new PDO($connect, USER, PASS);
$sql = $pdo->query('select * from Columns');
echo '<div class="mar">';
echo '<div class="columns is-multiline">';
foreach($sql as $row){
    echo '<div class="column is-one-third">';
    echo '<div class="has-text-centered"><a href="G1-4-2.php?column_id=',$row['column_id'],'">';
    echo '<img src="image/',$row['post_img'],'" width=100px height=100px class="has-text-centered"><br>';
    echo $row['column_title'],'<a/></div>';
    echo '</div>';
    echo '<br>';
}
echo '</div></div>';
?>
<style>
.mar{
    margin: auto 70px auto 50px;
}
</style>
<?php require 'footer.php'; ?>