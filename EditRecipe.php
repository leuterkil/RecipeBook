<?php
include 'connection.php';
include 'header.html';

$recid = $_GET['recipe'];
$sqlrec = "select * from recipe where id=".$recid;
$sqlinc = "select * from ingredients where recipe=".$recid;
$sqltype = "select * from type order by typename desc";

  echo "<br><br><br>";
  echo "<form enctype=multipart/form-data id=newrecipe action=ChangeRecipe.php method=post>";
$result = mysqli_query($con,$sqlrec);
if (!$result) {
  echo mysqli_error($con);
}
else {
  $row = mysqli_fetch_assoc($result);
  $photo = $row['photo'];
  $name = $row['name'];
  $type = $row['type'];
  $desc = $row['description'];
  $time=$row['timeofpreparation'];
  $private = $row['isPrivate'];
  $realpho = substr($photo,27);
  if (!isset($photo)) {
    $photo = "http://icons.iconarchive.com/icons/mcdo-design/closed-notes/256/Notebook-Recipe-icon.png";
  }
  else {
    $photo = $realpho;
  }
  $sqlcurrenttype = "select * from type where id=".$type;
  $rescurrent = mysqli_query($con,$sqlcurrenttype);
  $rowcurrent = mysqli_fetch_assoc($rescurrent);
  $currenttypename = $rowcurrent['typename'];
  $currenttypeid = $rowcurrent['id'];
  $restype = mysqli_query($con,$sqltype);
  ?>
  <p>Name :</p>
  <input type="text" name="Name" value="<?=$name?>" style="color:black;">
  <p>Type : </p>
<select class="" name="Type" style="color:black;">
<option selected="<?=$currenttypeid?>" value="<?=$currenttypeid?>"><?=$currenttypename?></option>
  <?php
  while ($rowtype=mysqli_fetch_assoc($restype)) {
    $typeid = $rowtype['id'];
    $typename = $rowtype['typename'];
    ?>
    <option value="<?=$typeid?>" style="color:black;"><?=$typename?></option>
    <?php
  }
  echo "</select>";
  $counter=1;
  $resing=mysqli_query($con,$sqlinc);
  echo "<p>Ingredients : </p>";
  while($rowing = mysqli_fetch_assoc($resing))
  {
    $ingname = $rowing['name'];
    ?>
    <div id="olding<?=$counter?>">
      <?=$counter?><input type="text" name="ing<?=$counter?>" value="<?=$ingname?>" style="color:black;">
      <input type="button" name="rem" id="remove" value="-" onclick="remove('olding<?=$counter?>')"><br>
      </div>
    <?php
    $_SESSION['counter']=$counter;
    $counter++;
  }

  echo "<input type=button name=add value=+ id=add>
  <div id=newinc>
  </div> <br>";
  ?>
  <p>Description :</p>
  <textarea name="desc" rows="8" cols="80" style="color:black;"><?=$desc?></textarea>
  <p>Photo Of Food :</p>
  <img src="<?=$photo?>" alt="No Photo" width="256" height="256"><br>
<input type="file" name="myfile" value="Photo"> <br><br>
<p>Time Of Preparation :</p>
<input type="text" name="Time" value="<?=$time?>"style="color:black;">
<p>Do you want this recipe to be private?</p>
<?php
if ($private=="Yes") {
  $isYes="checked";
  $isNo="";
}
else {
  $isYes="";
  $isNo="checked";
}
 ?>
<input type="radio" name="Private" value="Yes" <?=$isYes?>>Yes <br>
<input type="radio" name="Private" value="No" <?=$isNo?>> No <br>
<p>Note : By Checking this recipe to be private other users can't see or save this <br>
Recipe.This feature can be changed from recipe settings menu. </p>
<center> <button type="submit" name="recipe" value="<?=$recid?>">Save</button> </center>
  <?php
  echo "</form>";
}

include 'footer.html';
 ?>
