<?php
    // セッション変数の利用を宣言する
    session_start();

    // テンプレートファイル(timeline.html)を読み込む
    $html = file_get_contents('html/timeline.html');

    // 認証処理
    require_once( 'include/auth.inc.php' );

    // データベースから投稿データを取得する
        // データベースに接続する
        $dbh = new PDO('mysql:host=localhost;dbname=tclone', 'tcladmin', 'password');
        // データを取得するためのSQLを登録する
        $sth = $dbh->prepare('SELECT posts.user_id, posts.post, posts.created_at,users.name FROM posts INNER JOIN users ON posts.user_id = users.id ORDER BY posts.created_at DESC');

        $sth->execute();

        $posts = $sth->fetchAll( PDO::FETCH_ASSOC );

    // テンプレートファイルを、入力された値で書き換える(書き換えるものがない)

    // ループのテンプレートを処理する

      // ループの始まりのタグがあるか探す
      if ( preg_match( '/###loop###/', $html ) ){
          // 見つかったら、対になるループの終わりのタグを探す
          if ( !preg_match( '/###\/loop###/', $html ) ){
              // 終わりが見つからなかったら、始まりのタグを空文字に置き換えて終了
              preg_replace( '/###loop###/', '', $html );
          } else {
              // タグに挟まれた部分を切り出す
              $part_array = preg_split( '/###loop###/', $html );
              $target_array = preg_split( '/###\/loop###/', $part_array[1] );
              $target_line = $target_array[0];

              $replaced_string = '';
            
              // データ件数分ループする
              foreach( $posts as $post ){
                  // 切り出したhtmlを読みだしたデータで置き換える
                  $work_string = $target_line;
                  $work_string = preg_replace( '/%%%id%%%/', $post["user_id"], $work_string );
                  $work_string = preg_replace( '/%%%post%%%/', $post["post"], $work_string );
                  $work_string = preg_replace( '/%%%name%%%/', $post["name"], $work_string );
                  $work_string = preg_replace( '/%%%created_at%%%/', $post["created_at"], $work_string );
                  // 置き換えた行データを足していく
                  $replaced_string = $replaced_string . $work_string;
              }
              // 足し終えた行データをもとの位置に戻す
              $html = $part_array[0] . $replaced_string . $target_array[1];
          }
      }


    // 変換されてできたhtmlファイルを表示する
    echo $html;
