<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Testing</title>
</head>

<body>
    <!-- HTML for text boxes and submit buttons -->
    <form action="test.php" method="post">
    Name: <input type="text" name="name"><br>
    Password: <input type="password" name="pass"><br>
    <input type="submit">
    </form>

    <!-- start PHP code -->
    <?php
       require_once("vendor/autoload.php"); //load in packages
       use RobThree\Auth\TwoFactorAuth;
       error_reporting(E_ERROR | E_PARSE); //don't print warnings to the screen
       
       $tfa = new TwoFactorAuth();
       $secret = $tfa->createSecret();
    ?>

    <img src="<?php echo $tfa->getQRCodeImageAsDataUri('Testing', $secret);?>"><br>

    <?php
        $code = $tfa->getCode($secret);
    ?>
   <!-- end PHP code --> 
</body>

</html>