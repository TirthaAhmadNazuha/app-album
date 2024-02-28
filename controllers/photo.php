<?php
require '../utilites/db.php';
session_start();
function add()
{
  global $db;
  try {
    $uniqId = uniqid("", true);
    $filePath = "/photos/$uniqId" . $_FILES['photoFile']['name'];
    move_uploaded_file($_FILES['photoFile']['tmp_name'], "../uploads$filePath");
    $db->execute_query("INSERT INTO `photo` (`title`, `descrip`, `filePath`, `albumId`, `userId`) VALUES (?, ?, ?, ?, ?)", [$_POST['title'], $_POST['descrip'], $filePath, $_POST['albumId'], $_SESSION['user']['userId']]);
    header('Location: /app-album');
  } catch (Throwable $err) {
    header('Location: /app-album/photo/add.php');
  }

}

function remove()
{
  global $db;
  $db->execute_query("DELETE FROM `photo` WHERE `photoId` = ? and `userId` = ?", [$_GET['photoId'], $_SESSION['user']['userId']]);
  echo "<script>window.history.back()</script>";
}

function edit()
{
  global $db;
  try {
    if ($_FILES['photoFile']['name'] == '') {
      $db->execute_query(
        "UPDATE `photo` SET `albumId` = ?, `title` = ?, `descrip` = ? WHERE `photoId` = ? and `userId` = ?",
        [$_POST['albumId'], $_POST['title'], $_POST['descrip'], $_POST['photoId'], $_SESSION['user']['userId']]
      );
    } else {
      $uniqId = uniqid("", true);
      $filePath = "/photos/$uniqId" . $_FILES['photoFile']['name'];
      move_uploaded_file($_FILES['photoFile']['tmp_name'], "../uploads$filePath");
      $beforeFilePath = $db->
        execute_query("SELECT `filePath` FROM `photo` WHERE `photoId` = ? and `userId` = ?")->
        fetch_assoc()['filePath'];
      unlink("../uploads$beforeFilePath");
      $db->execute_query(
        "UPDATE `photo` SET `filePath` = ?, `albumId` = ?, `title` = ?, `descrip` = ? WHERE `photoId` = ? and `userId` = ?",
        [$filePath, $_POST['albumId'], $_POST['title'], $_POST['descrip'], $_POST['photoId'], $_SESSION['user']['userId']]
      );
    }
    header('Location: /app-album');
  } catch (Throwable $err) {
    header('Location: /app-album/photo/edit.php');
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
