<?php
    // セッション変数の利用を宣言する
    session_start();

    // GETパラメータから値を取得する
    $account = $_GET['account'];
    $password = $_GET['password'];
    $password_confirm = $_GET['password_confirm'];

    // セッション変数から値を取得する
    $email = $_SESSION['pre_users']['email'];

var_dump( $_SESSION );

// パスワードが一致しなかったら、入力に戻る
    if ( strcmp( $password, $password_confirm ) != 0 ) {
var_dump( $password );
var_dump( $password_confirm );
        header('Location: ./user_regist.php' );
        exit;
    }

    // 取得した値をセッション変数に設定する
    $_SESSION['users']['account'] = $account;
    $_SESSION['users']['password'] = $password;

    // テンプレートファイル(user_regist_confirm.html)を読み込む
    $html = file_get_contents('html/user_regist_confirm.html');

    // テンプレートファイルを、入力された値で書き換える(書き換えるものがない)
    $html = preg_replace( '/%%%account%%%/', $account, $html );
    $html = preg_replace( '/%%%email%%%/', $email, $html );

    // 変換されてできたhtmlファイルを表示する
    echo $html;
