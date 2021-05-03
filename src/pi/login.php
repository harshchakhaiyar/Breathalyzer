<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
        integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <title>DrinkUp</title>
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css"
        integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />

</head>
<?php
$servername = "localhost";

$dbname = "esp_data";
$username = "admin";
$password = "your_password";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

$sql = "SELECT id, sensor, User, Location FROM SensorData";

?>


<body>


    <!-- Page Content -->
    <div class="container">

        <!-- Page Heading -->
        <h1 class="my-4">DrinkUp
            <i class="fa fa-cog" aria-hidden="true" style="float:right;"></i>
        </h1>

        <form action="esp-data.php" method="get">

            <!-- Select User -->
            <label for="User">Select User</label>
            <select id="User" name="User">
            <?php
                    if ($result = $conn->query($sql)) {
                        while ($row = $result->fetch_assoc()) {
                            $row_user = $row["User"];
                            echo '
                                <option value="' . $row_user .'">' . $row_user .' </option>
                            ';
                        }
                        $result->free();
                    }
                    $conn->close();
                    ?>
            </select>



            <!-- Score + Location Input-->
            <br>
            <label for="score">DrinkUp Score</label>
            <input type="text" class="form-control" name="sensor">
            <br>
            <label for="location">Location</label>
            <input type="text" class="form-control" name="Location" placeholder="Enter your Location! (Optional)">
            <br>

            <!-- Login Button -->
            <button type="submit" class="btn btn-info px-3"> 
                <i class="fas fa-beer"
                aria-hidden="true"></i> DrinkUp!
            </button>

        </form>







    </div>
    <!-- /.container -->
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"
        integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
        integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo"
        crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"
        integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6"
        crossorigin="anonymous"></script>

</body>

</html>
