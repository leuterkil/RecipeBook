<?php
include 'connection.php';
include 'header.html';

$uid = $_GET['uid'];

$sql = "select recipe.id ,recipe.name,username,timeofpreparation,typename,photo from recipe,users,type where type.id=recipe.type and users.id=recipe.uid and uid=".$uid." and isPrivate='No'";
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
<div class="row">
<?php
while ($row = mysqli_fetch_assoc($result)) {
  $id = $row['id'];
  $name = $row['name'];
  $typename = $row['typename'];
  $time = $row['timeofpreparation'];
  $photo = $row['photo'];
  $real = substr($photo,27);

  ?>
  <div class="column">
    <div class="content">
      <img src="<?=$real?>" alt="Mountains" style="width:100%">
    <h3><?=$name?></h3>
    <p><i class="fa fa-clock-o"></i> <b>Time : </b><?=$time?>'</p>
    <p><i class="fa fa-tag"></i><b>Type : </b><?=$typename?></p>
   <form class="" action="Recipe.php" method="get">
    <button type="submit" name="recipe" value="<?=$id?>"><center>Go To Recipe</center></button></form>
  </div>
</div>
  <?php

}
echo "</div>";
}
}
include 'footer.html';
 ?>
