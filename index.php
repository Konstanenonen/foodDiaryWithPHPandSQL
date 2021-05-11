
<?php

session_start();

  /* If the session data does not exist (i.e we are starting a new session), try to set the session's data with 
     the cookies that were saved when the user made his/her last login (i.e: the cookies that the client browser is sending in its HTTP GET request to this index.php script)
     This is the code that allows the app to remember the user that last logged in to the app (in the browser/computer that's issuing the HTTP GET request) and left the app without logging out 
  */
  if (!isset($_SESSION['userid'])) {
    if (isset($_COOKIE['userid']) && isset($_COOKIE['username'])) {
      $_SESSION['userid'] = $_COOKIE['userid'];
      $_SESSION['username'] = $_COOKIE['username'];
      // Using city here is for demonstration purposes. In real applications, you should not save personal data in cookies
      $_SESSION['city'] = $_COOKIE['city']; 
    }
  }

if ($_SERVER['REQUEST_METHOD'] == 'POST')
	{
		if (isset($_POST['checkInteger'])) { // Check if an input value is an integer
			$value = $_POST['valueDate'];
			$dish = $_POST['valueDish'];
			$drink = $_POST['valueDrink'];
			if (filter_var($value, FILTER_VALIDATE_INT) == true) {
				
				$servername = "localhost";
				$username = "root";
				$password = "";
				$dbname = "testdb";
				
				// Create connection
				$conn = new mysqli($servername, $username, $password, $dbname);
				// Check connection
				if ($conn->connect_error) {
					die("Connection failed: " . $conn->connect_error);
}

				$sql = "INSERT INTO customer (ID, fName, lName)
				VALUES ('$value', '$dish', '$drink')";

				if ($conn->query($sql) === TRUE) {
				echo "New record created successfully";
				} else {
				echo "Error: " . $sql . "<br>" . $conn->error;
				}

				$conn->close();
			} else {
				$msg = "The input value ".$value." is NOT an integer";
			}
		}
		else if (isset($_POST['checkLength'])){ // Checking text length
			$value = $_POST['valueDate3'];
      $dish = $_POST['valueDish3'];
      $drink = $_POST['valueDrink3'];
			if (strlen($value)<=20) {
				$msg = "The input value '".$value."' does not exceed the max length";
				$servername = "localhost";
				$username = "root";
				$password = "";
				$dbname = "testdb";
				
				// Create connection
				$conn = new mysqli($servername, $username, $password, $dbname);
				// Check connection
				if ($conn->connect_error) {
					die("Connection failed: " . $conn->connect_error);
}

				$sql = "INSERT INTO dinner (date, dish, drink)
				VALUES ('$value', '$dish', '$drink')";

				if ($conn->query($sql) === TRUE) {
				echo "New record created successfully";
				} else {
				echo "Error: " . $sql . "<br>" . $conn->error;
				}

				$conn->close();
			} else {
				$msg = "The input value '".$value."' EXCEEDS the maximum allowed length of 5 chars";
			}
		}
		else if (isset($_POST['checkLength2'])){ // Checking text length
			$value = $_POST['valueDate2'];
      $dish = $_POST['valueDish2'];
      $drink = $_POST['valueDrink2'];
			if (strlen($value)<=20) {
				$msg = "The input value '".$value."' does not exceed the max length";
				$servername = "localhost";
				$username = "root";
				$password = "";
				$dbname = "testdb";
				
				// Create connection
				$conn = new mysqli($servername, $username, $password, $dbname);
				// Check connection
				if ($conn->connect_error) {
					die("Connection failed: " . $conn->connect_error);
}

				$sql = "INSERT INTO lunch (keyDate, lunchDish, lunchDrink)
				VALUES ('$value', '$dish', '$drink')";

				if ($conn->query($sql) === TRUE) {
				echo "New record created successfully";
				} else {
				echo "Error: " . $sql . "<br>" . $conn->error;
				}

				$conn->close();
			} else {
				$msg = "The input value '".$value."' EXCEEDS the maximum allowed length of 5 chars";
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

    <div class="container">
      <div class="row" style="margin-top: 75px; margin-bottom: 75px;">
        <div class="col-sm-4">
          <h1 style="font-size: 50px;">Input Page</h1>
        </div>
        <div class="col-sm-4">
        <?php
 // Generate the navigation menu
 if (isset($_SESSION['userid'])) {
   echo '<div class="card" style="width: 25rem;">';
   echo '<div class="card-body">';
   echo '<h5 class="card-title">Hello, '. $_SESSION['username'] . '!</h5>'; 
   echo '<br class="card-text">Here is the proof that I remember you:<br>';
   echo 'You were born in ' . $_SESSION['city'] . '!</br>';
   echo '<a href="logout.php">Log Out</a></p>';
   echo '</div>';
   echo '</div>';
 }
 else {
   echo '<div class="card">';
   echo '<div class="card-body">';
   echo '<h5 class="card-title">Hello! from below you can:</h5>';
   echo '<p class="card-text"><a href="login.php">Log In</a> or if you are a new user <a href="signup.php">Sign Up</a></p>';
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
                <div class="card" style="width: 18rem; margin-bottom: 50px;">
                    <div class="card-body">
                      <h5 class="card-title">Breakfast</h5>
                      <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
                        <div class="mb-3">
                            <label for="exampleInputText" class="form-label">Date</label>
                            <input name="valueDate" class="form-control" type="text" aria-label="default input example">
                        </div>
                        <div class="mb-3">
                          <label for="exampleInputText" class="form-label">Dish</label>
                          <input name="valueDish" class="form-control" type="text" aria-label="default input example">
                        </div>
                        <div class="mb-3">
                          <label for="exampleInputText" class="form-label">Drink</label>
                          <input name="valueDrink" class="form-control" type="text" aria-label="default input example">
                        </div>
                        <button type="submit" name="checkInteger" class="btn btn-primary">Submit</button>
                      </form>
                    </div>
                  </div>
              </div>
              <div class="col-sm">
                <div class="card" style="width: 18rem; margin-bottom: 50px;">
                    <div class="card-body">
                      <h5 class="card-title">Lunch</h5>
                      <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
                        <div class="mb-3">
                            <label for="exampleInputText" class="form-label">Date</label>
                            <input name="valueDate2" class="form-control" type="text" aria-label="default input example">
                        </div>
                        <div class="mb-3">
                          <label for="exampleInputText" class="form-label">Dish</label>
                          <input name="valueDish2" class="form-control" type="text" aria-label="default input example">
                        </div>
                        <div class="mb-3">
                          <label for="exampleInputText" class="form-label">Drink</label>
                          <input name="valueDrink2" class="form-control" type="text" aria-label="default input example">
                        </div>
                        <button name="checkLength2" type="submit" class="btn btn-primary">Submit</button>
                      </form>
                    </div>
                  </div>
              </div>
              <div class="col-sm">
                <div class="card" style="width: 18rem; margin-bottom: 50px;">
                    <div class="card-body">
                      <h5 class="card-title">Dinner</h5>
                      <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
                        <div class="mb-3">
                            <label for="exampleInputText" class="form-label">Date</label>
                            <input name="valueDate3" class="form-control" type="text" aria-label="default input example">
                        </div>
                        <div class="mb-3">
                          <label for="exampleInputText" class="form-label">Dish</label>
                          <input name="valueDish3" class="form-control" type="text" aria-label="default input example">
                        </div>
                        <div class="mb-3">
                          <label for="exampleInputText" class="form-label">Drink</label>
                          <input name="valueDrink3" class="form-control" type="text" aria-label="default input example">
                        </div>
                        <button type="submit" name="checkLength" class="btn btn-primary">Submit</button>
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