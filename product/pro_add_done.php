<?php
session_start();
session_regenerate_id(true);

define('TITLE', '商品新規登録-完了画面-');

if (isset($_SESSION['login']) === false) {
  header('Location: /richeese-Admin/login/staff_login.php');
  exit();
} else {
  $login_staff_name = $_SESSION['staff_name'];
}

try {
  $csrf = $_POST['csrf'];
  if ($csrf !== $_SESSION['csrfToken']) {
    header('Location: /richeese-Admin/staff/staff_list.php');
    exit();
  }

  require_once __DIR__ . '/../functions/common.php';

  $post = sanitize($_POST);

  $pro_name = $post['name'];
  $pro_price = $post['price'];
  $pro_gazou = $_POST['gazou_name'];

  require_once __DIR__ . '/../functions/dbcon.php';


  $sql = 'INSERT INTO mst_product(name, price, gazou) VALUES (?, ?, ?)';
  $stmt = $dbh->prepare($sql);

  $data[] = $pro_name;
  $data[] = $pro_price;
  $data[] = $pro_gazou;

  $stmt->execute($data);

  $dbh = null;

  unset($_SESSION['csrfToken']);

} catch(PDOException $e) {
  print 'ただいま障害により大変ご迷惑をお掛けしております。';
  exit();
}
require_once ($_SERVER['DOCUMENT_ROOT'] . '/richeese-Admin/assets/_inc/head.php');
require_once ($_SERVER['DOCUMENT_ROOT'] . '/richeese-Admin/assets/_inc/header.php');

?>
<main class="main">
  <div class="section-container">
    <section class="staff-select-error">
      <h1 class="level1-heading level1-heading--margin-top_none">商品新規登録</h1>
      <p class="login-name login-name__border_bottom"><?= $login_staff_name; ?>さん ログイン中</p>
      <p class="result-icon result-icon--primary"><i class="fas fa-check"></i></p>
      <p class="result-message">「<?= $pro_name; ?>」を登録しました。</p>
      <div class="result-btn"><a class="btn btn--small btn--orange btn--link_orange" href="/richeese-Admin/product/pro_list.php">商品一覧へ</a></div>
    </section>
  </div>
</main>
</body>
</html>
