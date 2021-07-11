<?php

    /* update_num_data.php 
    Update data number of patients analyzed*/

    $HOST = 'localhost';
    $DATABASE = 'LOSDB';
    $USER = 'bfokin';
    $PASSWORD = 'obSJX=a*Oyk}';
    $mysql = mysqli_connect($HOST,$USER,$PASSWORD,$DATABASE);
   
    //Query getting the count of patients with analysed information of the DB
    $query="SELECT COUNT(patient_id) AS 'num' FROM estimation_table";
    $set = $mysql->query($query);
    $result = $set->fetch_assoc();
    $count = $result['num'];
    echo round($count);
?>