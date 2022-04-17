<?php

    $connection = mysqli_connect('localhost','root','','cms2');

    function confirm($result){
        if(!$result){
            global $connection;
            die("QUERY FAILED " . mysqli_error($connection));
        }
    }
?>