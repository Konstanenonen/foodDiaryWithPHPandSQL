<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST')
	{
		if (isset($_POST['checkInteger'])) {
      $servername = "localhost";
      $username = "root";
      $password = "";
      $dbname = "session_db";
      $userid = $_COOKIE['userid'];
      
      // Create connection
      $conn = new mysqli($servername, $username, $password, $dbname);
      // Check connection
      if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
      }
      
      // sql to delete a record
      $sql = "DELETE FROM breakfast WHERE userid='$userid'";
      
      if ($conn->query($sql) === TRUE) {
        echo "Record deleted successfully";
      } else {
        echo "Error deleting record: " . $conn->error;
      }
      
      $conn->close();
		} else if (isset($_POST['checkUpdate'])) {
      $value = $_POST['valueDate'];
			$dish = $_POST['valueDish'];
			$drink = $_POST['valueDrink'];
      //Connect to data base
      $servername = "localhost";
      $username = "root";
      $password = "";
      $dbname = "session_db";
      $userid = $_COOKIE['userid'];

      // Create connection
      $conn = new mysqli($servername, $username, $password, $dbname);
      // Check connection
      if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
      }

      $sql = "UPDATE breakfast SET bDish='$dish', bDrink='$drink' WHERE bDate='$value' AND userid='$userid'";

      if ($conn->query($sql) === TRUE) {
        echo "Record updated successfully";
      } else {
        echo "Error updating record: " . $conn->error;
      }
    }
	}  
?>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">

    <title>Hello, world!</title>
    <header>
		<nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container-fluid">
              <a class="navbar-brand" href="index.php">Food Diary</a>
              <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
              </button>
              <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                  <li class="nav-item">
                    <a class="nav-link" href="index.php">Input</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="breakfast.php">Breakfast</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="lunch.php">Lunch</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="dinner.php">Dinner</a>
                  </li>
                </ul>
              </div>
            </div>
          </nav>
	  </header>
    <body>

    <h1 style="padding: 75px; font-size: 50px;">Breakfast Page</h1>

    <div class="container">
            <div class="row">
              <div class="col-sm">
                <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
                  <button name="checkInteger" type="submit" class="btn btn-danger">Clear History</button>
                </form>
                <div class="card" style="width: 22rem; margin-bottom: 50px;">
                    <div class="card-body">
                      <h5 class="card-title" style="margin-bottom: 20px;">Breakfast History</h5>
                      <div>
                        <?php
                          $servername = "localhost";
                          $username = "root";
                          $password = "";
                          $dbname = "session_db";
                          $userid = $_COOKIE['userid'];

                          // Create connection
                          $conn = new mysqli($servername, $username, $password, $dbname);
                          // Check connection
                          if ($conn->connect_error) {
                            die("Connection failed: " . $conn->connect_error);
                          }

                          $sql = "SELECT bDate, bDish, bDrink FROM breakfast WHERE userid='$userid'";
                          $result = $conn->query($sql);

                          if ($result->num_rows > 0) {
                              // output data of each row
                              while($row = $result->fetch_assoc()) {
                                echo "<div class='card' style='width: 10rem; margin-bottom: 20px'><div class='card-body' style='background-color: rgb(230,251,255);'> <strong>Date</strong>: ". $row["bDate"]. " <br> <strong>Dish</strong>: ". $row["bDish"]. " <br> <strong>Drink</strong>: " . $row["bDrink"] . "</div></div>";
                              }
                          } else {
                              echo "0 results";
                          }

                          $conn->close();
                        ?>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-sm">
                  <h1>Made a Mistake?</h1>
                  <div class="card" style="width: 18rem; margin-bottom: 50px;">
                      <div class="card-body">
                        <h5 class="card-title">Edit Breakfast History</h5>
                        <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
                          <div class="mb-3">
                              <label for="exampleInputText" class="form-label">Where Date Was</label>
                              <input name="valueDate" class="form-control" type="text" aria-label="default input example">
                          </div>
                          <div class="mb-3">
                            <label for="exampleInputText" class="form-label">Edited Dish</label>
                            <input name="valueDish" class="form-control" type="text" aria-label="default input example">
                          </div>
                          <div class="mb-3">
                            <label for="exampleInputText" class="form-label">Edited Drink</label>
                            <input name="valueDrink" class="form-control" type="text" aria-label="default input example">
                          </div>
                          <button type="submit" name="checkUpdate" class="btn btn-primary">Submit</button>
                        </form>
                      </div>
                  </div>
                </div>
              </div>
            </div>


    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js" integrity="sha384-SR1sx49pcuLnqZUnnPwx6FCym0wLsk5JZuNx2bPPENzswTNFaQU1RDvt3wT4gWFG" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.min.js" integrity="sha384-j0CNLUeiqtyaRmlzUHCPZ+Gy5fQu0dQ6eZ/xAww941Ai1SxSY+0EQqNXNE6DZiVc" crossorigin="anonymous"></script>
    -->
  </body>
</html>
