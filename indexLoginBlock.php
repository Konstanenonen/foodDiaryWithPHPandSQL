<?php
// Generating the navigation menu. This section will be shown when the user is logged in
if (isset($_SESSION['userid'])) {
    echo '<div class="card" style="width: 22rem; background-color: rgb(250, 251, 252);">';
    echo '<div class="card-body">';
    echo '<h5 class="card-title">Hello, '. $_SESSION['username'] . '!</h5>'; 
    echo '<p class="card-text"> Below you can add new meals to your Food Diary. From above you can view your Diary pages.<br>';
    echo '<br><a href="logout.php" class="btn btn-primary" style="color: white;">Log Out</a></p>';
    echo '</div>';
    echo '</div>';
}
// This section will be shown when the user isn't logged in
else {
    echo '<div class="card" style="width: 15rem; text-align: center; background-color: rgb(250, 251, 252);">';
    echo '<div class="card-body">';
    echo '<h5 class="card-title">Hello visitor!</h5>';
    echo '<p class="card-text"><button type="button" class="btn btn-primary"><a href="login.php" style="color: white;">Log In</a></button> or <button type="button" class="btn btn-primary"><a href="signup.php" style="color: white;">Sign Up</a></button></p>';
    echo '</div>';
    echo '</div>';
}
?>