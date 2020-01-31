<?php

    // テンプレートファイル(mail_regist.html)を読み込む
    $html = file_get_contents('html/mail_regist.html');

    // テンプレートファイルを、入力された値で書き換える(書き換えるものがない)

    // 変換されてできたhtmlファイルを表示する
    echo $html;
