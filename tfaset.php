<?php
    session_start();

    // Include config file
    require_once("vendor/autoload.php");
    use PragmaRX\Google2FA\Google2FA;
    include 'connect.php'; //connect to db

    $google2fa = new Google2FA();

    $username = $_SESSION["username"];
    $secret = $_SESSION["secret"];

    $sql = "SELECT id FROM users WHERE username = '$username'";
    $sql2 = "SELECT token FROM users WHERE username = '$username'";

    $uid = mysqli_fetch_array(mysqli_query($link, $sql));
    $dbtoken = mysqli_fetch_array(mysqli_query($link, $sql2));

    if(!is_null($dbtoken['token'])){
        ?>
        <h2> 2FA is already enabled</h2>
        <?php
    }
    else{
        $qrcode = $google2fa->getQRCodeUrl($uid['id'], $username, $secret);
        $image_url = 'https://chart.googleapis.com/chart?cht=qr&chs=300x300&chl='.$qrcode;

        echo '<img src="'.$image_url.'" />';
        echo '<h2>Enter Token: </h2><br>';

        if(!is_null($_POST['verified'])){
            if($google2fa->verifyKey($secret, $_POST['verified'])){
                
                $sql = "UPDATE users
                SET token = '$secret'
                WHERE username = '$username'";

                mysqli_query($link, $sql);

                header("welcome.php");
            }
            else{
                echo "<br>incorrect token, try again<br>";
            }
        }?>

        <form action="tfaset.php" method="post">
            <input type="text" name="verified">
            <input type="submit">
        </form><?php
        
    }

    


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Welcome</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body{ font: 14px sans-serif; text-align: center; }
    </style>
</head>
<body>
    <!-- <form action="tfaset.php" method="post">
        <input type="text" name="verified">
        <input type="submit">
    </form> -->
    <p>
        <a href="welcome.php" class="btn btn-warning">Back to previous page</a>
        <a href="logout.php" class="btn btn-danger ml-3">Sign Out of Your Account</a>
    </p>
</body>
</html>