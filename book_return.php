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
  // $query .= "SELECT * FROM books WHERE id = ".$_GET['id'];
  $query .= "INSERT INTO rental(book_id, user_id, returnFlg, schedule_return_date) ";
  $query .= " values(".$_GET['id'].",".$_SESSION['user'].", TRUE, '".date("Y-m-d")."'); ";
  // echo $query;
  //INSERT文の実行
  $result = $mysqli->query($query);
  //redirect
  header('Location: book_index.php');
?>

<?php
    //↓↓削除できたかどうかのメッセージ出力だから気にしなくていい
    if($mysqli->query($query)) {  ?>
      <div class="alert alert-success" role="alert">
        返却しました。
    </div>
      <?php } else { ?>
      <div class="alert alert-danger" role="alert">エラーが発生しました。</div>
      <?php
    }
  
?>