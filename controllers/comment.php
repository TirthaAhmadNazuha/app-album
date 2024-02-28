<?php
require '../utilites/db.php';
session_start();
function add()
{
  global $db;
  $db->execute_query("INSERT INTO `comment` (`photoId`, `userId`, `content`) VALUES (?, ?, ?)", [$_POST['photoId'], $_SESSION['user']['userId'], $_POST['content']]);
  echo "<script>window.history.back()</script>";
}

function remove()
{
  global $db;
  $db->execute_query("DELETE FROM `comment` WHERE `commentId` = ? and `userId` = ?", [$_GET['commentId'], $_SESSION['user']['userId']]);
  echo "<script>window.history.back()</script>";
}

function edit()
{
  global $db;
  try {
    $db->execute_query("UPDATE `album` SET `name` = ?, `descrip` = ? WHERE `albumId` = ? and `userId` = ?", [$_POST['name'], $_POST['descrip'], $_POST['albumId'], $_SESSION['user']['userId']]);
    header('Location: /app-album');
  } catch (Throwable $err) {
    header('Location: /app-album/album/add.php');
  }
}

if (isset($_GET['action'])) {
  switch ($_GET['action']) {
    case 'add':
      add();
      break;
    case 'remove':
      remove();
      break;
    case 'edit':
      edit();
      break;
  }
}
