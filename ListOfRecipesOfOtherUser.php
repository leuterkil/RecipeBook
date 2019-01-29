<?php
include 'connection.php';
include 'header.html';

$uid = $_GET['uid'];

$sql = "select recipe.id ,recipe.name,username,timeofpreparation,typename from recipe,users,type where type.id=recipe.type and users.id=recipe.uid and uid=".$uid." and isPrivate='No'";
$result = mysqli_query($con,$sql);
if (!$result) {
  echo mysqli_error($con);
}
else {
  if (mysqli_affected_rows($con)==0) {
    ?>
This user has no recipes yet
    <?php
  }
  else {
?>
<br><br><br>
<h1>List Of Public Recipes</h1>
<br>
<table border="5" class="ListRec">
  <tr>
    <th><center>Name</center></th>
    <th><center>Time Of Preparation</center></th>
    <th><center>Type</center></th>
    <th><center>Go To Recipe</center></th>
  </tr>
<?php
while ($row = mysqli_fetch_assoc($result)) {
  $id = $row['id'];
  $name = $row['name'];
  $typename = $row['typename'];
  $time = $row['timeofpreparation'];

  ?>
  <tr>
    <td><center><?=$name?></center></td>
    <td><center><?=$time?></center></td>
    <td><center><?=$typename?></center></td>
    <td> <form class="" action="Recipe.php" method="get">
    <button type="submit" name="recipe" value="<?=$id?>"><center>Go To Recipe</center></button></form> </td>
  </tr>
  <?php

}
echo "</table>";
}
}
include 'footer.html';
 ?>
