<?php
include 'connection.php';
include 'header.html';
$id = $_GET['rid'];
$sql = "delete from recipe where id=".$id;
$sqlinc = "delete from ingredients where recipe=".$id;
$resinc = mysqli_query($con,$sqlinc);
$result = mysqli_query($con,$sql);
if (!$result) {
  echo mysqli_error($con);
}
else {
  if (!$resinc) {
    echo mysqli_error($con);
  }
  else {


  Header("location:ListOfYourRecipes.php");
}}
include 'footer.html';
 ?>
