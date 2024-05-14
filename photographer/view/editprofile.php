<?php
// Include the necessary files and start the session
include '../controller/checksession.php';
require_once "../model/db_connpg.php";
$photographer_email = $_SESSION['pg'];
$sql = "SELECT * FROM photographers WHERE contact_email = '$photographer_email'";

$result = mysqli_query($conn, $sql);
$photographer = mysqli_fetch_assoc($result);

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profile</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            padding: 20px;
        }

        h1 {
            text-align: center;
            margin-bottom: 20px;
        }

        form {
            max-width: 500px;
            margin: 0 auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        label {
            display: block;
            font-weight: bold;
            margin-bottom: 5px;
        }

        input[type="text"],
        input[type="password"],
        input[type="tel"],
        textarea {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 3px;
            box-sizing: border-box;
        }

        textarea {
            height: 100px;
        }

        input[type="file"] {
            margin-top: 10px;
        }

        input[type="submit"] {
            background-color: #007bff;
            color: #fff;
            border: none;
            padding: 10px 20px;
            border-radius: 3px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        input[type="submit"]:hover {
            background-color: #0056b3;
        }
    </style>
</head>

<body>
    <h1>Edit Profile</h1>
    <form action="../model/edit_pg.php" method="post" enctype="multipart/form-data">
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" value="<?php echo $photographer['name']; ?>" required>

        <label for="password">Password:</label>
        <input type="password" id="password" name="password" value="<?php echo $photographer['password']; ?>" required>

        <label for="phone">Phone:</label>
        <input type="tel" id="phone" name="phone" value="<?php echo $photographer['contact_phone']; ?>">

        <label for="specialization">Specialization:</label>
        <input type="text" id="specialization" name="specialization"
            value="<?php echo $photographer['specialization']; ?>">

        <label for="location">Location:</label>
        <input type="text" id="location" name="location" value="<?php echo $photographer['location']; ?>">

        <label for="pricing">Pricing:</label>
        <input type="text" id="pricing" name="pricing" value="<?php echo $photographer['pricing']; ?>">

        <label for="availability">Availability:</label>
        <textarea id="availability" name="availability"><?php echo $photographer['availability']; ?></textarea>

        <label for="additional_info">Additional Information:</label>
        <textarea id="additional_info" name="additional_info"><?php echo $photographer['additional_info']; ?></textarea>

        <label for="picture">Upload Profile Picture:</label>
        <input type="file" id="picture" name="picture" accept="image/*">

        <input type="submit" value="Update Profile">
    </form>
</body>

</html>