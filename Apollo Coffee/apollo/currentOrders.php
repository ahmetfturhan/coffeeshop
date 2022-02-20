<?php
session_start();
if (!($_SESSION['EMailAddress'] == 'turhana@mef.edu.tr'))
    header("Location: loggedIndex.php");
$EMailAddress = $_SESSION['EMailAddress'];


$servername = "localhost";
$username = "root";
$password = "";
$dbname = "db1";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("connection failed: " . $conn->connect_error);
}
//echo "Connected succesfully";
$getOrders = "SELECT * FROM (
    SELECT * FROM `customerorder` ORDER BY `OrderID` DESC LIMIT 10
 )Var1
    ORDER BY `OrderID` ASC";
$result = mysqli_query($conn, $getOrders);
$solutions = array();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Apollo - Real Coffee.</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <!-- Fonts -->
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Montagu+Slab:wght@100;200;300;400;500;600;700&display=swap');
    </style>

</head>

<body>
    <!-- Navbar -->
    <nav class="navbar">
        <div class="container rounded justify-content-between">
            <img class="logo img-fluid" src="logo.png" alt="">
            <div>
                <a class="btn signBtns btn-outline-light d-none d-sm-inline me-2" href="admin.php">
                    <?php
                    echo $EMailAddress;
                    ?>
                </a>
                <a class="btn signBtns btn-outline-light d-none d-sm-inline me-2" href="endSession.php">Logout</a>
            </div>
        </div>
    </nav>
    <div class="container rounded mt-3 p-4">
        <h2>Last 10 Orders</h2>
        <table class="table table-warning">
            <thead>
                <tr>
                    <th scope="col">OrderID</th>
                    <th scope="col">Delivery Date</th>
                    <th scope="col">Delivery Time</th>

                </tr>
            </thead>
            <tbody>
                <?php
                while ($row = mysqli_fetch_assoc($result)) {
                    $OrderID = $row['OrderID'];
                    $Date = $row['Date'];
                    $Time = $row['DeliveryTime'];


                    echo '
                    <tr>
                    <th scope="row">' .
                        $OrderID . '
                    </th>
                    <td>
                        ' . $Date . '
                    </td>
                    <td>
                        ' . $Time . '
                    </td>
                    </tr>
                    ';
                }
                ?>


            </tbody>
        </table>
    </div>
    <a class="text-center" href="loggedindex.php">
        <h3>Homepage</h3>
    </a>


    <script src="index.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>

</html>