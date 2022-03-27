<?php

    $connection = mysqli_connect('localhost','root','','cms2');
    // if($connection){
    //     echo "We are connected";
    // }
    
    function confirm($result){
        if(!$result){
            global $connection;
            die("QUERY FAILED " . mysqli_error($connection));
        }
    }
?>