<?php
    // セッション変数の利用を宣言する
    session_start();

    // テンプレートファイル(user_regist.html)を読み込む
    $html = file_get_contents('html/user_regist.html');

    // ！リンクについているパラメーターを取得する
    $link = $_GET['l'];
var_dump( $link );

    // ！リンクパラメーターに一致する仮登録データを取得する

      // 24時間前のタイムスタンプを取得する
        $datetime = new DateTime( "now", new DateTimeZone("Asia/Tokyo") );
        $datetime->sub( new DateInterval("P1D") );
        $limit = $datetime->format('Y-m-d H:i:s');

      // データベースに接続する
        $dbh = new PDO('mysql:host=localhost;dbname=tclone', 'tcladmin', 'password');

      // 24時間を経過したデータを消しておく
        // データを消去するためのSQLを登録する
        $sth = $dbh->prepare('DELETE FROM pre_users WHERE created_at < :limit');
        $sth->bindParam(':limit',  $limit,  PDO::PARAM_STR);

        $sth->execute();

      // 該当する仮データを取得する
        // データを取得するためのSQLを登録する
        $sth = $dbh->prepare('SELECT * FROM pre_users WHERE link = :link');
        $sth->bindParam(':link',  $link,  PDO::PARAM_STR);

        $sth->execute();

        // 結果を取得する
        $result = $sth->fetch(PDO::FETCH_ASSOC);

      // 取得できたら、emailを取得する。
      // 取得できなかった場合、エラー画面を表示する
        if ( $result ) {
            $email = $result['email'];
            // セッション変数に登録する
            $_SESSION['pre_users']['id'] = $result['id'];
            $_SESSION['pre_users']['email'] = $result['email'];
            // XXX $_SESSION['pre_users'] = $result; ではだめなのか？
        } else {
            // テンプレートファイル(regist_error.html)を読み込む
            $html = file_get_contents('html/regist_error.html');
            echo $html;
            // 全体の処理を終了
            exit;
        }

    // テンプレートファイルを、入力された値で書き換える(書き換えるものがない)

    // 変換されてできたhtmlファイルを表示する
    echo $html;
