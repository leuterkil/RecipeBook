<?php
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
 <a href="SearchRec.php?type=<?=$id?>"><?=$name?></a>
<?php }?>
</div>
