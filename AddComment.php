<?php
include 'connection.php';


$userid = $_SESSION['uid'];
$recid = $_POST['Recipe'];
$comment = $_POST['comment'];

$sql = "insert into comments (userid,recipeid,comm,dateadd) values(".$userid.",".$recid.",'".$comment."',NOW())";

$result = mysqli_query($con,$sql);

if (!$result) {
  echo mysqli_error($con);
}
else {
  header("location:Recipe.php?recipe=".$recid);
}
include 'header.html';
include 'footer.html';
 ?>
