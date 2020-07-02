<?php

$dsn = 'mysql:dbname=shop;host=localhost;charset=utf8';
  $user = 'shop_user';
  $password = 'password123';

  $dbh = new PDO($dsn, $user, $password);
  $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

?>