<?php
// Include the necessary files and start the session
include '../controller/checksession.php';
require_once "../model/db_connpg.php";

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve the form data
    $name = $_POST['name'];
    $password = $_POST['password'];
    $phone = $_POST['phone'];
    $specialization = $_POST['specialization'];
    $location = $_POST['location'];
    $pricing = $_POST['pricing'];
    $availability = $_POST['availability'];
    $additional_info = $_POST['additional_info'];
    $photographer_email = $_SESSION['pg'];

    // Check if the profile picture is being updated
    if (!empty($_FILES['picture']['name'])) {
        // File upload handling
        $uploadDirectory = "../uploads/";
        $filename = uniqid() . "_" . basename($_FILES['picture']['name']);
        $uploadFile = $uploadDirectory . $filename;

        if (move_uploaded_file($_FILES['picture']['tmp_name'], $uploadFile)) {
            // File uploaded successfully, save file path
            $picture = $filename;
        } else {
            echo "Possible file upload failed\n";
            exit; // Exit if file upload failed
        }
    } else {
        // Profile picture is not being updated, retain the existing picture URL
        $picture = $photographer['profile_picture'];
    }

    // Update photographer data in the database
    $sql = "UPDATE photographers SET 
            name = '$name',
            password = '$password',
            contact_phone = '$phone',
            specialization = '$specialization',
            location = '$location',
            pricing = '$pricing',
            availability = '$availability',
            additional_info = '$additional_info',
            profile_picture = '$picture'
            WHERE contact_email = '$photographer_email'";

    $edited = mysqli_query($conn, $sql);
    if ($edited) {
        header("Location:../view/pgdashboard.php");
        exit; // Exit after redirection
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
}




?>