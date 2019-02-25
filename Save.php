<?php include 'connection.php';

$uid = $_SESSION['uid'];
    $uploadDirectory = "C:/xampp/htdocs/RecipeBook/profimages/".$uid."/";
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

    if (isset($_POST['SaveCh'])) {

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
$uid = $_SESSION['uid'];
$name = $_POST['Name'];
$sur = $_POST['Surname'];
$gender = $_POST['Gender'];
$country = $_POST['Country'];
$date = $_POST['Date'];
$job = $_POST['Job'];
$bio = $_POST['Bio'];
$fav = $_POST['FavFoods'];
if ($uploadPath==$uploadDirectory) {
  $sql = "Update users set name='".$name."',surname ='".$sur."',description='".$bio."',gender='".$gender."',date_of_birth='".$date."',favorite_foods='".$fav."',job='".$job."',country='".$country."'where id=".$_SESSION['uid'];
}
else {
  $sql = "Update users set name='".$name."',surname ='".$sur."',description='".$bio."',gender='".$gender."',date_of_birth='".$date."',favorite_foods='".$fav."',job='".$job."',country='".$country."',prophoto='".$uploadPath."' where id=".$_SESSION['uid'];
}
$result = mysqli_query($con,$sql);
if (!$result) {
  echo mysqli_error($con);
}
else {
  Header("location:Profile.php?uid=".$uid);
}
 ?>
<?php
 ?>
