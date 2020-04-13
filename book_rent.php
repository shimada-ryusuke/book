<?php
  //*****決まり文句のおまじない******
  //sessionのスタート（これがないとSessionを拾ってくれない）
  session_start();
  if( isset($_SESSION['user']) == "") {
    // ログインしてない場合はリダイレクト
    header("Location: index.php");
  }

  function fnc_rent($book_id){
    // DBとの接続
    include_once 'dbconnect.php';
    //SQL文の作成  
    $query = "";
    $query .= "INSERT INTO rental(book_id, user_id, returnFlg, schedule_return_date) ";
    $query .= " values(".$book_id.",".$_SESSION['user'].", FALSE, '".date("Y-m-d")."'); ";
    //INSERT文の実行
    $result = $mysqli->query($query);
    return $result;
  }
?>