<?php
require '../utilites/db.php';
session_start();

function liking()
{
  global $db;
  $has = $db->
    execute_query("SELECT `photoId` FROM `likes` WHERE `photoId` = ? and `userId` = ?", [$_GET['photoId'], $_SESSION['user']['userId']])->
    num_rows;
  if ($has > 0) {
    $db->execute_query("DELETE FROM `likes` WHERE `photoId` = ? and `userId` = ?", [$_GET['photoId'], $_SESSION['user']['userId']]);
    echo 'like';
  } else {
    $db->execute_query("INSERT INTO `likes` (`photoId`, `userId`) VALUES (?, ?)", [$_GET['photoId'], $_SESSION['user']['userId']]);
    echo 'unlike';
  }
}

liking();
