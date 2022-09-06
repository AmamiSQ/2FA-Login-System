<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Testing</title>
</head>
<body>
    <!-- start PHP code -->
    <?php
        function test(){
            $tof = true;
            if($tof){
                echo "function works";
            }
            else{
                echo "FAILURE";
            }
        }
        test();
        
    ?>
   <!-- end PHP code --> 
</body>
</html>