<?php include 'connection.php';
include 'header.html';?>
<?php
$uid = $_SESSION['uid'];
if (key_exists("type",$_GET)) {
  $andsql = " and type = ".$_GET['type'];
}
elseif (key_exists("search",$_GET)) {
  $andsql = " and recipe.name like '".$_GET['search']."%'";
  $sqlusers = "Select * from users where username Like '".$_GET['search']."%'";
  $resusers = mysqli_query($con,$sqlusers);
  if (!$resusers) {
    echo mysqli_error($con);

  }
  else {
    if (mysqli_affected_rows($con)==0) {
      echo "<br><br><br>
        <h1>Users</h1><br>There is no any user with your search criteria";
    }
    else {

    ?>
    <br><br><br>
    <h1>Users</h1>
    <div class="row">
    <?php
    while ($row = mysqli_fetch_assoc($resusers)) {
    $userid = $row['id'];
    $photo = $row['prophoto'];
    $name = $row['name'];
    $sur  = $row['surname'];
    $realpho = substr($photo,27);
    $username = $row['username'];
    if ($photo=="https://www.umyu.edu.ng/components/com_jsn/assets/img/default.jpg") {
      $realpho = "https://www.umyu.edu.ng/components/com_jsn/assets/img/default.jpg";
    }
    ?>
    <div class="column">
      <div class="content">
        <center><img src="<?=$realpho?>" alt="No photo" width="100%"></center>
        <center> <b>Full Name : </b> <?=$name?> <?=$sur?> </center>
        <center><p> <b>Username :</b> <a href="Profile.php?uid=<?=$userid?>"><?=$username?></a></p></center>
     </div>
      </div>

    <?php
    }
    ?></div>  <?php
  }
}
}
else {
  $andsql = "";
}
$sql = "select recipe.uid,recipe.id,photo,users.username,recipe.name,timeofpreparation,typename,isPrivate from users,recipe,type where users.id=recipe.uid and type.id=recipe.type and isPrivate='No'".$andsql;
$res = mysqli_query($con,$sql);
if (!$res) {
  echo mysqli_error($con);
}
else {
  if (mysqli_affected_rows($con)==0) {

    echo "<br><br><br>
      <h1>Recipes</h1><br>There is no any recipe with your search criteria or there is no recipe in database";
  }
  else{
  ?>
  <br><br><br><br>
  <h1>Recipes</h1>
  <div class="row">
  <?php
  while ($row = mysqli_fetch_assoc($res)) {
    $_SESSION['recid'] = $row['id'];
    $name = $row['name'];
    $time = $row['timeofpreparation'];
    $type = $row['typename'];
    $photofood = $row['photo'];
    $real  = substr($photofood,27);
    $isPrivate = $row['isPrivate'];
    $user = $row['username'];
    $userid = $row['uid'];
    $sqlfav = "select * from favorite where uid= ".$uid." and recipe_id=".$_SESSION['recid'];
    $resfav = mysqli_query($con,$sqlfav);
    if (!$resfav) {
      echo mysqli_error($con);
    }
    else {
      if (mysqli_affected_rows($con)==0) {
        $heart="fa fa-heart-o";
        $link = "Favorite.php?rid=".$_SESSION['recid'];
      }
      else {
        $heart = "fa fa-heart";
        $link = "UnFavorite.php?rid".$_SESSION['recid'];
      }

    ?>
    <div class="column">


    <div class="content">
      <img src="<?=$real?>" alt="" width="100%">
      <h3> <?=$name?></h3>
      <p> <i class="fa fa-clock-o"></i> <b>Time : </b> <?=$time?>' </center>  </p>
      <p> <i class="fa fa-tag"></i>  <b>Type : </b> <?=$type?> </center> </p>
      <p> <i class="fa fa-user-circle-o"></i> <b>Author : </b> <a href="Profile.php?uid=<?=$userid?>"><?=$user?></a></center></p>
      <p>  <form class="" action="Recipe.php" method="get">
        <button type="submit" name="recipe" value="<?=$_SESSION['recid']?>">Go To Recipe <i class="fa fa-arrow-circle-right"></i> </button>
      </form></p>
      <p> <b>Add To Favorites : </b> <a href="<?=$link?>"> <i class="<?=$heart?>" style="color:red;"></i></a> </p>
    </div>
  </div>

    <?php
  }
}
}
 ?>
</div><?php } ?></div>
<?php include 'footer.html'; ?>
