<?php
//1. DB接続
// $dbn = 'mysql:dbname=gsf_d03_db26;charset=utf8;port=3306;host=localhost';
// $user = 'root';
// $pwd = 'root';

// try {
//     $pdo = new PDO($dbn, $user, $pwd);
// } catch (PDOException $e) {
//     exit('dbError:' . $e->getMessage());
// }
include('functions.php');
// セッションのスタート
session_start();

// ログイン状態のチェック
chk_ssid();

$menu = menu($_SESSION['kanri_flg']);



$pdo = db_conn();

//データ表示SQL作成
$sql = "
        SELECT id, name, lid, lpw, kanri_flg,
        (case 
        when kanri_flg = 0 then ' 一般 ' 
        when kanri_flg=1 then ' 管理者 ' 
        Else ' ' END) As kanri_flg_ja,
        life_flg,
        (case 
        when life_flg = 0 then ' アクティブ '
        when life_flg = 1 then ' 非アクティブ ' 
        else ' ' end ) As life_flg_ja
        FROM gsf_d03_db26.user_table;
        ";

$stmt = $pdo->prepare($sql);
$status = $stmt->execute();

//データ表示
$view = '';
if ($status == false) {
    //execute（SQL実行時にエラーがある場合）
    $error = $stmt->errorInfo();
    exit('sqlError:' . $error[2]);
} else {

    //ここはリストにちゃんと出したい。
    $view .= '<table class="table table-striped">';
    //tableのヘッダ部
    $view .= '<tr><th>更新ボタン</th><th>削除ボタン</th><th>ユーザー名</th><th>ユーザーID</th><th>パスワード</th><th>管理者フラグ</th><th>アクティブフラグ</th></tr>';

    //Selectデータの数だけ自動でループしてくれる
    //http://php.net/manual/ja/pdostatement.fetch.php
    while ($result = $stmt->fetch(PDO::FETCH_ASSOC)) {


        //trタグで囲む
        $view .= '<tr>';

        //更新、削除ボタン部分
        $view .= '<td><a href="user_detail.php?id=' . $result[id] . '" class="badge badge-primary">Edit</a></td>';
        $view .= '<td><a href="user_delete.php?id=' . $result[id] . '" class="badge badge-danger">Delete</a></td>';

        //情報部分
        $view .= '<td>' . $result['name'] . '</td>';
        $view .= '<td>' . $result['lid'] . '</td>';
        $view .= '<td>' . $result['lpw'] . '</td>';
        $view .= '<td>' . $result['kanri_flg_ja'] . '</td>';
        $view .= '<td>' . $result['life_flg_ja'] . '</td>';
        $view .= '</tr>';
    }
    $str .= '<tr></tr>';
    $str .= '</table>';
}
?>



<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>ユーザーリスト表示</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
    <style>
        div {
            padding: 10px;
            font-size: 16px;
        }
    </style>
</head>

<body>
    <header>
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <a class="navbar-brand" href="#">ユーザー 一覧</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <?= $menu ?>
                </ul>
            </div>
        </nav>
    </header>

    <div>
        <ul class="list-group">
            <?= $view ?>
        </ul>
    </div>

</body>

</html>