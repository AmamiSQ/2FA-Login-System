<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Testing</title>
</head>

<body>
    <form action="test.php" method="post">
    Name: <input type="text" name="name"><br>
    Password: <input type="password" name="pass"><br>
    <input type="submit">
    </form>
    <!-- start PHP code -->
    <?php
       error_reporting(E_ERROR | E_PARSE);
       $user = false;
       $pass = false;

       if($_POST['name'] == "testU"){
            $user = true;
       }
       if($_POST['pass'] == "testP"){
            $pass = true;
       }

       switch([$user, $pass]){
            case [true, true]:
                echo "user logged in";
                break;
            case [true, false]:
                echo "password incorrect";
                break;
            case [false, true]:
                echo "username incorrect";
                break;
            default: 
                echo "no such user";
                break;
       }
        
    ?>
   <!-- end PHP code --> 
</body>

</html>