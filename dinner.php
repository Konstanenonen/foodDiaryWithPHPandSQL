
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">

    <title>Dinner</title>
  </head>




    <body>

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

<?php
// Recuiring dbinfo to get the proper info for database connection
require_once('dbinfo.php');
if ($_SERVER['REQUEST_METHOD'] == 'POST')
	{
    // This executes when delete button is pressed
		if (isset($_POST['checkInteger'])) {
      // Getting the userid from cookies
      $userid = $_COOKIE['userid'];
      
      // Create connection to the database
      $conn = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
      // Check connection
      if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
      }
      
      // Making a prepared sql statement for deleting all records from dinner table
      $deleteDinner = $conn->prepare("DELETE FROM dinner WHERE userid=?");
      $deleteDinner->bind_param('i', $userid);
      
      // Exectuing the prepared sql statement
      $deleteDinner->execute();
      
      //Error handling of the database problems
      if ($deleteDinner->error) {
        echo "<p style='text-align: center;'><strong>There was a problem deleting Dinner History, please try again later</strong></p>";
      } else {
        echo "<p style='text-align: center;'><strong>Dinner History cleared</strong></p>";
      }
      
      $conn->close();

      //This executes when the edit button is pressed
		}  else if (isset($_POST['checkUpdate'])) {
      $value = $_POST['valueDate'];
      $time = $_POST['valueTime'];
			$dish = $_POST['valueDish'];
			$drink = $_POST['valueDrink'];
      $userid = $_COOKIE['userid'];
      if (strlen($value) > 2 && strlen($value) < 30 && strlen($dish) > 2 && strlen($dish) < 30 && strlen($drink) > 2 && strlen($drink) < 30) { //Checking that input value isn't too loo long or small
     
      //Connect to data base
      $conn = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
      // Check connection
      if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
      }

     // Sanitizing the user input from malicious symbols
      $sanitizeValue = filter_var($value, FILTER_SANITIZE_STRING);
      $sanitizeTime = filter_var($time, FILTER_SANITIZE_STRING);
      $sanitizeDish = filter_var($dish, FILTER_SANITIZE_STRING);
      $sanitizeDrink = filter_var($drink, FILTER_SANITIZE_STRING);

      // Making a prepared sql statement that that changes the dinner item in a way the user wants it to be.
      $updateBreakfast = $conn->prepare("UPDATE dinner SET dinnerTime=?, dinnerDish=?, dinnerDrink=? WHERE dinnerDate=? AND userid=?");
      $updateBreakfast->bind_param('ssssi', $sanitizeTime, $sanitizeDish, $sanitizeDrink, $sanitizeValue, $userid);
      
      // Executing the prepared sql statement
      $updateBreakfast->execute();

      // Error handling of the database
      if ($updateBreakfast->error) {
        echo "<p style='text-align: center;'><strong>There was a problem editing the meal. Please try again later!</strong></p>";
      } else {
        echo "<p style='text-align: center;'><strong>Dinner History updated</strong></p>";
      }

        $conn->close();

        // Error handling of the user input.
      } else {
				echo "<p style='text-align: center;'><strong>The input value can't be too small or long</strong></p>";
			}
    }
	}  
?>

    <h1 style="padding: 75px; font-size: 50px;">Dinner Page</h1>

    <div class="container">
            <div class="row">
              <div class="col-sm">
                <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
                  <button name="checkInteger" type="submit" class="btn btn-danger">Clear History</button>
                </form>
                <div class="card" style="width: 22rem; margin-bottom: 50px; background-color: rgb(250, 251, 252);">
                    <div class="card-body">
                      <h5 class="card-title" style="margin-bottom: 20px;">Dinner History</h5>
                      <div>
                        <!--Including dinnerHistory.php file to show the data fron dinner table in this page-->
                        <?php include 'dinnerHistory.php';?>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-sm">
                  <h1>Made a Mistake?</h1>
                  <div class="card" style="width: 18rem; margin-bottom: 50px; background-color: rgb(250, 251, 252);">
                      <div class="card-body">
                        <h5 class="card-title">Edit Dinner History</h5>
                        <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
                          <div class="mb-3">
                              <label for="exampleInputText" class="form-label">Where Date was:</label>
                              <input name="valueDate" class="form-control" type="text" aria-label="default input example">
                          </div>
                          <div class="mb-3">
                              <label for="exampleInputText" class="form-label">Edited Time:</label>
                              <input name="valueTime" class="form-control" type="text" aria-label="default input example">
                          </div>
                          <div class="mb-3">
                            <label for="exampleInputText" class="form-label">Edited Dish:</label>
                            <input name="valueDish" class="form-control" type="text" aria-label="default input example">
                          </div>
                          <div class="mb-3">
                            <label for="exampleInputText" class="form-label">Edited Drink:</label>
                            <input name="valueDrink" class="form-control" type="text" aria-label="default input example">
                          </div>
                          <button type="submit" name="checkUpdate" class="btn btn-primary">Edit</button>
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