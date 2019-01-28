<?php include 'connection.php';
include 'header.html';
include 'sidenav.php';?>
  <div class="main">
<?php
$uid = $_SESSION['uid'];
if (key_exists("type",$_GET)) {
  $andsql = " and type = ".$_GET['type'];
}
elseif (key_exists("search",$_GET)) {
  $andsql = " and recipe.name like '".$_GET['search']."%'";
}
else {
  $andsql = "";
}
$sql = "select * from users,recipe,type where users.id=recipe.uid and type.id=recipe.type and isPrivate='No'".$andsql;
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
  <table border="10" class="ListRec">

<tr >
  <th> <center> <i>Name</i></center> </th>
  <th> <center><i>Time of Preparation</i></center> </th>
  <th> <center><i>Type</i></center> </th>
  <th> <center><i>Author</i></center> </th>
  <th> <center><i>Go To Recipe</i></center> </th>
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
    $user = $row['username'];
    $userid = $row['uid'];
    ?>
    <tr>
      <td> <?=$name?></td>
      <td> <center> <?=$time?>' </center>  </td>
      <td> <center> <?=$type?> </center> </td>
      <td> <center><a href="Profile.php?uid=<?=$userid?>"><?=$user?></a></center></td>
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
