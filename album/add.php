<?php include '../component/header.php'; ?>
<main>
  <h3>Add Album</h3>
  <form class="text-form" action="/app-album/controllers/album.php?action=add" method="post">
    <input type="text" name="name" placeholder="Name">
    <textarea name="descrip" placeholder="Description"></textarea>
    <button class="btn btn-primary" type="submit">Add</button>
  </form>
</main>
<?php include '../component/footer.php'; ?>

