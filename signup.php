<!DOCTYPE html>
<html>
    <head>

        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- Bootstrap CSS -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">

        <title>Sign Up</title>
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

        <div class="container" style="margin-top: 5%">
          <div class="row">
            <div class="col-sm">
              <h1>Sign Up</h1>
            </div>
          </div>
<?php
//This php block will be executed when the Sing Up button is pressed
session_start();
//Requiring this php file to get connection to the database later
require_once('dbinfo.php');

  // Connect to the database
  $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

  if (isset($_POST['signing-up'])) {
    // Get the signup data from the form
    $username = mysqli_real_escape_string($dbc, trim($_POST['username'])); //mysqli_real_escape_string is used to enhance security
    $password1 = mysqli_real_escape_string($dbc, trim($_POST['password1']));
    $password2 = mysqli_real_escape_string($dbc, trim($_POST['password2']));

    if (!empty($username) && !empty($password1) && !empty($password2) && ($password1 == $password2)) {  

      // Checking that the provided username does not yet exist in the database
      $query = "SELECT * FROM users WHERE username = '$username'";
      $data = mysqli_query($dbc, $query);
      if (mysqli_num_rows($data) == 0) {
        // The username is new, so we can insert the data into the database.
      	// No need to add userid, because the userid is configured with AUTO-INCREMENT in the table and mysql will automatically generate the userid
        // SHA is used to encrypt the password with one-way hashing
      	$query = "INSERT INTO users (username, password) VALUES ('$username', SHA('$password1'))"; 
        mysqli_query($dbc, $query);
        
        // Getting the userid of the newly created account
        $query = "SELECT userid FROM users WHERE username = '$username'";
        $data = mysqli_query($dbc, $query);
        $row = mysqli_fetch_array($data);
        
        // Setting the session variables to hold the userid and username of the newly created account. Also setting the cookies.
        $_SESSION['userid'] = $row['userid'];
        $_SESSION['username'] = $username;
        setcookie('userid', $row['userid'], time() + (60 * 60 * 24 * 60));    // expires in 60 days
        setcookie('username', $username, time() + (60 * 60 * 24 * 60));  // expires in 60 days     
        
        mysqli_close($dbc);
                
        // Confirming success with the user
        echo '<div class="card" style="width: 18rem; background-color: rgb(250, 251, 252);"><div class="card-body"><h5 class="card-title">Thanks for signing up, '. $username .'!</h5>';
        echo '<p class="card-text">Your new account has been successfully created.</p>';
        echo '<a href="index.php" class="btn btn-primary">Back to Input Page</a></div>';
        
            
        exit();
      }
      else {
        // Displaying error message when user is trying to make an account with already existing username
        echo '<p style="color: red;">An account already exists for this username. Please use a different address.</p>';
        $username = "";
      }
    }
    // User input error handling.
    else {
      echo '<p style="color: red;">You must enter all of the sign-up data, including the desired password twice.</p>';
    }
  }

  mysqli_close($dbc);
?>
    <div class="row">
      <div class="col-sm">
        <form action='signup.php' method='post'>
          <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Enter your username:</label>
            <input type="text" name="username" class="form-control" id="username" aria-describedby="username" autocomplete="new-username" style="width: 300px;">
        </div>
        <div div class="mb-3">
          <label for="exampleInputPassword1" class="form-label">Enter a password:</label>
          <input type="password" name='password1' autocomplete="new-password" class="form-control" id="password1" style="width: 300px;">
        </div>
        <div div class="mb-3">
          <label for="exampleInputPassword1" class="form-label">Retype the password:</label>
          <input type="password" name='password2' autocomplete="new-password-again" class="form-control" id="password2" style="width: 300px;">
        </div>
        <button type="submit" name='signing-up' class="btn btn-primary">Sign Up</button>
      </form>
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
