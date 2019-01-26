<?php include 'connection.php';
include 'header.html';
$sqltype = "select * from type";
$result = mysqli_query($con,$sqltype);

?>
<div class="sidenav">
  <h1>Types</h1>
  <?php
  while ($row = mysqli_fetch_assoc($result)) {
    $name = $row['typename'];
    $id =$row['id'];
   ?>
 <a href="ListOfYourRecipes.php?type=<?=$id?>"><?=$name?></a>
<?php }?>
</div>
  <div class="main">
<?php
if (key_exists("type",$_GET)) {
  $andsql = " and type = ".$_GET['type'];
}
elseif (key_exists("search",$_GET)) {
  $andsql = " and name = '".$_GET['search']."'";
}
else {
  $andsql = "";
}
$uid = $_SESSION['uid'];
$sql = "select * from recipe,type where type.id=recipe.type and uid =".$uid.$andsql;
$res = mysqli_query($con,$sql);
if (!$res) {
  echo mysqli_error($con);
}
else {
  if (mysqli_affected_rows($con)==0) {

    echo "<br><br><br>There is no any recipe with your search criteria or there is no recipe in database";
  }
  else{
  ?>
  <br><br><br>
  <table border="5" class="ListRec">

<tr>
  <th> <i>Name</i> </th>
  <th> <i>Time of Preparation</i> </th>
  <th> <i>Type</i> </th>
  <th> <i>Is Private to Other Users</i> </th>
  <th> <i>Go To Recipe</i> </th>
</tr>

  <?php
  while ($row = mysqli_fetch_assoc($res)) {
    $_SESSION['recid'] = $row['id'];
    $name = $row['name'];
    $time = $row['timeofpreparation'];
    $date = $row['dateadded'];
    $photo = $row['photo'];
    $type = $row['typename'];
    $isPrivate = $row['isPrivate'];
    ?>
    <tr>
      <td> <?=$name?></td>
      <td> <center> <?=$time?>' </center>  </td>
      <td> <center> <?=$type?> </center> </td>
      <td> <center><?=$isPrivate?></center></td>
      <td> <center> <form class="" action="Recipe.php" method="get">
        <button type="submit" name="recipe" value="<?=$_SESSION['recid']?>">Go To Recipe</button>
      </form> </center> </td>
    </tr>
    <?php
  }
}
 ?>
</table><?php } ?></div>
<?php include 'footer.html'; ?>
