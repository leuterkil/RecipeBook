<?php
include 'connection.php';
include 'header.html';


$userid = $_SESSION['uid'];
$recid = $_POST['recipe'];
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

if (isset($_POST['recipe'])) {

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
$deleteing = "delete from ingredients where recipe=".$recid;
$resdel = mysqli_query($con,$deleteing);
echo $_SESSION['counter'];
$Name = $_POST['Name'];
$type = $_POST['Type'];
$desc = $_POST['desc'];
$time = $_POST['Time'];
$private = $_POST['Private'];
$stathera = count($_POST)-$_SESSION['counter'];
$count=$stathera-6;
if ($uploadPath==$uploadDirectory) {
  $sqlupdateRecipe = "Update recipe Set name='".$Name."',type=".$type.",description='".$desc."',timeofpreparation='".$time."',isPrivate='".$private."' where id=".$recid."";
}
else {
  $sqlupdateRecipe = "Update recipe Set name='".$Name."',type=".$type.",description='".$desc."',timeofpreparation='".$time."',isPrivate='".$private."',photo='".$uploadPath."' where id=".$recid."";
}
for ($x=1; $x <=$_SESSION['counter'] ; $x++) {
  if (isset($_POST['ing'.$x])) {
    $ing = $_POST['ing'.$x];
    $sql = "insert into ingredients(name,recipe)values('".$ing."',".$recid.")";
    $res = mysqli_query($con,$sql);
  }
}
for ($i=1; $i <=$count; $i++) {
  if (isset($_POST['Ingredient'.$i])) {
    $ing = $_POST['Ingredient'.$i];
    $sql = "insert into ingredients(name,recipe)values('".$ing."',".$recid.")";
    $res = mysqli_query($con,$sql);
  }
}

$finalresult = mysqli_query($con,$sqlupdateRecipe);
if (!$finalresult) {
  echo mysqli_error($con);
}
else {
  Header("location:Recipe.php?recipe=".$recid);
}

include 'footer.html';
 ?>
