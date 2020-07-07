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
  <title>RICHEESE -商品情報参照-</title>
</head>
<body>
<?php
try {
  require_once __DIR__ . '/../../functions/common.php';

  $get = sanitize($_GET);
  $pro_code = $get['procode'];

  require_once __DIR__ . '/../../functions/dbcon.php';


  $sql = 'SELECT name, price, gazou FROM mst_product WHERE code = ?';
  $stmt = $dbh->prepare($sql);
  $data[] = $pro_code;
  $stmt->execute($data);

  $rec = $stmt->fetch(PDO::FETCH_ASSOC);
  $pro_name = $rec['name'];
  $pro_price = $rec['price'];
  $pro_gazou_name = $rec['gazou'];

  if ($pro_gazou_name === '') {
    $dis_gazou = '';
  } else {
    $dis_gazou = '<img src="../assets/img/'.$pro_gazou_name.'">';
  }

  $dbh = null;
} catch(PDOException $e) {
  print 'ただいま障害により大変ご迷惑をお掛けしております。';
  exit();
}
?>
商品情報参照<br>
<br>
商品コード<br>
<?php print $pro_code; ?>
<br>
商品名<br>
<?php print $pro_name; ?>
<br>
価格<br>
<?php print $pro_price; ?>円
<br>
<?php print $dis_gazou; ?>
<br>
<form>
  <input type="button" onclick="history.back()" value="戻る">
</form>
</body>
</html>