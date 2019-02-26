<?php

include 'connection.php';

$uid = $_SESSION['uid'];
$newpass = sha1($_POST['pass']);

$sql = "update users set PASSWORD='".$newpass."' where id=".$uid;

$res = mysqli_query($con,$sql);

if ($res) {
  header("Location:MainMenu.php");
}

 ?>
