<?php
    // セッション変数の利用を宣言する
    session_start();

    // テンプレートファイル(profile.html)を読み込む
    $html = file_get_contents('html/profile.html');

    // 認証処理
    require_once( 'include/auth.inc.php' );

    // GETパラメータより、usersのIDを取得する
    $user_id = $_GET['i'];

        // データベースに接続する
        $dbh = new PDO('mysql:host=localhost;dbname=tclone', 'tcladmin', 'password');
        // データを取得するためのSQLを登録する
        $sth = $dbh->prepare('SELECT * FROM users WHERE id = :id');
        $sth->bindParam(':id', $user_id,  PDO::PARAM_STR);

        $sth->execute();

        $user = $sth->fetch( PDO::FETCH_ASSOC );

    // テンプレートファイルを、入力された値で書き換える
    $html = preg_replace( '/%%%id%%%/', $user_id, $html );
    $html = preg_replace( '/%%%name%%%/', $user['name'], $html );

    // 変換されてできたhtmlファイルを表示する
    echo $html;
