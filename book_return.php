<!-- 返却機能 ４月２３日実装中 -->
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
  $query .= " values(".$_GET['id'].",".$_SESSION['user'].", TRUE, '".date("Y-m-d")."'); ";
  // echo $query;
  //INSERT文の実行
  $result = $mysqli->query($query);
  header('Location: book_index.php');
?>

<?php
    //↓↓削除できたかどうかのメッセージ出力
    if($mysqli->query($query)) {  ?>
      <div class="alert alert-success" role="alert">
        返却しました。
    </div>
      <?php } else { ?>
      <div class="alert alert-danger" role="alert">エラーが発生しました。</div>
      <?php
    }
  
?>