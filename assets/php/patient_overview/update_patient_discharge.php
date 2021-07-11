<?php
    $HOST = 'localhost';
    $DATABASE = 'LOSDB';
    $USER = 'bfokin';
    $PASSWORD = 'obSJX=a*Oyk}';
    $mysql = mysqli_connect($HOST,$USER,$PASSWORD,$DATABASE);

    
    $id = $_GET['id'];
    
    
    $query = "UPDATE estimator_table SET exit_date = CURRENT_DATE() WHERE patient_id = '$id'";
    
    mysqli_query($mysql, $query);
?>