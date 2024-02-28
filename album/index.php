<?php
if (!isset($_GET['albumId'])) {
  echo 'Error: No album ID provided.';
  die(400);
}
include '../component/header.php';
require '../utilites/db.php';
$album = $db->
  execute_query("SELECT `albumId`, `name`, `descrip`, `createAt` FROM `album` WHERE `albumId` = ?", [$_GET['albumId']])->
  fetch_assoc();
$photos = $db->
  execute_query("SELECT `photoId`, `title`, `descrip`, `filePath` FROM `photo` WHERE `albumId` = ?", [$_GET['albumId']])->
  fetch_all(1);
?>

<main>
  <div class="album-index-header">
    <h3>
      <?= $album['name'] ?>
    </h3>
    <b>
      <?= $album['createAt'] ?>
    </b>
    <p>
      <?= $album['descrip'] ?>
    </p>
    <a href="/app-album/photo/add.php?albumId=<?= $album['albumId'] ?>" class="btn btn-primary">Add photo</a>
  </div>
  <div class="cards-album-index">
    <?php foreach ($photos as $photo) { ?>
      <div>
        <img src="/app-album/uploads<?= $photo['filePath'] ?>" alt="">
        <h5><a href="/app-album/photo?photoId=<?= $photo['photoId'] ?>">
            <?= $photo['title'] ?>
          </a></h5>
      </div>
    <?php } ?>
  </div>
</main>

<?php include '../component/footer.php'; ?>

