<?php
//共通で使うものを別ファイルにしておきましょう。

//DB接続関数（PDO）
function db_conn()
{
    $dbn = 'mysql:dbname=gsf_d03_db26;charset=utf8;port=3306;host=localhost';
    $user = 'root';
    $pwd = 'root';

    try {
        return new PDO($dbn, $user, $pwd);
    } catch (PDOException $e) {
        exit('dbError:' . $e->getMessage());
    }
}

function chk_ssid()
{
    // 失敗時はログイン画面に戻る(セッションidがないor一致しない)
    if (!isset($_SESSION['chk_ssid']) || $_SESSION['chk_ssid'] != session_id()) {
        header('Location: login.php');
    } else {
        session_regenerate_id(true);
        $_SESSION['chk_ssid'] = session_id();
    }
}

// menuを決める
function menu($flg)
{
    if ($flg == 2) {
        //非ログインユーザーのメニュー
        $menu = '<li class="nav-item"><a class="nav-link" href="login.php">ログインページ</a></li>';
        //$menu .= '<li class="nav-item"><a class="nav-link" href="select_nologin.php">todo一覧</a></li>';
    } elseif ($flg == 0) {
        //ユーザーメニュー
        $menu .= '<li class="nav-item"><a class="nav-link" href="select_chatroom.php">チャットルーム一覧</a></li>';
        $menu .= '<li class="nav-item"><a class="nav-link" href="logout.php">ログアウト</a></li>';
    } elseif ($flg == 1) {
        //管理者メニュー
        $menu .= '<li class="nav-item"><a class="nav-link" href="index_chatroom.php">チャットルーム登録</a></li>';
        $menu .= '<li class="nav-item"><a class="nav-link" href="select_chatroom.php">チャットルーム一覧</a></li>';
        $menu .= '<li class="nav-item"><a class="nav-link" href="user_index.php">User登録</a></li>';
        $menu .= '<li class="nav-item"><a class="nav-link" href="user_select.php">User管理</a></li>';

        $menu .= '<li class="nav-item"><a class="nav-link" href="logout.php">ログアウト</a></li>';
    }
    return $menu;
}

//SQL処理エラー
function errorMsg($stmt)
{
    $error = $stmt->errorInfo();
    exit('ErrorQuery:' . $error[2]);
}

function h($str)
{
    return htmlspecialchars($str, ENT_QUOTES, 'UTF-8');
}
