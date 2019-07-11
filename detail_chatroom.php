<?php
// セッションのスタート
session_start();

//0.外部ファイル読み込み
include('functions.php');

// ログイン状態のチェック
chk_ssid();

$menu = menu($_SESSION['kanri_flg']);

// getで送信されたidを取得
if (!isset($_GET['id'])) {
    exit("Error");
}

//チャットルームのID
$id = $_GET['id'];
$userid = $_SESSION['userid'];

//DB接続します
$pdo = db_conn();

//データ登録SQL作成，指定したidのみ表示する
//チャットルームの名称を取得する。
$sql = 'SELECT * FROM t_chatroom WHERE id=:id';
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':id', $id, PDO::PARAM_INT);
$status = $stmt->execute();

//データ表示
if ($status == false) {
    errorMsg($stmt);
} else {
    $rs_chatroom = $stmt->fetch();
}

//入ってるチャットルームのIDから、そのルームのメッセージを取得する。inputdatetimeの昇順で取得する。
$sql = '';
$sql .= ' select * from t_chatjournal ';
$sql .= ' Inner Join user_table On t_chatjournal.userid = user_table.id ';
$sql .= ' where chatroomid = :id ';
$sql .= ' order by inputdatetime';

$stmt_message = $pdo->prepare($sql);
$stmt_message->bindValue(':id', $id, PDO::PARAM_INT);
$status_message = $stmt_message->execute();


//３．チャットデータビューの作成
$view_chat = '';
if ($status_message == false) {
    errorMsg($stmt_message);
} else {
    while ($result_message = $stmt_message->fetch(PDO::FETCH_ASSOC)) {
        // $view .= '<li class="list-group-item">';
        // $view .= '<p>' . $result['roomname'] . '-' . $result['roomsummary'] . '</p>';
        // $view .= '<a href="detail_chatroom.php?id=' . $result['id'] . '" class="badge badge-primary">入る</a>';
        // $view .= '</li>';
        //自分の発言と相手の発言を分ける。

        if ($result_message['userid'] == $_SESSION['userid']) {
            //自分の発言だったとき
            $view_chat .= '<div class="line__right">';
            $view_chat .= '<div class="text">' . $result_message['message'] . '</div>';
            $view_chat .= '<span class="date">既読<br>0:30</span>';
            $view_chat .= '</div>';
        } else {
            //相手の発言だったとき
            $view_chat .= '<div class="line__left">';
            $view_chat .= '<figure>';
            $view_chat .= '<img src="icon.png" />';
            $view_chat .= '</figure>';
            $view_chat .= '<div class="line__left-text">';
            $view_chat .= '<div class="name">' . $result_message['name'] . '</div>';
            $view_chat .= '<div class="text">' . $result_message['message'] . '</div>';
            $view_chat .= '</div>';
            $view_chat .= '</div>';
        }
    }
}


// $sql = 'SELECT * FROM t_chatroom WHERE id=:id';
// $sql .= '';
// $stmt = $pdo->prepare($sql);
// $stmt->bindValue(':id', $id, PDO::PARAM_INT);
// $status = $stmt->execute();



?>


<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>チャットルーム</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
    <link rel='stylesheet' href='style.css' type='text/css' media='all' />
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
            <a class="navbar-brand" href="#">チャットルーム</a>
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

    <!-- ▼LINE風ここから -->
    <div class="line__container">
        <!-- タイトル -->
        <div class="line__title">
            <?= $rs_chatroom['roomname'] ?>
        </div>

        <<!-- ▼会話エリア scrollを外すと高さ固定解除 -->
            <div id="chatdiv" class="line__contents scroll">
                <!-- ここに吹き出しやスタンプのタグを追加していく -->
                <!-- 相手の吹き出し -->
                <?= $view_chat ?>
            </div>
            <!--　▲会話エリア ここまで -->
    </div>
    <!--　▲LINE風 ここまで -->
    <form>
        <div class="form-group">
            <label for="message">メッセージ</label>
            <input type="text" class="form-control" id="message" name="message" placeholder="Enter message">
        </div>
        <div class="form-group">
            <button id="send" type="button" class="btn btn-primary">送信</button>
        </div>
    </form>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script>
        var obj = document.getElementById('chatdiv');
        obj.scrollTop = obj.scrollHeight;

        // DBから取得したデータを表示する関数
        function listData(data) {
            // 書ける人は書いてみよう
            // JSONのデータを使って、再度チャット部分をリロードする。
            // 一度チャットDIVの中を空にする。
            $("#chatdiv").empty();

            //取得したJSONデータを利用してDOMを生成。
            let strviewchat;
            for (var item in data) {
                console.log(data[item]['userid']);
                console.log(data[item]['name']);
                console.log(data[item]['message']);
                //console.log(data[item]['message']);
                if (data[item]['userid'] == <?php echo $userid; ?>) {
                    //自分の発言だったとき
                    strviewchat += '<div class="line__right">';
                    strviewchat += '<div class="text">' + data[item]['message'] + '</div>';
                    strviewchat += '<span class="date">既読<br>0:30</span>';
                    strviewchat += '</div>';
                } else {
                    //相手の発言だったとき
                    strviewchat += '<div class="line__left">';
                    strviewchat += '<figure>';
                    strviewchat += '<img src="icon.png" />';
                    strviewchat += '</figure>';
                    strviewchat += '<div class="line__left-text">';
                    strviewchat += '<div class="name">' + data[item]['name'] + '</div>';
                    strviewchat += '<div class="text">' + data[item]['message'] + '</div>';
                    strviewchat += '</div>';
                    strviewchat += '</div>';
                }
            }

            //DOMが組み上がったら、再度追加
            $("#chatdiv").append(strviewchat);
            var obj = document.getElementById('chatdiv');
            obj.scrollTop = obj.scrollHeight;
        }

        // DBからデータを取得する関数
        function selectData() {
            const url = 'ajax_get.php';
            //.log(url);
            $.getJSON(url)
                .done(function(data, textStatus, jqXHR) {
                    console.log(data);
                })
                .fail(function(jqXHR, textStatus, errorThrown) {})
                .always(function() {});
        }


        // DBへデータを登録する関数
        function insertData() {
            const url = 'ajax_post_chatroom.php';
            const value = {
                userid: <?php echo $userid; ?>,
                message: $('#message').val(),
                chatroomid: <?php echo $id; ?>
            };

            // データ送信
            $.ajax({
                    dataType: 'json',
                    url: url,
                    type: 'POST',
                    data: value
                })
                .done(function(data) {
                    // データを再表示させる。
                    listData(data);
                    //console.log(data);
                })
                .fail(function(XMLHttpRequest, textStatus, errorThrown) {
                    console.log('失敗した？？');
                    console.log("ajax通信に失敗しました");
                    console.log("jqXHR          : " + XMLHttpRequest.status); // HTTPステータスが取得
                    console.log("textStatus     : " + textStatus); // タイムアウト、パースエラー
                    console.log("errorThrown    : " + errorThrown.message); // 例外情報
                    console.log("URL            : " + url);
                })
                .always(function() {});
        }

        // 読み込み時にDBからデータ取得
        //selectData();

        // 送信でDBにデータ送信
        $('#send').on('click', function() {
            insertData();
            $('#message').val('');
        });
    </script>



</body>

</html>