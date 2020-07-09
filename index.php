<?php
session_start();
session_regenerate_id(true);

define('TITLE', '管理メニュートップ');

if (isset($_SESSION['login']) === false) {
  header('Location: /login/staff_login.php');
  exit();
} else {
  $staff_name = $_SESSION['staff_name'];
}

require_once ($_SERVER['DOCUMENT_ROOT'] . '/richeese-Admin/assets/_inc/head.php');
require_once ($_SERVER['DOCUMENT_ROOT'] . '/richeese-Admin/assets/_inc/header.php');
?>
<main class="main">
  <div class="section-container">
    <section class="menu">
      <h1 class="level1-heading">管理メニュー</h1>
      <p class="login-name"><?= $staff_name; ?>さん ログイン中</p>
      <ul class="cards cards--col2">
        <li class="cards__item">
          <a class="card__link" href="/richeese-Admin/staff/staff_list.php">
            <article class="card">
              <figure class="card__imag-wrapper">
                <img class="card__img" src="/richeese-Admin/assets/img/man-1959859_640.jpg" alt="画像の説明">
              </figure>
              <div class="card__body">
                <h3 class="card__title">スタッフ管理</h3>
                <p class="card__text">「スタッフの新規追加」「スタッフ情報の変更」「スタッフ一覧」など店舗スタッフの管理をします。</p>
              </div>
            </article>
          </a>
        </li>
        <li class="cards__item">
          <a class="card__link" href="/richeese-Admin/product/pro_list.php">
            <article class="card">
              <figure class="card__imag-wrapper">
                <img class="card__img" src="/richeese-Admin/assets/img/cheese-tray-1433504_640.jpg" alt="画像の説明">
              </figure>
              <div class="card__body">
                <h3 class="card__title">商品管理</h3>
                <p class="card__text">「商品登録」「商品情報の編集」「商品情報の参照」など商品の管理をします。</p>
              </div>
            </article>
          </a>
        </li>
        <li class="cards__item">
          <a class="card__link" href="/richeese-Admin/order/order_download.php">
            <article class="card">
              <figure class="card__imag-wrapper">
                <img class="card__img" src="/richeese-Admin/assets/img/upload-2935442_640.png" alt="画像の説明">
              </figure>
              <div class="card__body">
                <h3 class="card__title">注文情報ダウンロード</h3>
                <p class="card__text">ゲストの注文情報をダウンロードします。</p>
              </div>
            </article>
          </a>
        </li>
        <li class="cards__item">
          <a class="card__link" href="/richeese-Admin/login/staff_logout.php">
            <article class="card">
              <figure class="card__imag-wrapper">
                <img class="card__img" src="/richeese-Admin/assets/img/morning-819362_640.jpg" alt="画像の説明">
              </figure>
              <div class="card__body">
                <h3 class="card__title">ログアウト</h3>
                <p class="card__text">管理画面からログアウトします。</p>
              </div>
            </article>
          </a>
        </li>
      </ul>
    </section>
  </div>
</main>
</body>
</html>