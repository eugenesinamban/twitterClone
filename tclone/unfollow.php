<?php
    // セッション変数の利用を宣言する
    session_start();

    // 認証処理
    require_once( 'include/auth.inc.php' );

    // GETパラメーターから、フォローするユーザーIDを取得する
    $followed_id = $_GET['i'];

    // 投稿データをデータベースに登録する
        // データベースに接続する
        $dbh = new PDO('mysql:host=localhost;dbname=tclone', 'tcladmin', 'password');
        // データを削除するためのSQLを登録する
        $sth = $dbh->prepare('DELETE FROM userlinks where following_user_id = :following_id AND followed_user_id = :followed_id');
        $sth->bindParam(':following_id', $users_user_id,  PDO::PARAM_STR);
        $sth->bindParam(':followed_id', $followed_id, PDO::PARAM_STR);

        $sth->execute();

    // タイムライン画面にリダイレクトする
        header('Location: ./profile.php?i=' . $followed_id );
        exit;







