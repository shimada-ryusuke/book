<?php
  session_start();
  if( isset($_SESSION['user']) == "") {
    // ログイン済みの場合はリダイレクト
    header("Location: home.php");
  }
  // DBとの接続
  include_once 'dbconnect.php';
?>
​
<!DOCTYPE HTML>
<html lang="ja">
<head>
<meta charset="utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>図書管理システム</title>
<link rel="stylesheet" href="style.css">
​
<!-- Bootstrap読み込み（スタイリングのため） -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css">
</head>
<body>
<div class="col-xs-6 col-xs-offset-3">

    
<?php
  $query = "";
  $query .= "SELECT id,author_name FROM authors";
  //SELECT文の実行
  $result = $mysqli->query($query);
 
  //登録ボタンが押されたときのみ処理
  if(isset($_POST['book_register'])){
    //登録ボタンが押された後の処理
    $title = $mysqli->real_escape_string($_POST['title']);
    $publication_year = $mysqli->real_escape_string($_POST['publication_year']);
    $author_id = $mysqli->real_escape_string($_POST['author_id']);
    // POSTされた情報をDBに格納する
    $query = "";
    $query .= "INSERT INTO `books` (`id`, `title`, `publication_year`, `author_id`) VALUES (NULL, '$title', '$publication_year', '$author_id');";
     echo $query;

    //↓↓登録できたかどうかのメッセージ出力
    if($mysqli->multi_query($query)) {  ?>
      <div class="alert alert-success" role="alert">
        登録しました.
    </div>
        <p><a href="book_index.php">書籍一覧画面へ</a></p>
        <p><a href="home.php">マイページ</a></p>
      <?php } else { ?>
      <div class="alert alert-danger" role="alert">エラーが発生しました。</div>
      <?php
    }
  }
  
?>
​
  <form method="post">
    <h1>書籍登録画面</h1>
    <div class="form-group">
      <input type="text"  class="form-control" name="title" placeholder="タイトル" required />
    </div> 
    <div class="form-group">
      <input type="date"  class="form-control" name="publication_year" placeholder="出版年" required />
    </div> 
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
    <button type="submit" class="btn btn-default" name="book_register">登録</button>
  </form>
  <p><input type="button" value="マイページ" onClick="location.href='home.php'"></p>
  <p><input type="button" value="書籍一覧表示へ" onClick="location.href='book_index.php'"></p>
</div>
</body>
</html>