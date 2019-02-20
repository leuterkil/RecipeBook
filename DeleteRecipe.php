<?php
include 'connection.php';
include 'header.html';
$id = $_GET['rid'];
$sql = "delete from recipe where id=".$id;
$sqlinc = "delete from ingredients where recipe=".$id;
$sqlfav = "delete from favorite where recipe_id=".$id;
$resinc = mysqli_query($con,$sqlinc);
$resfav = mysqli_query($con,$sqlfav);
$result = mysqli_query($con,$sql);
if (!$result) {
  echo mysqli_error($con);
}
  if (!$resinc) {
    echo mysqli_error($con);
  }
if (!$resfav) {
  echo mysqli_error($con);
}
Header("location:ListOfYourRecipes.php");
include 'footer.html';
 ?>
