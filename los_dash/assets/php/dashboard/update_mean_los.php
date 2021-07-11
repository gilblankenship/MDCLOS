<?php

    /* update_mean_los.php 
    Code to calculate the mean LOS of all the patients */    
    
    $HOST = 'localhost';
    $DATABASE = 'LOSDB';
    $USER = 'bfokin';
    $PASSWORD = 'obSJX=a*Oyk}';
    $mysql = mysqli_connect($HOST,$USER,$PASSWORD,$DATABASE);
   
    //Get the average LOS value from the query
    $query = "SELECT AVG(est_los) AS 'average' FROM estimation_table";
    $set = $mysql->query($query);
    $result = $set->fetch_assoc();
    $avg = $result['average'];
    //Round the value to one decimal and print it
    echo round($avg,1);
?>