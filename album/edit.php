<?php
if (!isset($_GET['albumId'])) {
  echo 'Must parameter albumId';
  die(400);
}
include '../component/header.php';
require '../utilites/db.php';
$album = $db->execute_query("SELECT `name`, `descrip` FROM `album` WHERE `albumId` = ?", [$_GET['albumId']])->fetch_assoc();
?>

<main>
  <h1>Add Album</h1>
  <form class="text-form" action="/app-album/controllers/album.php?action=edit" method="post">
    <input type="hidden" name="albumId" value="<?= $_GET['albumId'] ?>">
    <input type="text" name="name" value="<?= $album['name'] ?>" placeholder="Title">
    <textarea name="descrip" placeholder="Description"><?= $album['descrip'] ?></textarea>
    <button class="btn btn-primary" type="submit">Edit</button>
  </form>
</main>
<?php include '../component/footer.php' ?>

