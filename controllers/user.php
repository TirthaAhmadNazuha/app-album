<?php
require '../utilites/db.php';
session_start();
function changename()
{
  global $db;
  try {
    $db->execute_query("UPDATE `user` SET `name` = ? WHERE `userId` = ?", [$_POST['name'], $_POST['userId']]);
    $_SESSION['user']['name'] = $_POST['name'];
    header('Location: /app-album');
  } catch (Throwable $err) {
    header('Location: /app-album/user/changename.php');
  }
}

if (isset($_GET['action'])) {
  switch ($_GET['action']) {
    case 'changename':
      changename();
      break;
  }
}
