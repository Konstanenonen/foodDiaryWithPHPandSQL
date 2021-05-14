
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">

    <title>Hello, world!</title>
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
require_once('dbinfo.php');
session_start();

//Creating custom function for error message to save time
function tooBigOrSmall() {
  echo "<p style='text-align: center;'><strong>The input value can't be too small or long</strong></p>";
}

//Creating custom function for confirmation message to save time
function addingConfirmation() {
  echo "<p style='text-align: center;'><strong>New meal added to Dinner History</strong></p>";
}

  /* If the session data does not exist (i.e we are starting a new session), try to set the session's data with 
     the cookies that were saved when the user made his/her last login (i.e: the cookies that the client browser is sending in its HTTP GET request to this index.php script)
     This is the code that allows the app to remember the user that last logged in to the app (in the browser/computer that's issuing the HTTP GET request) and left the app without logging out 
  */
  if (!isset($_SESSION['userid'])) {
    if (isset($_COOKIE['userid']) && isset($_COOKIE['username'])) {
      $_SESSION['userid'] = $_COOKIE['userid'];
      $_SESSION['username'] = $_COOKIE['username'];
    }
  }

if ($_SERVER['REQUEST_METHOD'] == 'POST')
	{
		if (isset($_POST['checkLengthBreakfast'])) {  // Checking text length
			$value = $_POST['valueDate'];
      $time = $_POST['valueTime'];
			$dish = $_POST['valueDish'];
			$drink = $_POST['valueDrink'];
      $userid =  $_SESSION['userid'];
			if (strlen($value) > 2 && strlen($value) < 30 && strlen($dish) > 2 && strlen($dish) < 30 && strlen($drink) > 2 && strlen($drink) < 30 && strlen($time) > 2 && strlen($time) < 30) {
				
				// Create connection
				$conn = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
				// Check connection
				if ($conn->connect_error) {
					die("Connection failed: " . $conn->connect_error);
}

        $sanitizeValue = filter_var($value, FILTER_SANITIZE_STRING);
        $sanitizeTime = filter_var($time, FILTER_SANITIZE_STRING);
        $sanitizeDish = filter_var($dish, FILTER_SANITIZE_STRING);
        $sanitizeDrink = filter_var($drink, FILTER_SANITIZE_STRING);

				$sql = "INSERT INTO breakfast (bDate, bTime, bDish, bDrink, userid)
				VALUES ('$sanitizeValue', '$sanitizeTime', '$sanitizeDish', '$sanitizeDrink', '$userid')";

				if ($conn->query($sql) === TRUE) {
          addingConfirmation();
				} else {
				echo "Error: " . $sql . "<br>" . $conn->error;
				}

				$conn->close();
			} else {
				tooBigOrSmall();
			}
		}
		else if (isset($_POST['checkLengthDinner'])){ // Checking text length
			$value = $_POST['valueDate3'];
      $time = $_POST['valueTime3'];
      $dish = $_POST['valueDish3'];
      $drink = $_POST['valueDrink3'];
      $userid =  $_SESSION['userid'];
			if (strlen($value) > 2 && strlen($value) < 30 && strlen($dish) > 2 && strlen($dish) < 30 && strlen($drink) > 2 && strlen($drink) < 30) {
				
				// Create connection
				$conn = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
				// Check connection
				if ($conn->connect_error) {
					die("Connection failed: " . $conn->connect_error);
}

        $sanitizeValue = filter_var($value, FILTER_SANITIZE_STRING);
        $sanitizeTime = filter_var($time, FILTER_SANITIZE_STRING);
        $sanitizeDish = filter_var($dish, FILTER_SANITIZE_STRING);
        $sanitizeDrink = filter_var($drink, FILTER_SANITIZE_STRING);

				$sql = "INSERT INTO dinner (dinnerDate, dinnerTime, dinnerDish, dinnerDrink, userid)
				VALUES ('$sanitizeValue', '$sanitizeTime', '$sanitizeDish', '$sanitizeDrink', '$userid')";

				if ($conn->query($sql) === TRUE) {
          addingConfirmation();
				} else {
				echo "Error: " . $sql . "<br>" . $conn->error;
				}

				$conn->close();
			} else {
				tooBigOrSmall();
			}
		}
		else if (isset($_POST['checkLengthLunch'])){ // Checking text length
			$value = $_POST['valueDate2'];
      $time = $_POST['valueTime2'];
      $dish = $_POST['valueDish2'];
      $drink = $_POST['valueDrink2'];
      $userid =  $_SESSION['userid'];
			if (strlen($value) > 2 && strlen($value) < 30 && strlen($dish) > 2 && strlen($dish) < 30 && strlen($drink) > 2 && strlen($drink) < 30) {
				
				// Create connection
				$conn = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
				// Check connection
				if ($conn->connect_error) {
					die("Connection failed: " . $conn->connect_error);
}

        $sanitizeValue = filter_var($value, FILTER_SANITIZE_STRING);
        $sanitizeTime = filter_var($time, FILTER_SANITIZE_STRING);
        $sanitizeDish = filter_var($dish, FILTER_SANITIZE_STRING);
        $sanitizeDrink = filter_var($drink, FILTER_SANITIZE_STRING);

				$sql = "INSERT INTO lunch (lunchDate, lunchTime, lunchDish, lunchDrink, userid)
				VALUES ('$sanitizeValue', '$sanitizeTime', '$sanitizeDish', '$sanitizeDrink', '$userid')";

				if ($conn->query($sql) === TRUE) {
          addingConfirmation();
				} else {
				echo "Error: " . $sql . "<br>" . $conn->error;
				}

				$conn->close();
			} else {
        tooBigOrSmall();
			}
    }
  }
