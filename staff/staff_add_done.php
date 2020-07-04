<?php
session_start();
session_regenerate_id(true);
if (isset($_SESSION['login']) === false) {
  print 'ログインされていません。<br>';
  print '<a href="../staff_login/staff_login.html">ログイン画面へ</a>';
  exit();
} else {
  print $_SESSION['staff_name'];
  print 'さんログイン中<br>';
  print '<br>';

}
?>

<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>RICHEESE -スタッフ登録完了-</title>
</head>
<body>
<?php
try {
    require_once __DIR__ . '/../../functions/common.php';

  $post = sanitize($_POST);

  $staff_name = $post['name'];
  $staff_pass = $post['pass'];

  require_once __DIR__ . '/../../functions/dbcon.php';

  $sql = 'INSERT INTO mst_staff(name, password) VALUES (?, ?)';
  $stmt = $dbh->prepare($sql);

  $data[] = $staff_name;
  $data[] = $staff_pass;

  $stmt->execute($data);

  $dbh = null;

  print $staff_name;
  print 'さんを追加しました。<br>';
} catch(PDOException $e) {
  print 'ただいま障害により大変ご迷惑をお掛けしております。';
  exit();
}
?>
<a href="staff_list.php">戻る</a>
</body>
</html>