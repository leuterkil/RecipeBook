<?php

include 'connection.php';
include 'header.html';

$passPut = sha1($_POST['PuttedPass']);
$yours = $_SESSION['yourPass'];

if ($yours ==$passPut) {

  ?>
<form class="" action="PutNew.php" method="post">
  <input type="password" name="pass" value="">
  <input type="submit" name="" value="Final Change">
</form>
  <?php
}
else {
  echo "Your Password Is Wrong Please try again <a href=ChangePass.php?uid=".$_SESSION['uid'].">Return</a>";
}
 ?>
