<?php
include 'connection.php';
include 'SignUp.html';
function CheckUsername($user)
{
  $sqlqu = "select * from users where username=".$user;
  $result = mysqli_query($con,$sqlqu);
  if ($result) {
    if (mysqli_num_rows($result)==0) {
      return 1;
    }
    else {
      return 0;
    }
  }
  else {
    return 0;
  }
}
$name = $_POST['Name'];
$surname = $_POST['surname'];
$username = $_POST['username'];
$pass = $_POST['password'];
$retype = $_POST['retype'];
$usernameExist = CheckUsername($username);
if ($usernameExist==1) {
  ?>
<script type="text/javascript">
document.getElementById('usernull').style.color="red";
document.getElementById('usernull').innerHTML="The Username you put already exists";
document.getElementById('username').style.borderColor="red";
document.getElementById('username').style.borderStyle="solid";
</script>
  <?php
  return;
}
elseif ($username=="") {
  ?>
  <script type="text/javascript">
  document.getElementById('usernameExist').innerHTML="Put a username First";
  document.getElementById('usernameExist').style.color="red";
  document.getElementById('username').style.borderColor="red";
  document.getElementById('username').style.borderStyle="solid";
  </script>
  <?php
  return;
}
elseif ($pass=="") {
  ?>
  <script type="text/javascript">
  document.getElementById('passnull').innerHTML="Put a password First";
  document.getElementById('passnull').style.color="red";
  document.getElementById('password').style.borderColor="red";
  document.getElementById('password').style.borderStyle="solid";
  </script>
  <?php
  return;
}
elseif ($pass!=$retype) {
  ?>
  <script type="text/javascript">
  document.getElementById('passnull').innerHTML="Password is not the same";
  document.getElementById('passnull').style.color="red";
  document.getElementById('password').style.borderColor="red";
  document.getElementById('password').style.borderStyle="solid";
  document.getElementById('retype').style.borderColor="red";
  document.getElementById('retype').style.borderStyle="solid";
  </script>
  <?php
  return;
}
elseif (strlen($pass)<6)
{
  ?>
  <script type="text/javascript">
  document.getElementById('passnull').innerHTML="Password Must be six characters long";
  document.getElementById('passnull').style.color="red";
  document.getElementById('password').style.borderColor="red";
  document.getElementById('password').style.borderStyle="solid";
  </script>
  <?php
  return;
}
else {
  $photo = "https://www.umyu.edu.ng/components/com_jsn/assets/img/default.jpg";
  $sql = "insert into users (name,surname,username,PASSWORD,prophoto)values('".$name."','".$surname."','".$username."',sha('".$pass."'),'".$photo."')";
  $result = mysqli_query($con,$sql);
  if (!$result) {
  }
  else {
     header("location:Index.html");
  }
}
 ?>
