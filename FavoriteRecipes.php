<?php
include 'connection.php';
include 'header.html';
$uid=$_SESSION['uid'];
$sql = "select recipe.id,photo,username,recipe.name,typename,timeofpreparation,recipe.uid from users,recipe,favorite,type where recipe.uid=users.id and favorite.recipe_id=recipe.id and type.id=recipe.type and favorite.uid =".$uid;

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
    <div class="row">
    <?php
    while ($row = mysqli_fetch_assoc($result)) {

      $name = $row['name'];
      $username  = $row['username'];
      $recid = $row['id'];
      $time  = $row['timeofpreparation'];
      $type  = $row['typename'];
      $user = $row['uid'];
      $photo = $row['photo'];
      $real = substr($photo,27);
      ?>
      <div class="column">
      <div class="content">
        <img src="<?=$real?>" alt="" width="100%">
        <h3> <?=$name?></h3>
        <p> <i class="fa fa-clock-o"></i> <b>Time : </b> <?=$time?>' </center>  </p>
        <p> <i class="fa fa-tag"></i>  <b>Type : </b> <?=$type?> </center> </p>
        <p> <i class="fa fa-user-circle-o"></i> <b>Author : </b> <a href="Profile.php?uid=<?=$user?>"><?=$username?></a></center></p>
        <p>  <form class="" action="Recipe.php" method="get">
          <button type="submit" name="recipe" value="<?=$_SESSION['recid']?>">Go To Recipe <i class="fa fa-arrow-circle-right"></i> </button>
        </form></p>
        <p> <b>Remove From Favorites : </b> <a href="UnFavorite.php?rid=<?=$recid?>"><i class="fa fa-heart" style="color:red;"></i></a> </p>
      </div>
    </div>
      <?php
    }
    echo "</div>";
  }
}

include 'footer.html';
 ?>
