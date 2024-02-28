<?php include '../component/header.php'; ?>
<main>
  <h3>Edit your name</h3>
  <form action="/app-album/controllers/user.php?action=changename" method="post">
    <input type="hidden" name="userId" value="<?= $_SESSION['user']['userId'] ?>">
    <input type="text" name="name">
    <button type="submit">Apply</button>
  </form>
</main>
<?php include '../component/footer.php'; ?>

