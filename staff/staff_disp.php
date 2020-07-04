<?php
header('X-FRAME-OPTIONS:DENY');

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
  <title>RICHEESE -スタッフ情報参照-</title>
</head>
<body>
<?php
try {
  require_once __DIR__ . '/../../functions/common.php';
  $get = sanitize($_GET);
  $staff_code = $get['staffcode'];
  
  require_once __DIR__ . '/../../functions/dbcon.php';

  $sql = 'SELECT name FROM mst_staff WHERE code = ?';
  $stmt = $dbh->prepare($sql);
  $data[] = $staff_code;
  $stmt->execute($data);

  $rec = $stmt->fetch(PDO::FETCH_ASSOC);
  $staff_name = $rec['name'];

  $dbh = null;
} catch(PDOException $e) {
  print 'ただいま障害により大変ご迷惑をお掛けしております。';
  exit();
}
?>
スタッフ情報参照<br>
<br>
スタッフコード<br>
<?php print $staff_code; ?>
<br>
スタッフ名<br>
<?php print $staff_name; ?>
<br>
<br>
<form>
  <input type="button" onclick="history.back()" value="戻る">
</form>
</body>
</html>