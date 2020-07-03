<?php

define('TITLE', 'ログインエラー');

try {
  require_once __DIR__ . '/../functions/common.php';

  $post = sanitize($_POST);

  $staff_code = $post['code'];
  $staff_pass = $post['pass'];

  $staff_pass = md5($staff_pass);

  require_once __DIR__ . '/../functions/dbcon.php';

  $sql = 'SELECT name FROM mst_staff WHERE code = ? AND password = ?';
  $stmt = $dbh->prepare($sql);

  $data[] = $staff_code;
  $data[] = $staff_pass;

  $stmt->execute($data);

  $dbh = null;

  $rec = $stmt->fetch(PDO::FETCH_ASSOC);

  if ($rec === false) {
    $error =  'スタッフコードかパスワードが間違っています';
  } else {
    session_start();
    $_SESSION['login'] = 1;
    $_SESSION['staff_code'] = $staff_code;
    $_SESSION['staff_name'] = $rec['name'];
    header('Location: /richeese-Admin/index.php');
    exit();
  }

} catch(PDOException $e) {
  print 'ただいま障害により大変ご迷惑をお掛けしております。';
  exit();
}


require_once ($_SERVER['DOCUMENT_ROOT'] . '/richeese-Admin/assets/_inc/head.php');
?>
<h1 class="level1-heading">ログインエラー</h1>
<p><?= $error; ?></p>
  <a class="btn btn--medium btn--orange btn--link_orange" href="/richeese-Admin/login/staff_login.php">ログイン画面へ</a>
</body>
</html>
