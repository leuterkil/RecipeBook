<?php include 'connection.php';
include 'header.html';
?>
<br><br>
<form enctype="multipart/form-data" id="newrecipe" class="" action="AddRecipe.php" method="post" >
  <p>Name :</p>
  <input type="text" name="Name" placeholder="Name..." autocomplete="off" style="color:black;">
  <p>Type :</p>
<select class="" name="Type" style="color:black;">
  <?php
  $sql = "select * from type order by typename desc";
  $result=mysqli_query($con,$sql);
  if (!$result) {
    echo mysqli_error($con);
  }
  else {
    while ($row=mysqli_fetch_assoc($result)) {
      $id = $row['id'];
      $name = $row['typename'];
      ?>
      <option value="<?=$id?>"><?=$name?></option>
      <?php
    }
  }
   ?>
</select>
<p>Ingredients :</p>
<input type="button" name="add" value="+" id="add">
<div id="newinc">
</div> <br>
<p>Description of Recipe:</p>
<textarea name="Desc" rows="10" cols="80" placeholder="Description..." style="color:black;"></textarea>
<p>Photo of Food : </p>
<input type="file" name="myfile" style="color:black;" >
<p>Time Of Preparation :</p> <input type="text" name="Time" style="color:black;" autocomplete="off" >    '<br>
<p>Do You Want This Recipe to Be Private ?</p>
<input type="radio" name="Private" value="Yes"> Yes <br>
<input type="radio" checked name="Private" value="No"> No <br>
Note : By Checking this recipe to be private other users can't see or save this <br>
Recipe.This feature can be changed from recipe settings menu.
 <br><br>
<center><input type="submit" name="save" value="save"></center>
</form>
<?php
include 'footer.html'; ?>
