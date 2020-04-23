<?php
  session_start();
  if( isset($_SESSION['user']) == "") {
    // ログインしてない場合はリダイレクト
    header("Location: index.php");
  }
  // DBとの接続
  include_once 'dbconnect.php';
 
  $query = "";
  $query .= "INSERT INTO rental(book_id, user_id, returnFlg, schedule_return_date) ";
  $query .= " values(".$_GET['id'].",".$_SESSION['user'].", FALSE, '".date("Y-m-d")."'); ";
  // echo $query;
  //INSERT文の実行
  $result = $mysqli->query($query);

  //↓↓削除できたかどうかのメッセージ出力
  if($mysqli->query($query)) {  ?>
    <div class="alert alert-success" role="alert">
      貸出登録しました。
    </div>
  <?php } else { ?>
    <div class="alert alert-danger" role="alert">エラーが発生しました。</div>
    <?php
  }
  header('Location: book_index.php');
?>