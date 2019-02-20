<?php
include 'connection.php';
include 'header.html';
$uid=$_SESSION['uid'];
$sql = "select recipe.id,username,recipe.name,typename,timeofpreparation,recipe.uid from users,recipe,favorite,type where recipe.uid=users.id and favorite.recipe_id=recipe.id and type.id=recipe.type and favorite.uid =".$uid;

$result = mysqli_query($con,$sql);
if (!$result) {
  echo mysqli_error($con);
}
else {
  if (mysqli_affected_rows($con)==0) {
    ?>
<br><br><br>
<h1>Favorite Recipes </h1>
There are no recipes yet.
    <?php
  }
  else {
    ?>
    <br><br><br>
    <h1>Favorite Recipes</h1>
    <table border="5" class="ListRec">
      <tr>
        <th><center>Name</center></th>
        <th><center>Time Of Preparation</center></th>
        <th><center>Type</center></th>
          <th><center>Author</center></th>
          <th><center>Go to Recipe</center></th>

      </tr>
    <?php
    while ($row = mysqli_fetch_assoc($result)) {

      $name = $row['name'];
      $username  = $row['username'];
      $recid = $row['id'];
      $time  = $row['timeofpreparation'];
      $type  = $row['typename'];
      $user = $row['uid'];
      ?>
      <tr>
        <td> <center><?=$name?></center> </td>
        <td><center><?=$time?></center></td>
        <td><center><?=$type?></center></td>
        <td><center> <a href="Profile.php?uid=<?=$user?>"> <?=$username?> </a> </center></td>
        <td><center> <form class="" action="Recipe.php" method="get">
          <button type="submit" name="recipe" value="<?=$recid?>" > Go To Recipe </button>
        </form> </center></td>
        <td><center> <a href="UnFavorite.php?rid=<?=$recid?>"><i class="fa fa-heart" style="color:red;"></i></a></center></td>
      </tr>
      <?php
    }
    echo "</table>";
  }
}

include 'footer.html';
 ?>
