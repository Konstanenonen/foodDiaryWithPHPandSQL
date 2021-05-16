<!DOCTYPE html>

<html>

<head>
    
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">


    <title>Login</title>

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

    <?php
  // Requiring dbinfo.php to get connection to the database later
  require_once('dbinfo.php');

  // Starting a session
  session_start();

  // Clearing the error message
  $error_msg = "";

  // If the user isn't logged in, try to log him/her in
  if (!isset($_SESSION['userid'])) 
  {
    if (isset($_POST['loging-in'])) {
      // Connect to the database
      $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

      // Grabbing the user-entered log-in data
      $username = mysqli_real_escape_string($dbc, trim($_POST['username']));
      $password = mysqli_real_escape_string($dbc, trim($_POST['password']));

      if (!empty($username) && !empty($password)) {
        // Fetching the userid, username and password from the database
        $query = "SELECT userid, username FROM users WHERE username = '$username' AND password = SHA('$password')";
        $data = mysqli_query($dbc, $query);

        if (mysqli_num_rows($data) == 1) {
          // This executes when login is OK. Setting the userid and username session variables. Setting the cookies. Redirecting to the input page
          $row = mysqli_fetch_array($data);
          
          $_SESSION['userid'] = $row['userid'];
          $_SESSION['username'] = $row['username'];
          
          setcookie('userid', $row['userid'], time() + (60 * 60 * 24 * 60));    // expires in 60 days
          setcookie('username', $row['username'], time() + (60 * 60 * 24 * 60));  // expires in 60 days
          
          // This directs the user back to the input page
          $input_url = 'http://' . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']) . '/index.php';
          header('Location: ' . $input_url);
        }
        else {
          // When the username or password are incorrect this error message is shown
          $error_msg = '<p style="text-align: center; color: red;"><strong>Sorry, the username/password you entered is not correct. Try again!</strong></p>';
        }
      }
      else {
        // When username/password aren't entered this error message is shown
        $error_msg = '<p style="text-align: center; color: red;"><strong>Sorry, you must enter your username and password to log in. Try again!</strong></p>';
      }
    }
  }
  // If the session data is empty, show any error message and the log-in form; otherwise confirm the log-in
  if (empty($_SESSION['userid'])) {
    echo '<p class="error style="text-align: center; color: red;"><trong>' . $error_msg . '</strong></p>';
  }
?>

<body>
  <div class="container" style="margin-top: 5%;">
    <div class="row">
      <h1>Login</h1>
    </div>
    <div class="row">
      <div class="col-sm">
        <form method="post" action="login.php">
          <div class="mb-3" style="width: 300px;">
            <label for="exampleInputEmail1" class="form-label">User Name</label>
            <input type="text" class="form-control" id="username" aria-describedby="username" name="username">
          </div>
          <div class="mb-3" style="width: 300px;">
            <label for="exampleInputPassword1" class="form-label">Password</label>
            <input type="password" class="form-control" id="exampleInputPassword1" name="password">
          </div>
          <button type="submit" class="btn btn-primary" name="loging-in">Log In</button>
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
