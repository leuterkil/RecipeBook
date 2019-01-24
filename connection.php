<?php
$con=mysqli_connect("localhost","root","");
  mysqli_select_db($con,"recipe_book");
  mysqli_set_charset($con, "utf8");
  session_start();
 ?>
