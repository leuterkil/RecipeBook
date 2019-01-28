<?php
include 'connection.php';
include 'header.html';
$uidofuse = $_GET['uid'];
$uid = $_GET['following'];
$sql = "delete from follows where uid=".$uidofuse." and following=".$uid;
$result = mysqli_query($con,$sql);
if (!$result) {
  echo mysqli_error($con);
}
else {
  Header("location:Profile.php?uid=".$uid);
}
include 'footer.html';
 ?>
