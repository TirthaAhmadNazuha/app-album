<?php
require '../utilites/db.php';
session_start();
function register()
{
  global $db;
  try {
    $db->execute_query("INSERT INTO `user`(`username`, `password`) VALUES (?, ?)", [$_POST['username'], $_POST['password']]);
    $user = $db->execute_query("SELECT `userId`, `name`, `username` FROM `user` WHERE `userId` = ?", [$db->insert_id])->fetch_assoc();
    $_SESSION['user'] = $user;
    header('Location: /app-album/user/changename.php');
  } catch (Throwable $err) {
    header('Location: /app-album/login.php');
  }
}

function login()
{
  global $db;
  try {
    $res = $db->execute_query("SELECT `userId`, `name`, `username` FROM `user` WHERE `username` = ? and `password` = ?", [$_POST['username'], $_POST['password']]);
    if ($res->num_rows > 0) {
      $user = $res->fetch_assoc();
      $_SESSION['user'] = $user;
      header('Location: /app-album');
    } else {
      header('Location: /app-album/login.php');
    }
  } catch (Throwable $err) {
    header('Location: /app-album/login.php');
  }
}

if (isset($_GET['action'])) {
  switch ($_GET['action']) {
    case 'register':
      register();
      break;

    case 'login':
      login();
      break;
  }
}
