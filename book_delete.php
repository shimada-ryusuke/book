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
  //削除ボタンが押されたときのみ処理
  if(isset($_POST['book_delete'])){
    //削除ボタンが押された後の処理
    // POSTされた情報をDBに格納する
    $query = "";
    $query = "DELETE FROM books WHERE id = ".$_GET['id'];    
    // var_dump($query);
    //↓↓削除できたかどうかのメッセージ出力だから気にしなくていい
    if($mysqli->query($query)) {  ?>
      <div class="alert alert-success" role="alert">
        削除しました。
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
<title>詳細(削除)</title>
<link rel="stylesheet" href="style.css">
​
<!-- Bootstrap読み込み（スタイリングのため） -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css">
</head>
<body>
  <h1>選択中の書籍データを削除します。</h1>
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
        <button type="submit"   class="btn btn-default" name="book_delete">YES</button>
        <!-- <p><button type="button" class="btn btn-default" name="book_delete" -->
      <!-- onclick="<?php echo "location.href='book_delete complete.php". "'" ?>">選択中の書籍情報を削除します</button></p> -->
        <p><button type="button" class="btn btn-default" 
          onclick="<?php echo "location.href='book_show.php?id=" . $row['id'] . "'" ?>">NO(詳細へ戻る)</button></p>
      </form>
      <?php
    }
    ?>
  </table>
</body>
</html>

<!-- UPDATE books SET title="伝える力２",publication_year="2020-01-22" ,author="池上彰" WHERE id = 2 -->