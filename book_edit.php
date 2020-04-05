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
  $query .= "SELECT books.id, books.title, books.publication_year, authors.author_name ";
  $query .= " FROM books, authors WHERE books.id = ".$_GET['id'] . " AND authors.id = books.author_id";
  //SELECT文の実行
  $result = $mysqli->query($query);
  $book_id = "";
  foreach ($result as $row) {
    $book_id = $row['id'];
  }

?>
  
  <?php
  //更新ボタンが押されたときのみ処理
  if(isset($_POST['book_update'])){
    //更新ボタンが押された後の処理
    // echo $_POST["title"];
    $title = $mysqli->real_escape_string($_POST['title']);
    $publication_year = $mysqli->real_escape_string($_POST['publication_year']);
    $author_name = $mysqli->real_escape_string($_POST['author_name']);
    // POSTされた情報をDBに格納する
    $query = "";
    $query = "UPDATE books SET title = '" . $title . "', publication_year = '" . $publication_year . "', author_id. = '" . $author_name . "' WHERE book_id = ".$_GET['id'];
    $query = "UPDATE authors SET author_name = '" . $author . "' WHERE books.id = ".$_GET['id'] . " AND author.id = books.author_id";
    // 実行できた文
    // ⇒UPDATE books SET title = "伝え方が9割" , publication_year = "2000-08-07" WHERE id = "16";
    // ⇒UPDATE author SET name = "佐々木圭一" WHERE id = "16";

    // var_dump($query);
    //↓↓更新できたかどうかのメッセージ出力だから気にしなくていい
    if($mysqli->query($query)) {  ?>
      <div class="alert alert-success" role="alert">
        更新しました。
    </div>
    <p><button type="button" class="btn btn-default"
      onclick="<?php echo "location.href='book_index.php". "'" ?>">一覧へ戻る</button></p>
      <?php } else { ?>
      <div class="alert alert-danger" role="alert">エラーが発生しました。</div>
      <?php
    }
  }
  
?>


<!DOCTYPE HTML>
<html lang="ja">
<head>                                          
<meta charset="utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>詳細(編集ページ)</title>
<link rel="stylesheet" href="style.css">
​
<!-- Bootstrap読み込み（スタイリングのため） -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css">
</head>
<body>
  <h1>詳細</h1>
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
      <form method="post">
        <tr>
          <th><?php echo($row['id']); ?></th>
          <th>
            <div class="form-group">
              <input type="text"  class="form-control" name="title" required value=<?php echo($row['title']);?> />
            </div>
          </th>
          <th>
            <div class="form-group">
              <input type="date"  class="form-control" name="publication_year" required value=<?php echo($row['publication_year']);?> />
            </div>
          </th>
          <th>
            <div class="form-group">
              <input type="text"  class="form-control" name="author" required value=<?php echo($row['author_name']);?> />
            </div>
          </th>     
        </tr>
        <button type="submit"   class="btn btn-default" name="book_update">更新</button>
        <p><button type="button" class="btn btn-default" 
          onclick="<?php echo "location.href='book_show.php?id=" . $row['id'] . "'" ?>">詳細へ戻る</button></p>
      </form>
      <?php
    }
    ?>
  </table>
</body>
</html>

<!-- UPDATE books SET title="伝える力２",publication_year="2020-01-22" ,author="池上彰" WHERE id = 2 -->