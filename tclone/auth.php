<?php
    // セッション変数の利用を宣言する
    session_start();

    // GETパラメーターから、アカウント名とパスワードを取得する
    $account  = $_GET['account'];
    $password = $_GET['password'];

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

    // ログインできた場合は、セッション変数にユーザーとパスワード（平文）を登録してtopに遷移
        $_SESSION['account'] = $account;
        $_SESSION['password'] = $password;

        header('Location: ./top.php');
        exit;














