<?php
    // セッション変数の利用を宣言する
    session_start();

    // セッション変数から値を取得する
    $account      = $_SESSION['users']['account'];
    $pre_users_id = $_SESSION['pre_users']['id'];
    $email        = $_SESSION['pre_users']['email'];
    $password     = password_hash( $_SESSION['users']['password'], PASSWORD_DEFAULT );

var_dump( $pre_users_id );

// ！セッション変数で渡されたデータをデーターベースに登録する
        // データベースに接続する
        $dbh = new PDO('mysql:host=localhost;dbname=tclone', 'tcladmin', 'password');
        // データを登録するためのSQLを登録する
        $sth = $dbh->prepare('INSERT INTO users (name, email, password) VALUES( :name, :email, :password )');
        $sth->bindParam(':name',    $account,  PDO::PARAM_STR);
        $sth->bindParam(':email',   $email,    PDO::PARAM_STR);
        $sth->bindParam(':password',$password, PDO::PARAM_STR);

        $sth->execute();

        // 利用したpre_usersの情報を消す
        // データを消去するためのSQLを登録する
        $sth = $dbh->prepare('DELETE FROM pre_users WHERE id = :id');
        $sth->bindParam(':id', $pre_users_id,  PDO::PARAM_STR);

        $sth->execute();



    echo '処理完了';
