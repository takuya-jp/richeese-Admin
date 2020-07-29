<?php
session_start();
session_regenerate_id(true);

define('TITLE', 'スタッフ新規登録-完了画面-');

if (isset($_SESSION['login']) === false) {
  header('Location: /richeese-Admin/login/staff_login.php');
  exit();
} else {
  $login_staff_name = $_SESSION['staff_name'];
}

try {
  $csrf = $_POST['csrf'];
  if ($csrf !== $_SESSION['csrfToken']) {
    header('Location: /staff/staff_list.php');
    exit();
  }

    require_once ($_SERVER['DOCUMENT_ROOT'] . '/richeese-Admin/functions/common.php');
require_once ($_SERVER['DOCUMENT_ROOT'] . '/richeese-Admin/assets/_inc/header.php');

  $post = sanitize($_POST);

  $staff_name = $post['name'];
  $staff_pass = $post['pass'];

  require_once ($_SERVER['DOCUMENT_ROOT'] . '/richeese-Admin/functions/dbcon.php');

  $sql = 'INSERT INTO mst_staff(name, password) VALUES (?, ?)';
  $stmt = $dbh->prepare($sql);

  $data[] = $staff_name;
  $data[] = $staff_pass;

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
      <h1 class="level1-heading level1-heading--margin-top_none">スタッフ新規登録</h1>
      <p class="login-name login-name__border_bottom"><?= $login_staff_name; ?>さん ログイン中</p>
      <p class="result-icon result-icon--primary"><i class="fas fa-check"></i></p>
      <p class="result-message"><?= $staff_name; ?>さんを登録しました。</p>
      <div class="result-btn"><a class="btn btn--small btn--orange btn--link_orange" href="/richeese-Admin/staff/staff_list.php">スタッフ一覧へ</a></div>
    </section>
  </div>
</main>
</body>
</html>
