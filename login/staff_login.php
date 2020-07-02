<?php
define('TITLE', 'ログイン画面');
require_once ($_SERVER['DOCUMENT_ROOT'] . '/richeese-Admin/assets/_inc/head.php');
?>
  <h1>ロゴ</h1>
  <br>
  <form method="post" action="staff_login_check.php">
    スタッフコード<br>
    <input type="text" name="code"><br>
    パスワード<br>
    <input type="password" name="pass"><br>
    <br>
    <input type="submit" value="ログイン">
  </form>
</body>
</html>