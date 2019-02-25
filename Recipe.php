<?php
include 'connection.php';
include 'header.html';
if (!isset($_GET['limit'])) {
  $limit=5;
}
else {
  if ($_GET['limit']<=0) {
    $limit=5;
    $_GET['limit'] = 5;
  }
  else {
    $limit = ($_GET['limit']);
  }
}
$id = $_GET['recipe'];
$uid = $_SESSION['uid'];
$sqlyourdetails="select * from users where id=".$uid;
$sql = "select * from recipe,type where recipe.id=".$id;
$sqlinc = "select name from ingredients where recipe=".$id;
$sqlcomment = "select prophoto,dateadd,comm,name,surname from comments,users where users.id=comments.userid and recipeid=".$id." order by dateadd desc limit ".$limit;
$result = mysqli_query($con,$sql);
$resinc = mysqli_query($con,$sqlinc);
$sqlfav = "select * from favorite where uid= ".$_SESSION['uid']." and recipe_id = ".$id;
$sqlnumoffav = "select count(recipe_id) from favorite where recipe_id=".$id;
$resnumfav = mysqli_query($con,$sqlnumoffav);
$row = mysqli_fetch_assoc($resnumfav);
$numberoffav = $row['count(recipe_id)'];
$resfav = mysqli_query($con,$sqlfav);
if (!$resfav) {
  echo mysqli_error($con);
}
else {
  if (mysqli_affected_rows($con)==1) {
    $heart = "fa fa-heart";
    $link = "UnFavorite.php?rid=".$id;
  }
  else {
    $heart = "fa fa-heart-o";
    $link = "Favorite.php?rid=".$id;
  }
}
if (!$result) {
  echo mysqli_error($con);
}
else {
  if (!$resinc) {
    echo mysqli_error($con);
  }
  else {
  $row=mysqli_fetch_assoc($result);
  $user = $row['uid'];
  $name = $row['name'];
  $type = $row['typename'];
  $timeofpreparation = $row['timeofpreparation'];
  $desc = $row['description'];
  $photo = $row['photo'];
  $realpho = substr($photo,27);
  if (!isset($photo)) {
    $realpho = "http://icons.iconarchive.com/icons/mcdo-design/closed-notes/256/Notebook-Recipe-icon.png";
  }
  if ($user==$uid) {
    $buttonedit = "<button type=submit name = recipe value =".$id." style=background-color:red;color:white;border-radius:20%;>Edit</button>";
    $buttondelete = "<button type=submit name = rid value =".$id." style=background-color:red;color:white;border-radius:20%;>Delete</button>";
  }
  else {
    $buttonedit="";
    $buttondelete="";
  }
?>
<br><br><br>
<form style="background-color:#c4ff4d;">
 <img src="<?=$realpho?>" alt="No Photo" width="256" height="256" style="float:left;margin: 18px 100px 20px 12px;"><br><br><br><br><br><br>
 <img src="https://ya-webdesign.com/images/scrollwork-clipart-underlines-5.png" alt="" height="600" width="1200" style="position:absolute;top:100px;right:100px;"><br><br><br>
<div class="RecipeHeader"><h1><?=$name?> <a href="<?=$link?>"> <i class="<?=$heart?>" style="color:red;"></i> </a>  </h1>
<span><b>Category: </b><?=$type?></span><br>
<b>Number Of Favorites : </b><a href="ListOfFav.php?rid=<?=$id?>"><span style="color:#333;"><?=$numberoffav?></span></a></div>
<br><br><br><br><br><br>
<table border="1" class="ingredientsView">
  <tr>
    <td>
      <h3><u>Ingredients</u></h3>
<?php
$counter = 1;
while ($row=mysqli_fetch_assoc($resinc)) {
  $name = $row['name'];
  echo $counter.". ".$name."<br>";
  $counter++;
}
?>
</td>
</tr>
</table>
<br><br>

<table border="1" class="descView">
  <tr>
    <td><center><h3>Prescription:</h3></center> <textarea name="name" rows="8" cols="130" readonly style="background-color:inherit;"><?=$desc?></textarea></td>
  </tr>
</table>
<center>
  Time Of Preparation : <br>
  <span class="timeofpreparation"><?=$timeofpreparation?>'</span>
</center>
</form>
<form  action="EditRecipe.php" method="get" style="float:right;">
<?=$buttonedit?>
</form>
<form class="" action="DeleteRecipe.php" method="get" style="float:right;">
<?=$buttondelete?>
</form>
<?php
}}
$resuser = mysqli_query($con,$sqlyourdetails);
$rowuser = mysqli_fetch_assoc($resuser);
$photo = $rowuser['prophoto'];
$name = $rowuser['name'];
$sur = $rowuser['surname'];
$realpho = substr($photo,27);
?>
<h3>Leave A Comment For Recipe</h3>
<form class="" action="AddComment.php" method="post">
  <br>
  <table border="1" class="AddComment">
    <tr>
      <td><img src="<?=$realpho?>" alt="No Photo" width="64" height="64"> <textarea name="comment" rows="4" cols="50" placeholder="Leave A Comment..." ></textarea><br>
        <b> <button type="submit" name="Recipe" value="<?=$id?>" >Post</button> </b>
       </td>
    </tr>
  </table>
</form>
<br><br>
<table class="AddComment" border="1">
<?php
$rescomm = mysqli_query($con,$sqlcomment);
while ($rowcomm=mysqli_fetch_assoc($rescomm)) {
  $comment = $rowcomm['comm'];
  $prophoto =$rowcomm['prophoto'];
  $nameother = $rowcomm['name'];
  $surother = $rowcomm['surname'];
  $realphoto = substr($prophoto,27);
  ?>
<tr>
  <td> <img src="<?=$realphoto?>" alt="No Photo" height="64" width="64">
    <b><?=$nameother?> <?=$surother?></b><br>
     <textarea name="name" rows="4" cols="50" readonly style="background-color:inherit;resize:none;float:right;margin:0px 0px 20px 70px;"  ><?=$comment?></textarea> </td>
</tr>
  <?php
}
?>
</table>
<form class="" action="Recipe.php" method="get">
  <button type="submit" name="recipe" value="<?=$id?>">More comments</button>
  <input type="hidden" name="limit" value="<?=$limit+5?>">
</form>
<form class="" action="Recipe.php" method="get">
  <button type="submit" name="recipe" value="<?=$id?>">Less comments</button>
  <input type="hidden" name="limit" value="<?=$limit-5?>">
</form>
<?php
include 'footer.html';
 ?>
