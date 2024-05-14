<?php
require_once "../model/db_connpg.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $password = $_POST['password'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $specialization = $_POST['specialization'];
    $location = $_POST['location'];
    $pricing = $_POST['pricing'];
    $availability = $_POST['availability'];
    $additional_info = $_POST['additional_info'];

    // Check if the email already exists
    $check_sql = "SELECT * FROM photographers WHERE contact_email = '$email'";
    $check_result = mysqli_query($conn, $check_sql);

    if (mysqli_num_rows($check_result) > 0) {
        // Email already exists, redirect back to signup page with error message
        header("Location:../reg/signup.php?error=Email already exists");
        exit; // Stop further execution
    }

    // File upload handling
    $uploadDirectory = "../uploads/";
    $filename = uniqid() . "_" . basename($_FILES['picture']['name']);
    $uploadFile = $uploadDirectory . $filename;

    if (move_uploaded_file($_FILES['picture']['tmp_name'], $uploadFile)) {
        // File uploaded successfully, save file path to database
        $picture = $filename;

        // Insert photographer data into database
        $sql = "INSERT INTO photographers (name, password, contact_email, contact_phone, specialization, location, pricing, availability, additional_info, profile_picture) 
                VALUES ('$name','$password','$email', '$phone', '$specialization', '$location', '$pricing', '$availability', '$additional_info', '$picture')";

        if (mysqli_query($conn, $sql)) {
            header("Location:../pgdex.php");
            exit; // Exit after redirection
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
    } else {
        echo "Possible file upload failed\n";
    }
}
?>