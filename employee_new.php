<?php
  $pdo = null;
  function PDO_con(){
    try {
      $pdo = new PDO ( 'mysql:dbname=test; host=localhost;port=3306; charset=utf8', 'tsukino', 'tsukino' );
      print '接続に成功しました。';
    } catch ( PDOException $e ) {
      print "接続エラー:{$e->getMessage()}";
    }  
  }

  if(isset($_POST["regist"]))
?>
<html lang="ja">
    <head>
        <meta charset="UTF-8">
        <title>新規従業員登録</title>
    </head>
    <body>
    <form action="#" method="post">
        <p>氏名：<br>
        <input type="text" name="name"></p>
        <p>年齢：<br>
        <input type="text" name="name"></p>
        <p>部署：<br>
        <input type="text" name="name"></p>
        <p><input type="button" value="新規登録" id="button2"></p>
    </form>
    </body>
</html>