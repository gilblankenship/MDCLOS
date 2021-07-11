<?php

    $HOST = 'localhost';
    $DATABASE = 'LOSDB';
    $USER = 'bfokin';
    $PASSWORD = 'obSJX=a*Oyk}';
    $mysql = mysqli_connect($HOST,$USER,$PASSWORD,$DATABASE);
    
    $id = $_GET['id'];
    
    $query = "SELECT * FROM estimation_table WHERE patient_id = '$id' AND exit_date IS NOT NULL
                    ";
    $result = mysqli_query($mysql, $query);
    $row = mysqli_fetch_array($result);
    
    // patient has not been discharged
    if ($row == NULL) {
        echo 0;
    }
    
    // patient has been discharged
    else {
        echo 1;
    }