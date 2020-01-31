<?php
    // セッション変数の利用を宣言する
    session_start();

    // テンプレートファイル(top.html)を読み込む
    $html = file_get_contents('html/top.html');

    // 認証処理
    require_once( 'include/auth.inc.php' );

    // テンプレートファイルを、入力された値で書き換える(書き換えるものがない)

    // 変換されてできたhtmlファイルを表示する
    echo $html;
