<?php
session_start();

    // Include config file
require_once("vendor/autoload.php");
use PragmaRX\Google2FA\Google2FA;
include 'connect.php'; //connect to db

$google2fa = new Google2FA();
$user = $_SESSION["user"];

/* $username = "user1";
$sql1 = "SELECT token FROM users WHERE username = '$username'";
$sql2 = "SELECT id FROM users WHERE username = '$username'";

$uid = mysqli_fetch_array(mysqli_query($link, $sql2)); 
$dbtoken = mysqli_fetch_array(mysqli_query($link, $sql1));

//$qrcode = $google2fa->getQRCodeUrl($uid['id'], $username, $dbtoken['token']); */

//$image_url = 'https://chart.googleapis.com/chart?cht=qr&chs=300x300&chl='.$qrcode;


//check if user already has a token
$sql = "SELECT token FROM users WHERE username = '$user'";
$tokencheck = mysqli_fetch_array(mysqli_query($link, $sql));

if(is_null($tokencheck['token'])){
    echo "user has no token";
}
else{
    echo "user already has 2fa enabled";
}
exit;

echo '<img src="'.$_SESSION["image_url"].'" />';
echo '<h2>Enter Token: </h2><br>';

if(!is_null($_POST['verify'])){
    if($google2fa->verifyKey($_SESSION["dbtoken"], $_POST['verify'])){
        
        session_destroy();
        session_start();
        // Store data in session variables
        $_SESSION["loggedin"] = true;
        $_SESSION["username"] = $user;                            
        
        // Redirect user to welcome page
        header("location: welcome.php");
    }
    else{
        echo "<br>incorrect<br>";
    }
}

?>
<form action="tfa.php" method="post">
        <input type="text" name="verify">
        <input type="submit">
</form>