<?php
session_start();
if (!isset($_SESSION['user']['userId'])) {
  header("Location: /app-album/login.php");
}
if ($_SESSION['user']['name'] == '' && $_SERVER['PHP_SELF'] != '/app-album/user/changename.php') {
  header("Location: /app-album/user/changename.php");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="cache-control" content="no-cache, no-store, must-revalidate">
  <title>App Album</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital@0;1&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="/app-album/assets/styles.css">
</head>

<body>
  <header>
    <nav id="nav-bar">
      <h1>Albums App</h1>
      <div class="links">
        <a href="/app-album">Home</a>
        <a href="/app-album/album/add.php">Add Album</a>
        <a href="/app-album/photo/add.php">Add Photo</a>
        <a href="/app-album/logout.php">Log out</a>
      </div>
    </nav>
  </header>
