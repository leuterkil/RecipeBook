<?php
include 'connection.php';
$userid = $_SESSION['uid'];
$uploadDirectory = "C:/xampp/htdocs/RecipeBook/uploads/".$userid."/";
if (!file_exists($uploadDirectory)) {
mkdir($uploadDirectory,0777,true);
}
$errors = []; // Store all foreseen and unforseen errors here

$fileExtensions = ['jpeg','jpg','png']; // Get all the file extensions

$fileName = $_FILES['myfile']['name'];
$fileSize = $_FILES['myfile']['size'];
$fileTmpName  = $_FILES['myfile']['tmp_name'];
$fileType = $_FILES['myfile']['type'];
$fileExtension = strtolower(end(explode('.',$fileName)));

$uploadPath = $uploadDirectory . basename($fileName);

if (isset($_POST['save'])) {

    if (! in_array($fileExtension,$fileExtensions)) {
        $errors[] = "This file extension is not allowed. Please upload a JPEG or PNG file";
    }

    if ($fileSize > 2000000) {
        $errors[] = "This file is more than 2MB. Sorry, it has to be less than or equal to 2MB";
    }
    if (file_exists($fileName)) {
      $uploadPath=$uploadPath."(1)";
    }

    if (empty($errors)) {
        $didUpload = move_uploaded_file($fileTmpName, $uploadPath);

        if ($didUpload) {
            echo "The file " . basename($fileName) . " has been uploaded";
        } else {
            echo "An error occurred somewhere. Try again or contact the admin";
        }
    } else {
        foreach ($errors as $error) {
            echo $error . "These are the errors" . "\n";
        }
    }
}
$name = $_POST['Name'];
$type = $_POST['Type'];
$desc = $_POST['Desc'];
$time = $_POST['Time'];
$uid = $_SESSION['uid'];
$Private = $_POST['Private'];
 $size = count($_POST);
 $count = $size - 6;
 if ($uploadPath==$uploadDirectory) {
   $addrec = "insert into recipe(name,type,timeofpreparation,description,dateadded,uid,isPrivate)values('".$name."',".$type.",'".$time."','".$desc."',NOW(),".$uid.",'".$Private."')";
 }
 else {
  $addrec = "insert into recipe(name,type,timeofpreparation,description,dateadded,photo,uid,isPrivate)values('".$name."',".$type.",'".$time."','".$desc."',NOW(),'".$uploadPath."',".$uid.",'".$Private."')";
 }

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
 <?php ?>
