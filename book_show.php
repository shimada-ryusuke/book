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
  //*********************************​
  //SQL文の作成  
  $query = "";
  $query .= "SELECT * FROM books WHERE id = ".$_GET['id'];
  //SELECT文の実行
  $result = $mysqli->query($query);
  $book_id = "";
  foreach ($result as $row) {
    $book_id = $row['id'];
  }
?>

<!DOCTYPE HTML>
<html lang="ja">
<head>                                          
<meta charset="utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>詳細</title>
<link rel="stylesheet" href="style.css">
​
<!-- Bootstrap読み込み（スタイリングのため） -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css">
</head>
<body>
  <h1><?php echo "詳細"; ?></h1>
  <table class="table">
    <tr>  
      <!-- 表の項目名部分 -->
      <th>id</th>
      <th>書籍名</th>
      <th>出版年</th>
      <th>著者</th>
    </tr>
    <?php
    foreach ($result as $row) {
      ?>
      <tr>
        <th><?php echo($row['id']); ?></th>
        <th><?php echo($row['title']); ?></a></th>
        <th><?php echo($row['publication_year']); ?></th>
        <th><?php echo($row['author']); ?></th>
      </tr>
      <p><button type="button" class="btn btn-default" 
      onclick="<?php echo "location.href='book_edit.php?id=" . $row['id'] . "'" ?>">編集</button></p>
      <?php
    }
    ?>
  </table>

</body>
</html>