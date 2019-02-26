<?php include 'connection.php';
include 'header.html';
?>
<?php
$uid = $_SESSION['uid'];
$sql = "select recipe.id,typename,name,photo,timeofpreparation,isPrivate from recipe,type where type.id=recipe.type and uid =".$uid;
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
  <div class="row">
  <?php
  while ($row = mysqli_fetch_assoc($res)) {
    $id = $row['id'];
    $name = $row['name'];
    $time = $row['timeofpreparation'];
    $type = $row['typename'];
    $isPrivate = $row['isPrivate'];
    $photo = $row['photo'];
    $real = substr($photo,27);
    ?>
    <div class="column">
      <div class="content">
        <img src="<?=$real?>" alt="Mountains" style="width:100%">
      <h3><?=$name?></h3>
      <p> <i class="fa fa-clock-o"></i> <b>Time : </b><?=$time?>'</p>
      <p> <i class="fa fa-tag"></i> <b>Type : </b><?=$type?></p>
      <p> <i class="fa fa-lock"></i>  <b>Is Private : </b><?=$isPrivate?> </p>
     <form class="" action="Recipe.php" method="get">
      <button type="submit" name="recipe" value="<?=$id?>">Go To Recipe <i class="fa fa-arrow-circle-right"></i></button></form>
       <center> <a href="DeleteRecipe.php?rid=<?=$id?>"> <i class="fa fa-trash" style="color:red;"></i> </a> </center>
    </div>
  </div>
    <?php
  }
}
 ?>
</div><?php } ?>
<?php include 'footer.html'; ?>
