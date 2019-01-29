<?php include 'connection.php';
include 'header.html';
include 'sidenav.php';?>
  <div class="main">
<?php
$uid = $_SESSION['uid'];
$sql = "select recipe.id,typename,name,timeofpreparation,isPrivate from recipe,type where type.id=recipe.type and uid =".$uid;
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
  <th> <i>Name</i> </th>
  <th> <i>Time of Preparation</i> </th>
  <th> <i>Type</i> </th>
  <th> <i>Is Private to Other Users</i> </th>
  <th> <i>Go To Recipe</i> </th>
  <th> <i>Delete Recipe</i> </th>
</tr>

  <?php
  while ($row = mysqli_fetch_assoc($res)) {
    $id = $row['id'];
    $name = $row['name'];
    $time = $row['timeofpreparation'];
    $type = $row['typename'];
    $isPrivate = $row['isPrivate'];
    ?>
    <tr>
      <td> <?=$name?></td>
      <td> <center> <?=$time?>' </center>  </td>
      <td> <center> <?=$type?> </center> </td>
      <td> <center><?=$isPrivate?></center></td>
      <td> <center> <form class="" action="Recipe.php" method="get">
        <button type="submit" name="recipe" value="<?=$id?>">Go To Recipe</button>
      </form> </center> </td>
      <td> <center> <a href="DeleteRecipe.php?rid=<?=$id?>"> <i class="fa fa-trash" style="color:red;"></i> </a> </center></td>
    </tr>
    <?php
  }
}
 ?>
</table><?php } ?></div>
<?php include 'footer.html'; ?>
