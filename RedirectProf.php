<?php
include 'connection.php';
$uid = $_SESSION['uid'];

Header("location:Profile.php?uid=".$uid);
 ?>
