<?php
require_once "../model/db_connpg.php";

session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $useremail = $_POST['useremail'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM `photographers` WHERE `contact_email`='$useremail' AND `password`='$password'";
    $searchresult = mysqli_query($conn, $sql);
    $count = mysqli_num_rows($searchresult);

    if ($count > 0) {
        // Set session variable for successful login
        $_SESSION['pg'] = $useremail;
        header("Location:../view/pgdashboard.php");
    } else {
        // Redirect back to login page with error message
        header("Location:../pgdex.php?error=Invalid Username/Password");
    }
} else {
    // Redirect back to login page if not a POST request
    header("Location:../pgdex.php?error=Unauthorized Access");
}
?>