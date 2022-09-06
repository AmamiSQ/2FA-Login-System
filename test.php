<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Testing</title>
</head>
<body>
    <?php
        $array = [1, 2, 3];
        $sum = 0;
        foreach($array as $variable){
            $sum = $sum + $variable;
        }
        echo $sum;
        
    ?>
</body>
</html>