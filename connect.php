<?php
    $servername = "localhost";
    $username = "root";
    $password = "ilovemyself4";
    $dbname = "test_base";
    
    
    $conn = mysqli_connect($servername, $username, $password, $dbname);
    if(!$conn){
        echo "error: " . mysqli_connect_error();
    }
?>