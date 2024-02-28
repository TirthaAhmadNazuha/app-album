<?php
if (!isset($_GET['photoId'])) {
  echo 'Must parameter photoId';
  die(400);
}
include '../component/header.php';
require '../utilites/db.php';

$photo = $db->
  execute_query("SELECT `title`, `descrip`, `filePath`, `albumId`, `userId`, `createAt` FROM `photo` WHERE `photoId` = ?", [$_GET['photoId']])->
  fetch_assoc();

$comments = $db->
  execute_query("SELECT `commentId`, `username`, `content`, comment.userId FROM `comment` INNER JOIN `user` ON comment.userId = user.userId WHERE `photoId` = ?", [$_GET['photoId']])->
  fetch_all(1);

$album = $db->
  execute_query("SELECT `name` FROM `album` WHERE `albumId` = ?", [$photo['albumId']])->
  fetch_assoc();

$user = $db->
  execute_query("SELECT `username`, `name` FROM `user` WHERE `userId` = ?", [$photo['userId']])->
  fetch_assoc();

$has = $db->
  execute_query("SELECT `photoId` FROM `likes` WHERE `photoId` = ? and `userId` = ?", [$_GET['photoId'], $_SESSION['user']['userId']])->
  num_rows;

?>
<main>
  <div class="detail-photo-head">
    <img src="/app-album/uploads<?= $photo['filePath'] ?>" alt="">
    <div>
      <h1>
        <?= $photo['title'] ?>
      </h1>
      <div class="flex">
        <b>
          <?= $photo['createAt'] ?>
        </b>
        <button class="btn" id="like-btn">
          <?= $has > 0 ? 'unlike' : 'like' ?>
        </button>
      </div>
      <a href="/app-album/user?userId=<?= $photo['userId'] ?>">
        <span>
          <?= $user['username'] ?>
        </span>
        <h5>
          <?= $user['name'] ?>
        </h5>
      </a>
      <a href="/app-album/album?albumId=<?= $photo['albumId'] ?>">
        <span>
          Album
        </span>
        <h5>
          <?= $album['name'] ?>
        </h5>
      </a>
      <p>
        <?= $photo['descrip'] ?>
      </p>
    </div>
  </div>
  <div>
    <h3>Comments</h3>
    <form class="comment-form" action="/app-album/controllers/comment.php?action=add" method="post">
      <input type="hidden" name="photoId" value="<?= $_GET['photoId'] ?>">
      <div>
        <input type="text" name="content" placeholder="Type comment">
        <button class="btn btn-primary" type="submit">Send</button>
      </div>
    </form>
    <div class="comments">
      <?php foreach ($comments as $comment) { ?>
        <div class="comment">
          <div>
            <a href="/app-album/user?userId=<?= $comment['userId'] ?>">
              <b>
                <?= $comment['username'] ?>
              </b>
            </a>
            <?php if ($comment['userId'] == $_SESSION['user']['userId']) { ?>
              <a class="btn btn-danger"
                href="/app-album/controllers/comment.php?action=remove&commentId=<?= $comment['commentId'] ?>">Remove</a>
            <?php } ?>
          </div>
          <p>
            <?= $comment['content'] ?>
          </p>
        </div>
      <?php }
      if (count($comments) == 0) { ?>
        <div class="center-block">
          <h5>No comments yet.</h5>
        </div>
      <?php } ?>
    </div>
  </div>
</main>
<script>
  document.addEventListener('DOMContentLoaded', () => {
    const btnLike = document.getElementById('like-btn')
    btnLike.addEventListener('click', async () => {
      const res = await (await fetch('/app-album/controllers/like.php?photoId=<?= $_GET['photoId'] ?>')).text()
      btnLike.textContent = res
    })
  })
</script>
<?php include '../component/footer.php'; ?>

