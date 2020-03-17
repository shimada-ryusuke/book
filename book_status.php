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
  
  <?php
  //貸出情報を更新ボタンが押されたときのみ処理
  if(isset($_POST['book_status'])){
    //貸出情報を更新ボタンが押された後の処理
    // echo $_POST["book_status"];
    // var_dump($_POST);
    $book_status = $mysqli->real_escape_string($_POST['book_status']);
    $rental_day = $mysqli->real_escape_string($_POST['rental_day']);
    $rental_user = $mysqli->real_escape_string($_POST['rental_user']);
    // $publication_year = $mysqli->real_escape_string($_POST['publication_year']); ←参考
    // POSTされた情報をDBに格納する
    $query = "";
    $query = "UPDATE books SET book_status = '" . $book_status . "', rental_day = '" . $rental_day . "', rental_user = '" . $rental_user . "'  WHERE id = ".$_GET['id'];  
    // var_dump($query);
    // UPDATE `books` SET `book_status` = '貸出中' WHERE `books`.`id` = 14;　←SQL文
    // $query = "UPDATE books SET title = '" . $title . "', publication_year = '" . $publication_year . "', author = '" . $author . "' WHERE id = ".$_GET['id'];　←参考
    //↓↓貸出情報を更新できたかどうかのメッセージ出力だから気にしなくていい
    if($mysqli->query($query)) {  ?>
      <div class="alert alert-success" role="alert">
        貸出状況を更新しました。
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
<title>貸出管理</title>
<link rel="stylesheet" href="style.css">
​
<!-- Bootstrap読み込み（スタイリングのため） -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css">
</head>
<body>
  <h1>貸出管理ページ</h1>
  <table class="table">
    <tr>  
      <!-- 表の項目名部分 -->
      <th>貸出状況</th>
      <th>貸出日付</th>
      <th>最終貸与者</th>
    </tr>
    <?php
    foreach ($result as $row) {
      ?>
      <form method="post">
        <tr>
          <th>
            <div class="form-group">
              <input type="text"  class="form-control" name="book_status" required value=<?php echo($row['book_status']);?> />
            </div>
          </th>
          <th>
            <div class="form-group">
              <input type="date"  class="form-control" name="rental_day" required value=<?php echo($row['rental_day']);?> />
            </div>
          </th>
          <th>
            <div class="form-group">
              <input type="text"  class="form-control" name="rental_user" required value=<?php echo($row['rental_user']);?> />
            </div>
          </th>     
        </tr>
        <button type="submit"   class="btn btn-default" name="book_status">貸出情報を更新</button>
        <p><button type="button" class="btn btn-default" 
          onclick="<?php echo "location.href='book_show.php?id=" . $row['id'] . "'" ?>">詳細へ戻る</button></p>
      </form>
      <?php
    }
    ?>
  </table>
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
          <th><?php echo($row['title']); ?></a></th>
          <th><?php echo($row['publication_year']); ?></th>
          <th><?php echo($row['author']); ?></th>     
        </tr>
      </form>
      <?php
    }
    ?>
  </table>
</body>
</html>

<!-- UPDATE books SET title="伝える力２",publication_year="2020-01-22" ,author="池上彰" WHERE id = 2 -->