<?php
session_start();
include_once 'dbconnect.php';
if(!isset($_SESSION['user'])) {
	header("Location: index.php");
}

// ユーザーIDからユーザー名を取り出す
$query = "SELECT * FROM users WHERE user_id=".$_SESSION['user']."";
$result = $mysqli->query($query);

$result = $mysqli->query($query);
if (!$result) {
	print('クエリーが失敗しました。' . $mysqli->error);
	$mysqli->close();
	exit();
}

// ユーザー情報の取り出し
while ($row = $result->fetch_assoc()) {
	$username = $row['username'];
	$email = $row['email'];
}

// データベースの切断
$result->close();

?>
<!DOCTYPE HTML>
<html lang="ja">
<head>
<meta charset="utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>マイページ　図書管理システム</title>
<link rel="stylesheet" href="style.css">
<!-- Bootstrap読み込み（スタイリングのため） -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css">
</head>
</head>
<body>
<div class="col-xs-6 col-xs-offset-3">

<h1>プロフィール</h1>
<ul>
	<li>名前：<?php echo $username; ?></li>
	<li>メールアドレス：<?php echo $email; ?></li>
</ul>
<p><a href="logout.php?logout">ログアウト</a></p>
<p><a href="book_new.php">書籍登録画面へ</a></p>
<p><a href="book_index.php">書籍一覧画面</a></p>
</div>
</body>
</html>
