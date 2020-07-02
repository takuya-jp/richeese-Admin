<?php

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

define('TITLE', 'ログインエラー');

require_once ($_SERVER['DOCUMENT_ROOT'] . '/richeese-Admin/assets/_inc/head.php');
?>
<h1>ログインエラー</h1>
<p><?= $error; ?></p>
  <a href="/richeese-Admin/login/staff_login.php">ログイン画面へ</a>
</body>
</html>
