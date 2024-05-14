<?php
include '../controller/checksession.php';
require_once "../model/db_connpg.php";

$photographer_email = $_SESSION['pg'];

// Corrected SQL query (removed single quotes around table name)
$sql = "SELECT * FROM photographers WHERE contact_email = '$photographer_email'";

$result = mysqli_query($conn, $sql);
$photographer = mysqli_fetch_assoc($result);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Photographer Dashboard</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }

        .container {
            max-width: 900px;
            margin: 20px auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        header {
            background-color: #333;
            color: #fff;
            padding: 20px;
            text-align: center;
        }

        main {
            margin: 20px;
            padding: 20px;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            padding: 8px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #333;
            color: white;
        }

        img {
            max-width: 250px;
            max-height: 250px;
            border-radius: 10%;
        }

        .nav-links ul {
            list-style-type: none;
            margin: 0;
            padding: 20px;
            text-align: center;
        }

        .nav-links ul li {
            display: inline;
            margin-right: 10px;
        }

        .nav-links ul li a {
            text-decoration: none;
            color: #fff;
            padding: 10px;
            background-color: #333;
            border-radius: 5px;
        }

        .nav-links ul li a:hover {
            background-color: #555;
        }
    </style>
</head>

<body>
    <header>
        <h1>Welcome, <?php echo $photographer['name']; ?>!</h1>
        <p>Dashboard for Photographers</p>
    </header>

    <nav class="nav-links">
        <ul>
            <li><a href="../view/editprofile.php">Edit Profile</a></li>
            <li><a href="booking_history.php">Booking History</a></li>
            <li><a href="logout.php">Logout</a></li>
        </ul>
    </nav>

    <main>
        <div class="container">
            <h2>Photographer Profile</h2>
            <table>
                <tr>
                    <th>Field</th>
                    <th>Value</th>
                </tr>
                <?php
                foreach ($photographer as $key => $value) {
                    if ($key === 'photographer_id') {
                        continue;
                    }
                    ?>
                    <tr>
                        <td><?php echo ucfirst(str_replace('_', ' ', $key)); ?></td>
                        <?php if ($key === 'profile_picture') { ?>
                            <td><img src="../uploads/<?php echo $value; ?>" alt="Profile Picture"></td>
                        <?php } else { ?>
                            <td><?php echo $value; ?></td>
                        <?php } ?>
                    </tr>
                    <?php
                }
                ?>
            </table>
        </div>
    </main>
</body>

</html>