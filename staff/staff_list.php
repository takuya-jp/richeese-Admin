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
  require_once __DIR__ . '/../functions/dbcon.php';

  $sql = 'SELECT code,name FROM mst_staff WHERE 1';
  $stmt = $dbh->prepare($sql);

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
      <h1 class="level1-heading">スタッフ一覧</h1>
      <p class="login-name"><?= $staff_name; ?>さん ログイン中
        <input class="btn btn--small btn--orange btn--link_orange" type="submit" name="add" value="新規登録">
      </p>
      <form method="post" action="staff_branch.php">
        <table>
          <thead>
            <tr>
              <th></th>
              <th>コード</th>
              <th>名前</th>
            </tr>
          </thead>
          <tbody>
            <?php
              while (true):
                $rec = $stmt->fetch(PDO::FETCH_ASSOC);
                if ($rec === false) {
                break;
              }
              ?>
            <tr>
              <td><input id="<?= $rec['code']; ?>" type="radio" name="staffcode" value="<?= $rec['code']; ?>"></td>
              <td><label for="<?= $rec['code']; ?>"><?= $rec['code']; ?></label></td>
              <td><label for="<?= $rec['code']; ?>"><?= $rec['name']; ?></label></td>
            </tr>
            <?php endwhile; ?>
          </tbody>
        </table>
          <p>選択されたスタッフを</p>
          <input class="btn btn--exsmall btn--transparent btn--link_transparent" type="submit" name="disp" value="参照">
          <input class="btn btn--exsmall btn--transparent btn--link_transparent" type="submit" name="edit" value="修正">
          <input class="btn btn--exsmall btn--red btn--link_red" type="submit" name="delete" value="削除">
      </form>
    </section>
  </div>
</main>


</body>
</html>