<?php
// requiring this file to create connection to datbase later
  require_once('dbinfo.php');

  // Fetching userid from cookie
  $userid = $_COOKIE['userid'];

  // Create connection to the database
  $conn = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
  // Check connection
  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }
                          
  // Making prepared sql statement that we use to read data from the table and output it to our Breakfast History
  $sql = "SELECT lunchDate, lunchTime, lunchDish, lunchDrink FROM lunch WHERE userid = '$userid'";
  $result = $conn->query($sql);
                          
  // This happens when the table isn't empty
  if ($result->num_rows > 0) {
      // output data of each row
      while($row = $result->fetch_assoc()) {
        echo "<div class='card' style='width: 10rem; margin-bottom: 20px'><div class='card-body' style='background-color: rgb(230,251,255);'><h5 class='card-title'>" . $row["lunchDate"]. "</h5> <p class='card-text'><strong>Time</strong>: ". $row["lunchTime"]. " <br> <strong>Dish</strong>: ". $row["lunchDish"]. " <br> <strong>Drink</strong>: " . $row["lunchDrink"] . "</p></div></div>";
      }
    // This will be shown if the table is empty
  } else {
      echo "0 results";
  }

  $conn->close();
?>