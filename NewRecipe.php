<?php include 'connection.php';
include 'header.html';
?>
<br><br>
<form id="newrecipe" class="" action="AddRecipe.php" method="post" >
  <p>Name :</p>
  <input type="text" name="Name" placeholder="Name..." style="color:black;">
  <p>Type :</p>
<select class="" name="Type" style="color:black;">
  <?php
  $sql = "select * from type order by name desc";
  $result=mysqli_query($con,$sql);
  if (!$result) {
    echo mysqli_error($con);
  }
  else {
    while ($row=mysqli_fetch_assoc($result)) {
      $id = $row['id'];
      $name = $row['name'];
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
<input type="file" name="Pic" >
<p>Time Of Preparation :</p> <input type="text" name="Time" style="color:black;">    ' <br><br>
<center><input type="submit" name="save" value="save"></center>
</form>
<?php
include 'footer.html'; ?>
