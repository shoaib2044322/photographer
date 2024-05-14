<?php

session_start();

unset($_SESSION['admin']);

session_destroy();

// header("Location: http://localhost/ROS/ROSv17/sign.php");
header('location: ../pgdex.php');
