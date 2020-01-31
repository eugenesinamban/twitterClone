<?php

    // テンプレートファイル(mail_sent.html)を読み込む
    $html = file_get_contents('html/mail_sent.html');

    // GETパラメータから、メールアドレスを取得する
    $email = $_GET['email'];

    // ！仮登録されたデータ用のリンクを作成する
    $link = bin2hex( openssl_random_pseudo_bytes(16) );
    $link_url = 'http://localhost/codedrunk/tclone/user_regist.php?l=' . $link;
//var_dump( $link );
//var_dump( $link_url );

    // ！データベースの仮ユーザーテーブル(pre_users)に、
    // 入力されたメールアドレスで仮登録する
        // データベースに接続する
        $dbh = new PDO('mysql:host=localhost;dbname=tclone', 'tcladmin', 'password');
        // データを登録する
        $sth = $dbh->prepare('INSERT INTO pre_users (email, link) VALUES( :email, :link )');

        $sth->bindParam(':email', $email, PDO::PARAM_STR);
        $sth->bindParam(':link',  $link,  PDO::PARAM_STR);

        $sth->execute();

    // ！作成したリンクを含むメールを、入力されたメールアドレスに送信する
    // !!xampp環境では未実装


    // テンプレートファイルを、入力された値で書き換える
    $html = preg_replace( '/%%%link_url%%%/', $link_url, $html );

    // 変換されてできたhtmlファイルを表示する
    echo $html;
