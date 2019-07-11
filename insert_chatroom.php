<?php
include('functions.php');

// 入力チェック
if (
    !isset($_POST['roomname']) || $_POST['roomname'] == '' ||
    !isset($_POST['roomsummary']) || $_POST['roomsummary'] == ''
) {
    exit('ParamError');
}

//POSTデータ取得
$roomname = $_POST['roomname'];
$roomsummary = $_POST['roomsummary'];

//DB接続
$pdo = db_conn();

//データ登録SQL作成
$sql = 'INSERT INTO t_chatroom (id, roomname, roomsummary)
VALUES(NULL, :a1, :a2)';

$stmt = $pdo->prepare($sql);
$stmt->bindValue(':a1', $roomname, PDO::PARAM_STR);
$stmt->bindValue(':a2', $roomsummary, PDO::PARAM_STR);
$status = $stmt->execute();

//データ登録処理後
if ($status == false) {
    errorMsg($stmt);
} else {
    //index.phpへリダイレクト
    header('Location: index_chatroom.php');
}
