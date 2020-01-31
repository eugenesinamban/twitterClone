<?php
    // セッション変数の利用を宣言する
    session_start();

    // テンプレートファイル(logout.html)を読み込む
    $html = file_get_contents('html/logout.html');

    // SESSION変数から、アカウント名とパスワードを消去する
    unset( $_SESSION['account'] );
    unset( $_SESSION['password'] );

    // テンプレートファイルを、入力されsた値で書き換える(書き換えるものがない)

    // 変換されてできたhtmlファイルを表示する
    echo $html;
