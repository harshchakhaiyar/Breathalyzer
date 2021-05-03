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



$sql_update = "UPDATE `SensorData` SET `Active` = '1' WHERE `SensorData`.`User` = '" . $_GET['User'] ."';";
$conn->query($sql_update);

$sql_update = "UPDATE `SensorData` SET `SensorData`.`Location` = '" . $_GET['Location'] ."' WHERE `SensorData`.`User` = '" . $_GET['User'] ."';";
$conn->query($sql_update);
$sql_update = "UPDATE `SensorData` SET `SensorData`.`sensor` = '" . $_GET['sensor'] ."' WHERE `SensorData`.`User` = '" . $_GET['User'] ."';";
$conn->query($sql_update);

$sql_update = "UPDATE `SensorData` SET `Active` = '0' WHERE `SensorData`.`User` != '" . $_GET['User'] ."';";
  if($conn->query($sql_update)  != TRUE){
        echo '
                error
        ';
  }


?>

<!DOCTYPE html>
<html>

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

<body>
  <?php


  $sql = "SELECT id, sensor, User, Location  FROM SensorData";

  echo '
        <!-- Page Heading -->
        <h1 class="my-4">DrinkUp
          <small>My Friends</small>
          <i class="fa fa-cog" aria-hidden="true" style="float:right;"></i>
        </h1>
  '; 

  if ($result = $conn->query($sql)) {
    while ($row = $result->fetch_assoc()) {
      $row_id = $row["id"];
      $row_sensor = $row["sensor"];
      $row_location = $row["Location"];
      $row_user = $row["User"];
      $row_active = $row["Active"];

      echo '
      <div class="container">
          <!-- Friends -->
        <div class="row">
            <div class="col-md-7">
                <a href="#">
                    <img class="img-fluid rounded mb-3 mb-md-0" src="img/img/' . $row_user.'.jpg" alt="goat" width="300" height="300">
                </a>
            </div>
            <div class="col-md-5">
      ';
      if ($row_user == $_POST['User']){
        echo '
                  <h3 style="color:red">' . $row_user .'</h3>
        ';
      }
      else{
        echo '
                  <h3>' . $row_user .'</h3>
        ';
      }
      echo '
                <h3 style="font-size: 20px;">Location <span style="font-size: 16px;">' . $row_location .'</span></h3>
                <h3 style="font-size: 20px;">BAC <span style="font-size: 16px;">' . $row_sensor .'</span></h3>
              </div>
        </div>
      </div>
      ';

    }
    $result->free();
  }


  $conn->close();
  ?>
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