<?php
include 'connection.php';
include 'header.html';
$uid = $_SESSION['uid'];
$recid = $_GET['rid'];
$sql="insert into favorite(uid,recipe_id) values(".$uid.",".$recid.")";
$result = mysqli_query($con,$sql);

if (!$result) {
  echo mysqli_error($con);
}
else {
  Header("Location:Recipe.php?recipe=".$recid);
}

include 'footer.html';
 ?>