?>

    <div class="container">
      <div class="row" style="margin-top: 75px; margin-bottom: 75px;">
        <div class="col-sm">
          <h1 style="font-size: 50px;">Input Page</h1>
        </div>
        <div class="col-sm">
        <?php
          // Generate the navigation menu
          if (isset($_SESSION['userid'])) {
            echo '<div class="card" style="width: 22rem; background-color: rgb(250, 251, 252);">';
            echo '<div class="card-body">';
            echo '<h5 class="card-title">Hello, '. $_SESSION['username'] . '!</h5>'; 
            echo '<class="card-text"> Below you can add new meals to your Food Diary. Navigate from above to see your Food Diary pages.<br>';
            echo '<br><button type="button" class="btn btn-primary"><a href="logout.php" style="color: white;">Log Out</a></button></p>';
            echo '</div>';
            echo '</div>';
          }
          else {
            echo '<div class="card" style="width: 15rem; text-align: center; background-color: rgb(250, 251, 252);">';
            echo '<div class="card-body">';
            echo '<h5 class="card-title">Hello visitor!</h5>';
            echo '<p class="card-text"><button type="button" class="btn btn-primary"><a href="login.php" style="color: white;">Log In</a></button> or <button type="button" class="btn btn-primary"><a href="signup.php" style="color: white;">Sign Up</a></button></p>';
            echo '</div>';
            echo '</div>';
          }
        ?>
        </div>
      </div>
    </div>

    <div class="container">
            <div class="row">
              <div class="col-sm">
                <div class="card" style="width: 18rem; margin-bottom: 50px; background-color: rgb(250, 251, 252);" >
                    <div class="card-body">
                      <h5 class="card-title">Breakfast</h5>
                      <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
                        <div class="mb-3">
                            <label for="exampleInputText" class="form-label">Date:</label>
                            <input name="valueDate" class="form-control" type="text" aria-label="default input example">
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputText" class="form-label">Time:</label>
                            <input name="valueTime" class="form-control" type="text" aria-label="default input example">
                        </div>
                        <div class="mb-3">
                          <label for="exampleInputText" class="form-label">Dish:</label>
                          <input name="valueDish" class="form-control" type="text" aria-label="default input example">
                        </div>
                        <div class="mb-3">
                          <label for="exampleInputText" class="form-label">Drink:</label>
                          <input name="valueDrink" class="form-control" type="text" aria-label="default input example">
                        </div>
                        <button type="submit" name="checkLengthBreakfast" class="btn btn-primary">Submit</button>
                      </form>
                    </div>
                  </div>
              </div>
              <div class="col-sm">
                <div class="card" style="width: 18rem; margin-bottom: 50px; background-color: rgb(250, 251, 252);">
                    <div class="card-body">
                      <h5 class="card-title">Lunch</h5>
                      <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
                        <div class="mb-3">
                            <label for="exampleInputText" class="form-label">Date:</label>
                            <input name="valueDate2" class="form-control" type="text" aria-label="default input example">
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputText" class="form-label">Time:</label>
                            <input name="valueTime2" class="form-control" type="text" aria-label="default input example">
                        </div>
                        <div class="mb-3">
                          <label for="exampleInputText" class="form-label">Dish:</label>
                          <input name="valueDish2" class="form-control" type="text" aria-label="default input example">
                        </div>
                        <div class="mb-3">
                          <label for="exampleInputText" class="form-label">Drink:</label>
                          <input name="valueDrink2" class="form-control" type="text" aria-label="default input example">
                        </div>
                        <button name="checkLengthLunch" type="submit" class="btn btn-primary">Submit</button>
                      </form>
                    </div>
                  </div>
              </div>
              <div class="col-sm">
                <div class="card" style="width: 18rem; margin-bottom: 50px; background-color: rgb(250, 251, 252);">
                    <div class="card-body">
                      <h5 class="card-title">Dinner</h5>
                      <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
                        <div class="mb-3">
                            <label for="exampleInputText" class="form-label">Date:</label>
                            <input name="valueDate3" class="form-control" type="text" aria-label="default input example">
                        </div>
                        <div class="mb-3">
                        <div class="mb-3">
                            <label for="exampleInputText" class="form-label">Time:</label>
                            <input name="valueTime3" class="form-control" type="text" aria-label="default input example">
                        </div>
                          <label for="exampleInputText" class="form-label">Dish:</label>
                          <input name="valueDish3" class="form-control" type="text" aria-label="default input example">
                        </div>
                        <div class="mb-3">
                          <label for="exampleInputText" class="form-label">Drink:</label>
                          <input name="valueDrink3" class="form-control" type="text" aria-label="default input example">
                        </div>
                        <button type="submit" name="checkLengthDinner" class="btn btn-primary">Submit</button>
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