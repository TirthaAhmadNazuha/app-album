<?php
$db = new mysqli('localhost', 'root', '', 'db_album');

function esc($val)
{
  global $db;
  return mysqli_escape_string($db, $val);
}
?>

