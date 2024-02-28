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
    </nav>
  </header>
  <main>
    <h3>Welcome to Album App, Login here</h3>
    <form action="/app-album/controllers/auth.php?action=login" method="post">
      <input type="text" name="username">
      <input type="password" name="password">
      <button type="submit">Login</button>
    </form>
    <p>Have an account?, <a href="/app-album/register.php">Register here</a></p>
  </main>
</body>

</html>
