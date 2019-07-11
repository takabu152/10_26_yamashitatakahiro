<?php
// セッションのスタート
session_start();

//0.外部ファイル読み込み
include('functions.php');

// ログイン状態のチェック
chk_ssid();

$menu = menu($_SESSION['kanri_flg']);
if ($_SESSION['kanri_flg'] == 0) {
    header("Location: select.php");
}

?>

<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>ユーザー登録</title>
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
            <a class="navbar-brand" href="#">ユーザー登録</a>
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

    <form method="post" action="user_insert.php">
        <div class="form-group">
            <label for="username">ユーザー名</label>
            <input type="text" class="form-control" id="username" name="username" placeholder="Enter name">
        </div>
        <div class="form-group">
            <label for="lid">ログインID</label>
            <input type="text" class="form-control" id="lid" name="lid" placeholder="Enter Login ID">
        </div>
        <div class="form-group">
            <label for="lpw">パスワード</label>
            <input type="text" class="form-control" id="lpw" name="lpw" placeholder="Enter Password">
        </div>
        <div class="form-group">
            <label for="kanri_flg">管理者フラグ</label>
            <div class="col-xs-3">
                <select class="form-control" id="kanri_flg" name="kanri_flg">
                    <option value="0">一般</option>
                    <option value="1">管理者</option>
                </select>
            </div>
            <!-- <input type="date" class="form-control" id="indate" name ="indate"> -->
        </div>
        <div class="form-group">
            <label for="life_flg">アクティブフラグ</label>
            <div class="col-xs-3">
                <select class="form-control" id="life_flg" name="life_flg">
                    <option value="0">アクティブ</option>
                    <option value="1">非アクティブ</option>
                </select>
            </div>
            <!-- <input type="date" class="form-control" id="indate" name ="indate"> -->
        </div>

        <div class="form-group">
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>
    </form>

</body>

</html>