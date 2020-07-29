<?php
header('X-FRAME-OPTIONS:DENY');

session_start();
session_regenerate_id(true);

define('TITLE', '注文情報ダウンロード-日付選択-');

if (isset($_SESSION['login']) === false) {
  header('Location: /richeese-Admin/login/staff_login.php');
  exit();
} else {
  $login_staff_name = $_SESSION['staff_name'];
}

  require_once ($_SERVER['DOCUMENT_ROOT'] . '/richeese-Admin/functions/common.php');

require_once ($_SERVER['DOCUMENT_ROOT'] . '/richeese-Admin/assets/_inc/head.php');
require_once ($_SERVER['DOCUMENT_ROOT'] . '/richeese-Admin/assets/_inc/header.php');

?>
<main class="main">
  <div class="section-container">
    <section class="order-download">
      <h1 class="level1-heading">注文情報ダウンロード</h1>
      <p class="login-name"><?= $login_staff_name; ?>さん ログイン中</p>
      <p class="result-message">ダウンロードしたい注文日を選んで下さい。
      <form class="select-date" method="post" action="order_download_done.php">
      <div class="select-year">
        <?php pulldown_year(); ?>年
      </div>
      <div class="select-month"><?php pulldown_month(); ?>月</div>
      <div class="select-day"><?php pulldown_day(); ?>日</div>
      
      <div class="l-to-download"><input class="btn btn--medium btn--orange btn--link_orange" type="submit" value="ダウンロード画面へ"></div>
      </form>
    </section>
  </div>
</main>
</body>
</html>
