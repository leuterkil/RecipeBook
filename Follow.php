<?php
include 'connection.php';
$uidofuse = $_GET['uid'];
$uid = $_GET['following'];
$sql = "insert into follows (uid,following) values(".$uidofuse.",".$uid.")";
$result = mysqli_query($con,$sql);
if (!$result) {
  echo mysqli_error($con);
}
else {
  Header("location:Profile.php?uid=".$uid);
}
 ?>
