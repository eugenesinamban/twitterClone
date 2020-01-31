<?php
  // 認証処理
    // SESSION変数から、アカウント名とパスワードを取得する
    $account  = $_SESSION['account'];
    $password = $_SESSION['password'];

    // データベースに接続し、該当ユーザーがいるかどうか、パスワードが一致するかどうか判定する
        // データベースに接続する
        $dbh = new PDO('mysql:host=localhost;dbname=tclone', 'tcladmin', 'password');
        // データを取得するためのSQLを登録する
        $sth = $dbh->prepare('SELECT * FROM users WHERE name = :name');
        $sth->bindParam(':name',     $account,   PDO::PARAM_STR);

        $sth->execute();

        $result = $sth->fetch();

    // 一致しない場合はログイン画面にリダイレクトする
        if ( !password_verify( $password, $result['password'] ) ) {
            header('Location: ./login.php');
            exit;
        }

        // usersテーブルのユーザーIDを取得する
        $users_user_id = $result['id'];
?>