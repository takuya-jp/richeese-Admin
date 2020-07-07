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
  <title>RICHEESE -商品登録完了-</title>
</head>
<body>
<?php
try {
    require_once __DIR__ . '/../../functions/common.php';

  $post = sanitize($_POST);

  $pro_name = $post['name'];
  $pro_price = $post['price'];
  $pro_gazou = $_POST['gazou_name'];

  $pro_name = htmlspecialchars($pro_name, ENT_QUOTES, 'UTF-8');
  $pro_pass = htmlspecialchars($pro_price, ENT_QUOTES, 'UTF-8');

  require_once __DIR__ . '/../../functions/dbcon.php';


  $sql = 'INSERT INTO mst_product(name, price, gazou) VALUES (?, ?, ?)';
  $stmt = $dbh->prepare($sql);

  $data[] = $pro_name;
  $data[] = $pro_price;
  $data[] = $pro_gazou;

  $stmt->execute($data);

  $dbh = null;

  print $pro_name;
  print 'を追加しました。<br>';
} catch(PDOException $e) {
  print 'ただいま障害により大変ご迷惑をお掛けしております。';
  exit();
}
?>
<a href="pro_list.php">戻る</a>
</body>
</html>