<?php
session_start();
session_regenerate_id(true);

define('TITLE', '管理メニュートップ');

if (isset($_SESSION['login']) === false) {
  header('Location: /richeese-Admin/login/staff_login.php');
  exit();
} else {
  $staff_name = $_SESSION['staff_name'];
}

require_once ($_SERVER['DOCUMENT_ROOT'] . '/richeese-Admin/assets/_inc/head.php');
require_once ($_SERVER['DOCUMENT_ROOT'] . '/richeese-Admin/assets/_inc/header.php');
?>
  <main>
    <h1>管理メニュー</h1>
    <p><?= $staff_name; ?>さんログイン中</p>
  <ul>
    <li><a href="/richeese-Admin/staff/staff_list.php">スタッフ管理</a></li>
    <li><a href="/richeese-Admin/product/pro_list.php">商品管理</a></li>
    <li><a href="/richeese-Admin/order/order_download.php">注文ダウンロード</a></li>
    <li><a href="/richeese-Admin/login/staff_logout.php">ログアウト</a></li>
  </ul>
  </main>
</body>
</html>