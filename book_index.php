<?php
  //*****決まり文句のおまじない******
  //sessionのスタート（これがないとSessionを拾ってくれない）
  session_start();
  if( isset($_SESSION['user']) == "") {
    // ログインしてない場合はリダイレクト
    header("Location: index.php");
  }
  // DBとの接続
  include_once 'dbconnect.php';
  //*********************************
​
  //SQL文の作成
  $query = "";
  $query .= "SELECT title FROM books";
  //SELECT文の実行
  $result = $mysqli->query($query);
?>
<!DOCTYPE HTML>
<html lang="ja">
<head>                                          
<meta charset="utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>書籍一覧画面</title>
<link rel="stylesheet" href="style.css">
​
<!-- Bootstrap読み込み（スタイリングのため） -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css">
</head>
<body>
  <h1>書籍一覧表示画面</h1>
  <table class="table">
    <tr>  
      <!-- 表の項目名部分 -->
      <th>id</th>
      <th>書籍名</th>
      <th>出版年</th>
      <th>著者</th>
    </tr>
    <?php
    foreach ($hogehoge as $row) {
      ?>
      <tr>
        <th><?php echo($row['id']); ?></th>
        <th><a href="hogehoge.php"><?php echo($row['title']); ?></a></th>
        <th><?php echo($row['publication_year']); ?></th>
        <th><?php echo($row['author']); ?></th>
      </tr>
      <?php
    }
    ?>
  </table>
</body>
</html>