<?php


include 'connection.php';
include 'header.html';


$uid = $_GET['uid'];
$sql = "select * from users where id=".$uid;

$result = mysqli_query($con,$sql);
if (!$result) {
  echo mysqli_error($con);
}

$row = mysqli_fetch_assoc($result);

$_SESSION['yourPass'] = $row['PASSWORD'];
?>

<form class="" action="PutPass.php" method="post">
  <input type="password" name="PuttedPass" id="PuttedPass" value="">
  <input type="submit" name="" value="Change">
</form>

<?php
include 'footer.html';
 ?>
