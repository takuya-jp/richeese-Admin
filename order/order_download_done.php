<?php
header('X-FRAME-OPTIONS:DENY');

session_start();
session_regenerate_id(true);

define('TITLE', '注文情報ダウンロード-注文一覧-');

if (isset($_SESSION['login']) === false) {
  header('Location: /richeese-Admin/login/staff_login.php');
  exit();
} else {
  $login_staff_name = $_SESSION['staff_name'];
}

require_once __DIR__ . '/../functions/common.php';

try {
  require_once __DIR__ . '/../functions/dbcon.php';

  
  $year = $_POST['year'];
  $month = $_POST['month'];
  $day = $_POST['day'];
  
  $sql = "
    SELECT
      dat_sales.code,
      dat_sales.date,
      dat_sales.code_member,
      dat_sales.name AS dat_sales_name,
      dat_sales.email,
      dat_sales.postal1,
      dat_sales.postal2,
      dat_sales.address,
      dat_sales.tel,
      dat_sales_product.code_product,
      mst_product.name AS mst_product_name,
      dat_sales_product.price,
      dat_sales_product.quantity
    FROM
      dat_sales, dat_sales_product, mst_product
    WHERE
      dat_sales.code=dat_sales_product.code_sales
      AND dat_sales_product.code_product=mst_product.code
      AND substr(dat_sales.date, 1, 4) = ?
      AND substr(dat_sales.date, 6, 2) = ?
      AND substr(dat_sales.date, 9, 2) = ?
  ";

  $stmt = $dbh->prepare($sql);
  $data[] = $year;
  $data[] = $month;
  $data[] = $day;
  $stmt->execute($data);

  $dbh = null;

  $csv = '注文コード,注文日時,会員番号,お名前,メール,郵便番号,住所,TEL,商品コード,商品名,価格,数量';
  $csv .= "\n";
  while (true) {
    $rec = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($rec === false) {
      break;
    }
    $csv .= $rec['code'];
    $csv .= ',';
    $csv .= $rec['date'];
    $csv .= ',';
    $csv .= $rec['code_member'];
    $csv .= ',';
    $csv .= $rec['dat_sales_name'];
    $csv .= ',';
    $csv .= $rec['email'];
    $csv .= ',';
    $csv .= $rec['postal1'] . '-' . $rec['postal2'];
    $csv .= ',';
    $csv .= $rec['address'];
    $csv .= ',';
    $csv .= $rec['tel'];
    $csv .= ',';
    $csv .= $rec['code_product'];
    $csv .= ',';
    $csv .= $rec['mst_product_name'];
    $csv .= ',';
    $csv .= $rec['price'];
    $csv .= ',';
    $csv .= $rec['quantity'];
    $csv .= "\n";
  }


  $file = fopen('./chumon'.'-'.$year.'-'.$month.'-'.$day.'.csv', 'w');
  fputs($file, $csv);
  fclose($file);

} catch(PDOException $e) {
  print 'ただいま障害により大変ご迷惑をお掛けしております。';
  exit();
}

require_once ($_SERVER['DOCUMENT_ROOT'] . '/richeese-Admin/assets/_inc/head.php');
require_once ($_SERVER['DOCUMENT_ROOT'] . '/richeese-Admin/assets/_inc/header.php');

?>
<main class="main">
  <div class="section-container">
    <section class="order-download-done">
      <h1 class="level1-heading">注文情報ダウンロード</h1>
      <p class="login-name"><?= $login_staff_name; ?>さん ログイン中</p>
      <div class="download-btns">
        <div class="download-btn"><a class="btn btn--large btn--green btn--link_green" href="chumon<?php print '-'.$year.'-'.$month.'-'.$day;?>.csv">注文データのダウンロード</a></div>
        <div class="bak-btns">
          <a class="btn btn--exsmall btn--transparent btn--link_transparent" href="order_download.php">戻る</a>
          <a class="btn  btn--medium btn--transparent btn--link_transparent" href="../staff_login/staff_top.php">管理メニュートップ</a>
        </div>
      </div>
    </section>
  </div>
</main>
</body>
</html>
