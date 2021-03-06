<?php
  session_start();
  if( isset($_SESSION['user']) == "") {
    // ログインしてない場合はリダイレクト
    header("Location: index.php");
  }
  // DBとの接続
  include_once 'dbconnect.php';

  $query = "";
  // 4/8追記：↓author_id更新の為、必要なデータを呼び出す。
  $query .= "SELECT books.id as book_id, books.title, books.publication_year, books.author_id, authors.id , authors.author_name ";
  $query .= " FROM books, authors WHERE books.id = ".$_GET['id'] . " AND authors.id = books.author_id";
  //SELECT文の実行
  // echo $query;
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
    $author_id = $mysqli->real_escape_string($_POST['author_id']);

    // POSTされた情報をDBに格納する
    $query = "";
// ↓変更※updateされるのがauthor_idにしたい
    $query = "UPDATE books SET title = '" . $title . "', publication_year = '" . $publication_year . "', author_id= '" . $author_id . "' WHERE books.id = ".$_GET['id'] ;
    echo $query;

    //↓↓更新できたかどうかのメッセージ出力
    if($mysqli->multi_query($query)) {  ?>
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
          <th><?php echo($row['book_id']); ?></th>
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
              <select name="author_id" class="form-control">
                <?php
                foreach ($result as $row) {
                  ?>
                  <option value=<?php echo($row['id']);?>><?php echo($row['author_name'])?></option>
                  <?php
                }
                ?>
              </select>
            </div>
          </th>    
        </tr>
        <button type="submit"   class="btn btn-default" name="book_update">更新</button>
        <p><button type="button" class="btn btn-default" 
          onclick="<?php echo "location.href='book_show.php?id=" . $row['book_id'] . "'" ?>">詳細へ戻る</button></p>
      </form>
      <?php
    }
    ?>
  </table>
</body>
</html>