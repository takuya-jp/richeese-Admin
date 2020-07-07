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
  <title>RICHEESE -商品削除完了-</title>
</head>
<body>
<?php
try {
  $pro_code = $_POST['code'];
  $pro_gazou_name = $_POST['gazou_name'];

  require_once __DIR__ . '/../../functions/dbcon.php';


  $sql = 'DELETE FROM mst_product WHERE code = ?';
  $stmt = $dbh->prepare($sql);

  $data[] = $pro_code;

  $stmt->execute($data);

  $dbh = null;

  if ($pro_gazou_name !== '') {
    unlink ('../assets/img/'.$pro_gazou_name);
  }


} catch(PDOException $e) {
  print 'ただいま障害により大変ご迷惑をお掛けしております。';
  exit();
}
?>
削除しました。<br>
<br>
<a href="pro_list.php">戻る</a>
</body>
</html>