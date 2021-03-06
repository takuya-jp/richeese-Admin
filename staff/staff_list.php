<?php
header('X-FRAME-OPTIONS:DENY');

session_start();
session_regenerate_id(true);

define('TITLE', 'スタッフ管理メニュートップ');

if (isset($_SESSION['login']) === false) {
  header('Location: /richeese-Admin/login/staff_login.php');
  exit();
} else {
  $staff_name = $_SESSION['staff_name'];
}

try {
  require_once ($_SERVER['DOCUMENT_ROOT'] . '/richeese-Admin/functions/dbcon.php');

  if (isset($_REQUEST['page'])) {
    $page = $_REQUEST['page'];
  } else {
    $page = 1;
  }

  $page = max($page, 1);

  $counts = $dbh->query('SELECT COUNT(*) AS cnt FROM mst_staff');
  $cnt = $counts->fetch();
  $maxpage = ceil($cnt['cnt'] / 5);
  $page = min($page, $maxpage);

  $start = ($page - 1) * 5;

  $sql = 'SELECT code,name FROM mst_staff WHERE 1 ORDER BY code ASC LIMIT ?,5';
  $stmt = $dbh->prepare($sql);
  $stmt->bindParam(1, $start, PDO::PARAM_INT);
  $stmt->execute();


  $dbh = null;

} catch(PDOException $e) {
  print 'ただいま障害により大変ご迷惑をお掛けしております。';
  exit();
}

require_once ($_SERVER['DOCUMENT_ROOT'] . '/richeese-Admin/assets/_inc/head.php');
require_once ($_SERVER['DOCUMENT_ROOT'] . '/richeese-Admin/assets/_inc/header.php');
?>
<main class="main">
  <div class="section-container">
    <section class="staff-list">
      <form method="post" action="staff_branch.php">
        <h1 class="level1-heading">スタッフ一覧</h1>
        <div class="login-name login-name-box">
          <p><?= $staff_name; ?>さん ログイン中</p>
          <input class="btn btn--small btn--orange btn--link_orange" type="submit" name="add" value="新規登録">
        </div>
        <table class="staff-table">
          <thead class="staff-table__thead">
            <tr>
              <th class="staff-table__thead-item1"></th>
              <th class="staff-table__thead-item2">コード</th>
              <th class="staff-table__thead-item3">名前</th>
            </tr>
          </thead>
          <tbody class="staff-table__tbody">
            <?php
              while (true):
                $rec = $stmt->fetch(PDO::FETCH_ASSOC);
                if ($rec === false) {
                break;
              }
              ?>
            <tr>
              <td class="staff-table__tbody-item1"><input id="<?= $rec['code']; ?>" type="radio" name="staffcode" value="<?= $rec['code']; ?>"></td>
              <td class="staff-table__tbody-item2"><label class="hoge" for="<?= $rec['code']; ?>"><?= $rec['code']; ?></label></td>
              <td class="staff-table__tbody-item3"><label class="hoge" for="<?= $rec['code']; ?>"><?= $rec['name']; ?></label></td>
            </tr>
            <?php endwhile; ?>
          </tbody>
        </table>
        <div class="pagenation">
        <?php if($page > 1): ?>
          <a href="staff_list.php?page=<?= $page-1; ?>" class="pagenation__left"><i class="fas fa-angle-double-left"></i></a>
        <?php else: ?>
          <a href="staff_list.php?page=<?= $page-1; ?>" class="pagenation__left--disable"></a>
        <?php endif; ?>

        <?php if($page < $maxpage): ?>
          <a href="staff_list.php?page=<?= $page+1; ?>" class="pagenation__right"><i class="fas fa-angle-double-right"></i></a>
        <?php else: ?>
          <a href="staff_list.php?page=<?= $page-1; ?>" class="pagenation__right--disable"></a>
        <?php endif; ?>

        </div>
          <div class="select-buttons">
            <p class="select-buttons__text">選択されたスタッフを</p>
            <div class="select-buttons__buttons">
              <input class="btn btn--exsmall btn--transparent btn--link_transparent" type="submit" name="disp" value="参照">
              <input class="btn btn--exsmall btn--transparent btn--link_transparent" type="submit" name="edit" value="修正">
              <input class="btn btn--exsmall btn--red btn--link_red" type="submit" name="delete" value="削除">
            </div>
          </div>
      </form>
    </section>
  </div>
</main>


</body>
</html>