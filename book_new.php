<?php
  //*****決まり文句のおまじない******
  //sessionのスタート（これがないとSessionを拾ってくれない）
  session_start();
  if( isset($_SESSION['user']) == "") {
    // ログイン済みの場合はリダイレクト
    header("Location: home.php");
  }
  // DBとの接続
  include_once 'dbconnect.php';
  //*********************************
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
  //登録ボタンが押されたときのみ処理
  if(isset($_POST['book_register'])){
    //登録ボタンが押された後の処理
    // echo $_POST["title"];
    $title = $mysqli->real_escape_string($_POST['title']);
    $publication_year = $mysqli->real_escape_string($_POST['publication_year']);
    $author = $mysqli->real_escape_string($_POST['author']);
    // POSTされた情報をDBに格納する
    $query .= "INSERT INTO books(title, publication_year, author) ";
    $query .= "VALUES('$title','$publication_year','$author')";
    //↓↓登録できたかどうかのメッセージ出力だから気にしなくていい
    if($mysqli->query($query)) {  ?>
      <div class="alert alert-success" role="alert">登録しました</div>
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
      <input type="text"  class="form-control" name="author" placeholder="著者" required />
    </div> 
    <button type="submit" class="btn btn-default" name="book_register">登録</button>
  </form>
​
</div>
</body>
</html>