<?php
session_start();

define('TITLE', 'ログアウト画面');

$_SESSION = array();
if (isset($_COOKIE[session_name()]) === true) {
  setcookie(session_name(), '', time()-42000, '/');
}
session_destroy();

require_once ($_SERVER['DOCUMENT_ROOT'] . '/richeese-Admin/assets/_inc/head.php');
?>
<h1>ログアウト</h1>
<p>ログアウトしました</p>
<a href="/richeese-Admin/login/staff_login.php">ログイン画面へ</a>
</body>
</html>