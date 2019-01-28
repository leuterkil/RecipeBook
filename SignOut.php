<?php
session_destroy();
$_SESSION['uid'] = "";
Header("location:Index.html");
 ?>
