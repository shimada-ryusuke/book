<!-- 貸出一覧 ４月２３日実装中 -->
<?php
  session_start();
  if( isset($_SESSION['user']) == "") {
    // ログインしてない場合はリダイレクト
    header("Location: index.php");
  }
  // DBとの接続
  include_once 'dbconnect.php';

  $query = "";
  $query .= "SELECT books.id AS book_id, books.title, books.publication_year, authors.author_name ,rental.returnFlg";
  $query .= " FROM books, authors, rental WHERE books.author_id = authors.id AND rental.returnFlg = 1; ";
  echo $query;
  //↑　SQL文の内部結合
  //SELECT文の実行
  $result = $mysqli->query($query);
?>

<!DOCTYPE HTML>
<html lang="ja">
<head>                                          
<meta charset="utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>貸出中一覧</title>
<link rel="stylesheet" href="style.css">
​
<!-- Bootstrap読み込み（スタイリングのため） -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css">
</head>
<body>
  <h1>貸出中一覧表示画面</h1>
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
      <th><?php echo($row['book_id']); ?></th>
        <th><a href= <?php echo "book_return.php?id=" . $row['book_id'] ?>><?php echo($row['title']); ?></a></th>
        <th><?php echo($row['publication_year']); ?></th>
        <th><?php echo($row['author_name']); ?></th>
      </tr>
      <?php
    }
    ?>
  </table>
  <p><button type="button" class="btn btn-default"
      onclick="<?php echo "location.href='home.php". "'" ?>">マイページへ戻る</button></p>
</body>
</html>