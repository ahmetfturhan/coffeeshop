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
                <a class="btn signBtns btn-outline-light d-none d-sm-inline me-2" href="currentOrders.php">Current Orders</a>
                <a class="btn signBtns btn-outline-light d-none d-sm-inline me-2" href="admin.php">
                    <?php
                    echo $EMailAddress;
                    ?>
                </a>
                <a class="btn signBtns btn-outline-light d-none d-sm-inline me-2" href="endSession.php">Logout</a>
            </div>
        </div>
    </nav>
    <div class="container rounded p-4 text-center">
        <h2>Add New Item</h2>
        <form action="addItem.php" method="post">
            <div class="row justify-content-center">
                <div class="form-floating mb-3 col-4">
                    <input type="text" class="form-control" id="cName" placeholder="Coffee Name" name="CoffeeName">
                    <label for="cName">CoffeeName</label>
                </div>

                <div class="form-floating col-4">
                    <input type="text" class="form-control" id="desc" placeholder="Description" name="Description">
                    <label for="desc">Description</label>
                </div>

                <!-- <div class="form-floating col-4">
                    <input type="number" class="form-control" id="CID" placeholder="Password" name="CoffeeID">
                    <label for="CID">CoffeeID</label>
                </div> -->
            </div>
            <div class="row justify-content-center">
                <div class="form-floating mb-3 col-4">
                    <input type="text" class="form-control" id="small" placeholder="Small Price" name="small">
                    <label for="small">Small Price</label>
                </div>

                <div class="form-floating col-4">
                    <input type="text" class="form-control" id="medium" placeholder="Medium Price" name="medium">
                    <label for="medium">Medium Price</label>
                </div>

                <div class="form-floating col-4">
                    <input type="number" class="form-control" id="large" placeholder="Large Price" name="large">
                    <label for="large">Large Price</label>
                </div>
            </div>
            <button class="btn btn-lg btn-outline-light" type="submit">Add Item</button>
        </form>

        <div class="row justify-content-center mt-3">
            <p>Latest CoffeID:
                <?php
                $fetchID = "SELECT MAX(`CoffeeID`) as 'LatestID' from `coffee`";
                $result = mysqli_query($conn, $fetchID);
                $row = mysqli_fetch_array($result);
                echo $row[0];
                $_SESSION['newCofID'] = $row[0] + 1;
                ?>
            </p>
        </div>
    </div>




    <a class="text-center" href="loggedindex.php">
        <h3>Homepage</h3>
    </a>


    <script src="index.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>

</html>