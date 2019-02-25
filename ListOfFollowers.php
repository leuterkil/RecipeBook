<?php
include 'connection.php';
include 'header.html';

$uid = $_GET['uid'];
$sql = "select * from follows,users where users.id=follows.uid and following=".$uid;
$result = mysqli_query($con,$sql);
if (!$result) {
  echo mysqli_error($con);
}
else {
  if (mysqli_affected_rows($con)==0) {
    echo "<br><br><br>This User Has no Followers at the moment";
  }
  else {
    ?>
    <br><br><br>
    <h1>List Of Followers</h1>
<div class="row">
    <?php
    while ($row = mysqli_fetch_assoc($result)) {
      $userid = $row['uid'];
      $username = $row['username'];
      $photo = $row['prophoto'];
      $name = $row['name'];
      $sur  = $row['surname'];
      $realpho = substr($photo,27);
      if (!isset($photo)) {
        $realpho = "https://www.umyu.edu.ng/components/com_jsn/assets/img/default.jpg";
      }
      ?>
      <div class="column">
        <div class="content">
         <center><img src="<?=$realpho?>" alt="No photo" width="256" height="256"></center>
         <center> <b>Full Name : </b> <?=$name?> <?=$sur?> </center>
         <center><p> <b>Username :</b> <a href="Profile.php?uid=<?=$userid?>"><?=$username?></a></p></center>
      </div>
    </div>
      <?php
    }
    echo "</div>";
  }
}
include 'footer.html';
 ?>
