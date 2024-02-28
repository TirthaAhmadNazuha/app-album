<?php
  if (!isset($_GET['photoId'])) {
    echo 'Must parameter photoId';
    die(400);
  }
  include '../component/header.php';
  require '../utilites/db.php';
  session_start();
  $photo = $db->
    execute_query("SELECT `filePath`, `albumId`, `title`, `descrip` FROM `photo` WHERE `photoId` = ?", [$_GET['photoId']])->
    fetch_assoc();
  $albums = $db->
    execute_query("SELECT `albumId`, `name` FROM `album` WHERE `userId` = ?", [$_SESSION['user']['userId']])->
    fetch_all(1);
?>
<main>
  <h1>Add Photo</h1>
  <p><?= json_encode($photo) ?></p>
  <form action="/app-album/controllers/photo.php?action=edit" method="post" enctype="multipart/form-data">
    <input type="hidden" name="photoId" value="<?= $_GET['photoId'] ?>">
    <div>
      <img src="/app-album/uploads<?= $photo['filePath'] ?>" alt="">
      <input type="file" name="photoFile" id="photoFile">
    </div>
    <input type="text" name="title" placeholder="Title" value="<?= $photo['title'] ?>">
    <select name="albumId">
      <?php
      foreach ($albums as $album) {
        if ($album['albumId'] == $photo['albumId']) {
          echo '<option selected value="' . $album['albumId'] . '"> ' . $album['name'] . '</option>';
        } else {
          echo '<option value="' . $album['albumId'] . '"> ' . $album['name'] . '</option>';
        }
      }
      ?>
    </select>
    <textarea name="descrip" placeholder="Description"><?= $photo['descrip'] ?></textarea>
    <button type="submit">Add</button>
  </form>
</main>
<script>
  document.addEventListener('DOMContentLoaded', () => {
    const input = document.getElementById('photoFile')
    input.addEventListener('change', () => {
      input.previousElementSibling.src = URL.createObjectURL(input.files[0])
    })
  })
</script>
<?php include '../component/footer.php'; ?>
