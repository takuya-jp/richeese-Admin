<?php
define('TITLE', 'ログイン画面');

require_once ($_SERVER['DOCUMENT_ROOT'] . '/richeese-Admin/assets/_inc/head.php');
?>
<main class="main">
  <div class="section-container">
    <section class="login">
      <h1><img src="/richeese-Admin/assets/img/logo@2x.png" alt="画像：リッチーズ画像"></h1>
      <form class="login-form" method="post" action="/richeese-Admin/login/staff_login_check.php">

        <div class="text-box">
          <label class="text-box__label" for="code">スタッフコード</label>
          <input id="code" class="text-box__input" type="text" name="code">
        </div>

        <div class="text-box">
          <label  class="text-box__label" for="pass">パスワード</label>
          <input id="pass" class="text-box__input" type="password" name="pass">
        </div>

        <div class="submit">
          <input class="btn btn--large btn--orange btn--link_orange" type="submit" value="ログイン">
        </div>
      </form>
    </section>
  </div>
</main>

</body>
</html>