<?php

require_once ($_SERVER['DOCUMENT_ROOT'] . '/richeese-Admin/diary.php');

  $dbh = new PDO($dsn, $user, $password);
  $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

?>