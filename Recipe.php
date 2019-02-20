<?php
include 'connection.php';
include 'header.html';
$id = $_GET['recipe'];
$sql = "select * from recipe,type where recipe.id=".$id;
$sqlinc = "select name from ingredients where recipe=".$id;
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
  $name = $row['name'];
  $type = $row['typename'];
  $timeofpreparation = $row['timeofpreparation'];
  $desc = $row['description'];
  $photo = $row['photo'];
  $realpho = substr($photo,27);
  if (!isset($photo)) {
    $realpho = "http://icons.iconarchive.com/icons/mcdo-design/closed-notes/256/Notebook-Recipe-icon.png";
  }
?>
<br><br><br>
<form style="background-color:grey;">
<center> <img src="<?=$realpho?>" alt="No Photo" width="256" height="256"><br>

<h1><?=$name?> <a href="<?=$link?>"> <i class="<?=$heart?>" style="color:red;"></i> </a>  </h1>
<span style="color:#ddd;"><?=$type?></span><br>
Number Of Favorites : <a href="ListOfFav.php?rid=<?=$id?>"><span style="color:#333;"><?=$numberoffav?></span></a> 
</center>
<h3>Ingredients:</h3>
<table border="1">
  <tr>
    <td>
<?php
$counter = 1;
while ($row=mysqli_fetch_assoc($resinc)) {
  $name = $row['name'];
  echo "<span style=color:white;>".$counter.". ".$name."</span><br>";
  $counter++;
}
?>
</td>
</tr>
</table>
<br><br>
 <h3>Description:</h3>
<table border="1">
  <tr>
    <td> <span style="color:white;"> <?=$desc?></span> </td>
  </tr>
</table>
<center>
  Time Of Preparation : <br>
  <span style="font-size:48px;color:white;"><?=$timeofpreparation?>'</span>
</center>
</form>
<?php
}}
include 'footer.html';
 ?>
