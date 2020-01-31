<?php
    // セッション変数の利用を宣言する
    session_start();

    // 認証処理
    require_once( 'include/auth.inc.php' );

    // GETパラメーターから、投稿データを取得する
    $post = $_GET['post'];

    // 投稿データをデータベースに登録する
    if ( !empty( $post ) ) {
        // データベースに接続する
        $dbh = new PDO('mysql:host=localhost;dbname=tclone', 'tcladmin', 'password');
        // データを登録するためのSQLを登録する
        $sth = $dbh->prepare('INSERT INTO posts ( user_id, post ) VALUES( :user_id, :post )');
        $sth->bindParam(':user_id', $users_user_id,  PDO::PARAM_STR);
        $sth->bindParam(':post',    $post,           PDO::PARAM_STR);

        $sth->execute();
    }

    // タイムライン画面にリダイレクトする
        header('Location: ./timeline.php');
        exit;







