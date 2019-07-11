<?php
// 関数ファイル読み込み
var_dump($_POST);

include('functions.php');

//入力チェック(受信確認処理追加)
// 入力チェック
if (
    !isset($_POST['username']) || $_POST['username'] == '' ||
    !isset($_POST['lid']) || $_POST['lid'] == '' ||
    !isset($_POST['lpw']) || $_POST['lpw'] == ''
) {
    exit('ParamError');
}

//POSTデータ取得
//POSTデータ取得
$username = $_POST['username'];
$lid = $_POST['lid'];
$lpw = $_POST['lpw'];
$kanri_flg = $_POST['kanri_flg'];
$life_flg = $_POST['life_flg'];
$id = $_POST['id'];

//DB接続します(エラー処理追加)
$pdo = db_conn();

//データ登録SQL作成
$sql = 'Update user_table SET name =:a1, lid = :a2, lpw = :a3, kanri_flg = :a4, life_flg = :a5 WHERE id = :id';
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':a1', $username, PDO::PARAM_STR);
$stmt->bindValue(':a2', $lid, PDO::PARAM_STR);
$stmt->bindValue(':a3', $lpw, PDO::PARAM_STR);
$stmt->bindValue(':a4', $kanri_flg, PDO::PARAM_INT);
$stmt->bindValue(':a5', $life_flg, PDO::PARAM_INT);
$stmt->bindValue(':id', $id, PDO::PARAM_INT);
$status = $stmt->execute();

//4．データ登録処理後
if ($status == false) {
    errorMsg($stmt);
} else {
    header('Location: user_select.php');
    exit;
}
