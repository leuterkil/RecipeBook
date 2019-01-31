<?php
include 'connection.php';
include 'header.html';
$uid = $_SESSION['uid'];
$recid = $_GET['rid'];
$sql="delete from favorite where uid=".$uid." and recipe_id=".$recid;
$result = mysqli_query($con,$sql);

if (!$result) {
  echo mysqli_error($con);
}
else {
  Header("Location:Recipe.php?recipe=".$recid);
}

include 'footer.html';
 ?>
