<?php
require './utilites/db.php';
include './component/header.php';
?>
<main>
  <h4>Hello
    <?= $_SESSION['user']['username'] ?>
  </h4>
  <h5>Album</h5>
  <div class="section flex">
    <ul class="list">
      <?php
      $albums = $db->
        execute_query("SELECT `albumId`, `name` FROM `album` WHERE `userId` = ?", [$_SESSION['user']['userId']])->
        fetch_all(1);
      foreach ($albums as $album) { ?>
        <li>
          <h5 class="flex-grow">
            <a href="/app-album/album?albumId=<?= $album['albumId'] ?>">
              <?= $album['name'] ?>
            </a>
          </h5>
          <div>
            <a href="/app-album/controllers/album.php?action=remove" class="btn btn-danger">Remove</a>
            <a href="/app-album/album/edit.php" class="btn btn-primary">Edit</a>
          </div>
        </li>
      <?php } ?>
    </ul>
  </div>
  <?php if (count($albums) == 0) { ?>
    <div class="center-block no-album">
      <h3>No albums yet.</h3>
      <p>First create an album</p>
      <a href="/app-album/album/add.php" class="btn btn-primary">Add album</a>
    </div>
  <?php } ?>
</main>
<?php include './component/footer.php'; ?>

