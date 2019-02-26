<?php include 'connection.php';
include 'header.html';

$uid = $_GET['uid'];
$uidofuse = $_SESSION['uid'];
$sqlfollowers = "select count(following) from follows where following=".$uid;
$resfollowers = mysqli_query($con,$sqlfollowers);
if (!$resfollowers) {
  echo mysqli_error($con);
}
else {
  $row = mysqli_fetch_assoc($resfollowers);
  $number = $row['count(following)'];
}
if ($uid==$uidofuse) {
$isthesame=1;
$button=  "<div class = follow><a href=Edit.php><button type=submit name=edit>Edit <span class=fa style=color:white;>&#xf040;</span> </button></a></div>";
$buttonPass = "<div style=background-color=red;width=300px;height=25px;><a href=ChangePass.php?uid=".$uidofuse."><button type=submit name=pass>Ghange Your Password</button></a></div>";
}
else {
  $isthesame=0;
  $sqlfollow = "select * from follows where uid= ".$uidofuse." and following=".$uid;
  $result = mysqli_query($con,$sqlfollow);
  if (!$result) {
    echo mysqli_error($con);
  }
  else {
    if (mysqli_num_rows($result)==0) {
      $class = "fa fa-user-plus";
      $buttonPass="";
      $button= "<div class=follow><a href=Follow.php?uid=".$uidofuse."&following=".$uid.">
      <button type=submit name=follow><span class=fa style=color:white;>&#xf234;</span> </button></a></div>";
    }
    else {
      $class = "fa fa-user-times";
      $buttonPass="";
      $button= "<div class=unfollow><a href=UnFollow.php?uid=".$uidofuse."&following=".$uid.">
      <button type=submit name=Unfollow><span class=fa>&#xf235;</span> </button>
      </a></div>";
    }
  }
}
$sql = "select users.name,prophoto,surname,username,job,gender,favorite_foods,country,users.description,count(uid) from users,recipe where users.id=recipe.uid and users.id=".$uid;
$result = mysqli_query($con,$sql);
if (!$result) {
  echo mysqli_error($con);
}
else {
  $row = mysqli_fetch_assoc($result);
  $username = $row['username'];
  $name  = $row['name'];
  $sur = $row['surname'];
  $photo = $row['prophoto'];
  $job = $row['job'];
  $bio = $row['description'];
  $recnum = $row['count(uid)'];
  $country = $row['country'];
  $favfood = $row['favorite_foods'];
    $realpho = substr($photo,27);
if ($photo=="https://www.umyu.edu.ng/components/com_jsn/assets/img/default.jpg") {
  $realpho = "https://www.umyu.edu.ng/components/com_jsn/assets/img/default.jpg";
}
 ?>
 <br><br><br>
 <div class="ViewForm">

   <form style="background-color:#ff9966;">
   <center> <img src="<?=$realpho?>" alt="No Photo" width="256" height="256" style="border-radius:50%;border-style:solid;border-color:red;"><br>
   <h2><?=$username?></h2>
   <span style="color:#ddd;"><?=$name?> <?php echo " " ?> <?=$sur?></span> <br>
   <span style="color:#ddd"> <b><?=$country?></b> </span> <br>
   Number of Followers : <a href="ListOfFollowers.php?uid=<?=$uid?>" style="color:#333;"><?=$number?></a><br>
   Number of Recipes : <a href="ListOfRecipesOfOtherUser.php?uid=<?=$uid?>" style="color:#333;"><?=$recnum?></a><br>
 </form>
</center>
<center><?=$button?> <?=$buttonPass?></center>
<form style="background-color:#ff9966;">
Bio : <br>
<table border="1">
  <tr>
    <td><b style="font-family:sans-serif"><?=$job?></b><br> <textarea name="name" rows="4" cols="40" readonly style="background-color:inherit;border:none;resize:none; font-family:sans-serif;font-style:italic;"><?=$bio?></textarea> </td>
  </tr>
</table> <br>
Favorite Foods : <br>
<table border="1">
  <tr>
    <td><i style="font-family:sans-serif"><?=$favfood?></i></td>
  </tr>
</table>
</form>

</div>
 <?php
}
  include 'footer.html'; ?>
