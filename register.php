<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login | App Album</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital@0;1&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="/app-album/assets/styles.css">
  <style>
    a {
      color: #2664d8;
      text-decoration: underline;
    }
  </style>
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
  <main>
    <h3>Welocme to App Album, register here</h3>
    <form action="/app-album/controllers/auth.php?action=register" method="post">
      <input type="text" name="username" placeholder="username">
      <input type="password" name="password" placeholder="password">
      <button type="submit">Register</button>
    </form>
    <p>Dont have an account?, <a href="/app-album/login.php">Login here</a></p>
  </main>
  <?php include './component/footer.php'; ?>

