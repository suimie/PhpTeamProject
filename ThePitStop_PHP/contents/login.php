

<?php
/**
 * login.php
 * 
 * content for the login page
 * 
 * @version 1.0 2018-04-19
 * @package The Food Pit Stop
 * @copyright (c) 2018, Anita Mirshahi, Suim Park, Valini Rangasamy
 * @license 
 * @since Release 1.0
 */
?>

<?php
//Start the Session
//session_start();
//include_once 'database.php';
$host = "localhost"; // Host name 
$username = "root"; // Mysql username 
$password = "root"; // Mysql password 
$db_name = "pitstop"; // Database name 
$tbl_name = "users"; // Table name 
 $fmsg="";
$mysqli = new mysqli("$host", "$username", "$password", "$db_name");
//3. If the form is submitted or not.
//3.1 If the form is submitted
if (isset($_POST['email']) and isset($_POST['password'])) {
//3.1.1 Assigning posted values to variables.
//$myusername = $_POST['email'];
    $mypassword = test_input($_POST['password']);
    //$os = test_input($_POST["os"]);
    //$mypassword = stripslashes($mypassword);

//$password = md5($_POST['password']);


    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $myusername = $email;
    }


//3.1.2 Checking the values are existing in the database or not
//$query = "SELECT * FROM `users` WHERE email='$myusername' and password='$mypassword'";
//$result = mysqli_query($connection, $query) or die(mysqli_error($connection));
    $result = $mysqli->query("SELECT * FROM users WHERE email='$myusername' and password='$mypassword'");
    $count = mysqli_num_rows($result);
//3.1.2 If the posted values are equal to the database values, then session will be created for the user.
    if ($count == 1) {
        $_SESSION['username'] = $myusername;
    } else {
//3.1.3 If the login credentials doesn't match, he will be shown with an error message.
        $fmsg = "Invalid Login Credentials.";
    }
}


//3.1.4 if the user is logged in Greets the user with message
if (isset($_SESSION['username'])) {
    $username = $_SESSION['username'];
    echo "Hi " . $username . "
";
    echo "This is the Members Area
";
    echo "<a href='logout.php'>Logout</a>";
    header("location:userProfile.php");
} else {
//3.2 When the user visits the page first time, simple login form will be displayed.
}
?>

<main class="page login-page">
    <section class="clean-block clean-form dark" style="background-color:rgba(184,156,132,0.28);">
        <div class="container">
            <div class="block-heading" style="margin-top:-38px;">
                <h1 style="color:#608e3a;">Log in</h1>
                <p>Please log in with your username and password.</p>
                <p> <?php echo $fmsg ?> </p>
            </div>
            <form style="border-top:2px solid #608e3a" method = "post"  action="login.php">
                <div class="form-group"><label for="email">Email</label><input class="form-control item" type="text" placeholder="example@domain.com"  id="email" name="email" required></div>
                <div class="form-group"><label for="password">Password</label><input class="form-control" type="password" id="password" name="password" required></div>
                <div class="form-group">
                    <div class="form-check"><input class="form-check-input" type="checkbox" id="checkbox"><label class="form-check-label" for="checkbox">Remember me</label></div>
                    <div style="text-align:right;"><a href="index.php?content=registration">Create new account</a></div>
                </div><button class="btn btn-primary btn-block" type="submit" name="submit" style="background-color:#608e3a;">Log In</button></form>
        </div>
    </section>
</main>