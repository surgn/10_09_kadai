<?php
include('functions.php');

var_dump($_POST['booklink']);
var_dump($_POST['category']);

//POSTデータ取得
$booklink = $_POST['booklink'];
$category = $_POST['category'];


//DB接続
$pdo = connectToDb();

$sql = 'INSERT INTO book_log_table(id, category, booklink, indate) VALUES(NULL, :a1, :a2, sysdate())';

$stmt = $pdo->prepare($sql);
$stmt->bindValue(':a1', $category, PDO::PARAM_STR);    //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':a2', $booklink, PDO::PARAM_STR);   //Integer（数値の場合 PDO::PARAM_INT)
// $stmt->bindValue(':a3', $comment, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$status = $stmt->execute();


//データ登録処理後
if ($status == false) {
    showSqlErrorMsg($stmt);
} else {
    //index.phpへリダイレクト
    header('Location:'.$booklink);
}
