<?php
    $server = "localhost";
    $user = "root";
    $pass = "ilovemyself4";
    $dbname = "test_base";
    
    
    $link = mysqli_connect($server, $user, $pass, $dbname);
    if(!$link){
        echo "error: " . mysqli_connect_error();
    }
?>