<!DOCTYPE html>
<html>
    <head>
        <title>Sign Up</title>
        <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
    </head>

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
        <h1>Sign Up</h1>
<?php
/* This php block will only be executed after the user submits the signup data
 by clicking the sign-up button
*/
session_start();
require_once('dbinfo.php');

  // Connect to the database
  $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

  if (isset($_POST['signing-up'])) {
    // Get the signup data from the POST
    $username = mysqli_real_escape_string($dbc, trim($_POST['username'])); //mysqli_real_escape_string is used to enhance security
    $password1 = mysqli_real_escape_string($dbc, trim($_POST['password1']));
    $password2 = mysqli_real_escape_string($dbc, trim($_POST['password2']));
    $city = mysqli_real_escape_string($dbc, trim($_POST['city']));

    if (!empty($username) && !empty($password1) && !empty($password2) && !empty($city) && ($password1 == $password2)) {
      // Check that the provided username does not yet exist in the database
      $query = "SELECT * FROM customer WHERE username = '$username'";
      $data = mysqli_query($dbc, $query);
      if (mysqli_num_rows($data) == 0) {
        // The username does not exist yet, so insert the data into the database.
      	// No need to add userid, because teh userid is configured with AUTO-INCREMENT in the table. MySQL will automatically generate the userid
        // SHA is used to encrypt the password
      	$query = "INSERT INTO customer (username, password, city) VALUES ('$username', SHA('$password1'), '$city')"; 
        mysqli_query($dbc, $query);
        
        // Get the userid of the just created account
        $query = "SELECT userid FROM customer WHERE username = '$username'";
        $data = mysqli_query($dbc, $query);
        $row = mysqli_fetch_array($data);
        
        // Set the session variables to hold the userid, username, and city of the just created account. Set also the cookies.
        $_SESSION['userid'] = $row['userid'];
        $_SESSION['username'] = $username;
        $_SESSION['city'] = $city;
        setcookie('userid', $row['userid'], time() + (60 * 60 * 24 * 30));    // expires in 30 days
        setcookie('username', $username, time() + (60 * 60 * 24 * 30));  // expires in 30 days     
        setcookie('city', $city, time() + (60 * 60 * 24 * 30));  // expires in 30 days
        
        mysqli_close($dbc);
                
        // Confirm success with the user
        echo 'Thanks for signing up, '. $username .'!</br>';
        echo '<p>Your new account has been successfully created. <a href="index.php">Go back to the homepage</a>.</p>';
        
        // echo '<p>Your new account has been successfully created. You\'re now ready to <a href="login.php">log in</a>.</p>';
            
        // mysqli_close($dbc);
        exit();
      }
      else {
        // An account already exists for this username, so display an error message
        echo 'An account already exists for this username. Please use a different address.';
        $username = "";
      }
    }
    else {
      echo 'You must enter all of the sign-up data, including the desired password twice.';
    }
  }

  mysqli_close($dbc);
?>

        <p>Provide a username and password to sign up.</p>
        <form action='signup.php' method='post'>
            Enter your username:<br>
            <input type='text' name='username'>
            <br><br>

            In which city were you born?:<br>
            <input type='text' name='city'>
            <br><br>

            Enter a password:<br>
            <input type='password' name='password1'>
            <br><br>

            Retype the password:<br>
            <input type='password' name='password2'>
            <br><br>

            <input type='submit' value='Sign Up' name='signing-up'>
        </form>

    
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
