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
    <table border="5" class="ListRec">
      <tr>
        <th><center>Prof. Photo</center></th>
        <th><center>Username</center></th>
      </tr>
    <?php
    while ($row = mysqli_fetch_assoc($result)) {
      $userid = $row['uid'];
      $username = $row['username'];
      $photo = $row['prophoto'];
      $realpho = substr($photo,27);
      if (!isset($photo)) {
        $realpho = "https://www.umyu.edu.ng/components/com_jsn/assets/img/default.jpg";
      }
      ?>
      <tr>
        <td><center> <img src="<?=$realpho?>" alt="No photo" width="100" height="100"></center></td>
        <td><center> <a href="Profile.php?uid=<?=$userid?>"><?=$username?></a> </center></td>
      </tr>
      <?php
    }
    echo "</table>";
  }
}
include 'footer.html';
 ?>
