<?php

include('functions.php');

// 入力チェック
if (
    !isset($_POST['userid']) || $_POST['userid'] == '' ||
    !isset($_POST['message']) || $_POST['message'] == '' ||
    !isset($_POST['chatroomid']) || $_POST['chatroomid'] == ''
) {
    var_dump('エラーじゃね？');
    exit('ParamError');
}

//POSTデータ取得
$userid = $_POST['userid'];
$message = $_POST['message'];
$chatroomid = $_POST['chatroomid'];


//DB接続
$pdo = db_conn();

$sql = 'INSERT INTO t_chatjournal(id, userid, message, inputdatetime, chatroomid) VALUES(NULL, :a1, :a2, sysdate(), :a3)';


$stmt = $pdo->prepare($sql);
$stmt->bindValue(':a1', $userid, PDO::PARAM_INT);    //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':a2', $message, PDO::PARAM_STR);   //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':a3', $chatroomid, PDO::PARAM_INT);  //Integer（数値の場合 PDO::PARAM_INT)
$status = $stmt->execute();

// //データ登録処理後
if ($status == false) {
    showSqlErrorMsg($stmt);
} else {
    //index.phpへリダイレクト
    //header('Location: index.php');
}

//データ表示SQL作成
$sql = '';
$sql .= ' select * from t_chatjournal ';
$sql .= ' Inner Join user_table On t_chatjournal.userid = user_table.id ';
$sql .= ' where chatroomid = :id ';
$sql .= ' order by inputdatetime';

$stmt = $pdo->prepare($sql);
$stmt->bindValue(':id', $chatroomid, PDO::PARAM_INT);
$status = $stmt->execute();


//データ表示
if ($status == false) {
    showSqlErrorMsg($stmt);
} else {
    $res = [];
    while ($result = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $res[] = $result; // 配列に入れる 
    }
    echo json_encode($res);
}
