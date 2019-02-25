<?php
include 'connection.php';
include 'Index.html';

$username = $_POST['username'];
$pass = $_POST['password'];

$sql = "select * from users where username='".$username."' and PASSWORD='".sha1($pass)."'";
$result = mysqli_query($con,$sql);

if ($username=="") {
  ?>
<script type="text/javascript">
document.getElementById('usernamenull').innerHTML = "Put a username to log in";
document.getElementById('usernamenull').style.color="red";
document.getElementById('username').style.borderColor="red";
document.getElementById('username').style.borderStyle="solid";
</script>
  <?php
}
elseif ($pass=="") {
  ?>
<script type="text/javascript">
document.getElementById('passnull').innerHTML = "put a password to login";
document.getElementById('passnull').style.color="red";
document.getElementById('pass').style.borderColor="red";
document.getElementById('pass').style.borderStyle="solid";
</script>
  <?php
}
else{
if (!$result) {
  echo mysqli_error($con);
}
else {
  if (mysqli_num_rows($result)==0) {
    ?>
    <script type="text/javascript">
      document.getElementById('usernamenull').innerHTML = "Wrong Password Or There is No User with username <?=$username?>";
      document.getElementById('usernamenull').style.color="red";
      document.getElementById('username').style.borderColor="red";
      document.getElementById('username').style.borderStyle="solid";
    </script>
    <?php
  }
  else {
    while ($row=mysqli_fetch_assoc($result)) {
      $_SESSION['uid']=$row['id'];
      $_SESSION['username']=$row['username'];
      $_SESSION['name']=$row['name'];
      $_SESSION['surname']=$row['surname'];
    }
    header("location:MainMenu.php");
  }
}
}
 ?>
