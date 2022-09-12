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
       require_once("vendor/autoload.php");
       use RobThree\Auth\TwoFactorAuth;
       include 'connect.php'; //connect to db
       error_reporting(E_ERROR | E_PARSE); //don't print warnings to the screen


       function login(){
        $user = false;
        $pass = false;

        $tfa = new TwoFactorAuth();
        $secret = $tfa->createSecret();

        //check if given username and password are correct
        if($_POST['name'] == "testU"){
                $user = true;
        }
        if($_POST['pass'] == "testP"){
                $pass = true;
        }

        switch([$user, $pass]){
                case [true, true]:?>
                    <img src="<?php echo $tfa->getQRCodeImageAsDataUri('Testing', $secret);?>"><br>
                    <?php break;
                case [true, false]:
                    echo "password incorrect";
                    break;
                default: 
                    echo "no such user";
                    break;
                    

        }
       };

       login();

       $sql = 'SELECT * FROM test_sql';
       $result = mysqli_query($conn, $sql);
       //print_r(mysqli_fetch_all($result, MYSQLI_ASSOC));
       mysqli_free_result($result);
       mysqli_close($conn);
    ?>
   <!-- end PHP code --> 
</body>

</html>