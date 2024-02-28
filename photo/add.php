<?php
  require '../utilites/db.php';
  include '../component/header.php';
  $res = $db->execute_query("SELECT `albumId`, `name` FROM `album` WHERE `userId` = ?", [$_SESSION['user']['userId']]);
  $albums = $res->fetch_all(1)
?>
<main>
  <h1>Add Photo</h1>
  <form action="/app-album/controllers/photo.php?action=add" method="post" enctype="multipart/form-data">
    <div>
      <img src="" alt="">
      <input type="file" name="photoFile" id="photoFile">
    </div>
    <input type="text" name="title">
    <select name="albumId">
      <option value="" selected disabled>Select album</option>
      <?php
      foreach ($albums as $album) {
        if (isset($_GET['albumId'])) {
          if ($album['albumId'] == $_GET['albumId']) {
            echo '<option selected value="' . $album['albumId'] .  '"> ' . $album['name'] . '</option>';
          } else {
            echo '<option value="' . $album['albumId'] .  '"> ' . $album['name'] . '</option>';
          }
        } else {
          echo '<option value="' . $album['albumId'] .  '"> ' . $album['name'] . '</option>';
        }
      }
      ?>
    </select>
    <textarea name="descrip"></textarea>
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
<?php include  '../component/footer.php'; ?>
