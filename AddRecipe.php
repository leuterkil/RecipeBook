<?php
include 'connection.php';
include 'header.html';
$name = $_POST['Name'];
$type = $_POST['Type'];
$pic = $_POST['Pic'];
$desc = $_POST['Desc'];
$time = $_POST['Time'];
$uid = $_SESSION['uid'];
 $size = count($_POST);
 $count = $size - 6;
 $addrec = "insert into recipe(name,type,timeofpreparation,description,dateadded,photo,uid)values('".$name."',".$type.",'".$time."','".$desc."',NOW(),'".$pic."',".$uid.")";
 $result = mysqli_query($con,$addrec);
 if (!$result) {
   echo mysqli_error($con);
 }
 else {
   $recid = mysqli_insert_id($con);
   for ($i=1; $i <=$count; $i++) {
     $ing = $_POST['Ingredient'.$i];
     $sql = "insert into ingredients(name,recipe)values('".$ing."',".$recid.")";
     $res = mysqli_query($con,$sql);
     if (!$res) {
       echo mysqli_error($con);
     }
     else {
       Header("location:MainMenu.php");
     }
   }
 }
 ?>
 <?php
 include 'footer.html'; ?>
