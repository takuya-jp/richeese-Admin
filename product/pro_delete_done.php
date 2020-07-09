<?php
session_start();
session_regenerate_id(true);

define('TITLE', '商品情報削除-完了画面-');

if (isset($_SESSION['login']) === false) {
  header('Location: /login/staff_login.php');
  exit();
} else {
  $login_staff_name = $_SESSION['staff_name'];
}

try {
  $pro_code = $_POST['code'];
  $pro_gazou_name = $_POST['gazou_name'];
  $csrf = $_POST['csrf'];
  if ($csrf !== $_SESSION['csrfToken']) {
    header('Location: /product/pro_list.php');
    exit();
  }

  require_once __DIR__ . '/../functions/dbcon.php';


  $sql = 'DELETE FROM mst_product WHERE code = ?';
  $stmt = $dbh->prepare($sql);

  $data[] = $pro_code;

  $stmt->execute($data);

  $dbh = null;

  if ($pro_gazou_name !== '') {
    unlink ('../assets/img/'.$pro_gazou_name);
  }

  $dbh = null;

  unset($_SESSION['csrfToken']);

} catch(PDOException $e) {
  print 'ただいま障害により大変ご迷惑をお掛けしております。';
  exit();
}

require_once ($_SERVER['DOCUMENT_ROOT'] . '/assets/_inc/head.php');
require_once ($_SERVER['DOCUMENT_ROOT'] . '/assets/_inc/header.php');

?>

<main class="main">
  <div class="section-container">
    <section class="staff-select-error">
      <h1 class="level1-heading level1-heading--margin-top_none">商品情報削除</h1>
      <p class="login-name login-name__border_bottom"><?= $login_staff_name; ?>さん ログイン中</p>
      <p class="result-icon result-icon--primary"><i class="fas fa-check"></i></p>
      <p class="result-message">商品の情報を削除しました。</p>
      <div class="result-btn"><a class="btn btn--small btn--orange btn--link_orange" href="/product/pro_list.php">商品一覧へ</a></div>
    </section>
  </div>
</main>
</body>
</html>