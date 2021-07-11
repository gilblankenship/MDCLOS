<?php
    // this fetch file simply grabs all of the patients and prepares select 
    // options for each of them

    $HOST = 'localhost';   
    $DATABASE = 'LOSDB';
    $USER = 'bfokin';
    $PASSWORD = 'obSJX=a*Oyk}';
    
    $mysql = mysqli_connect($HOST,$USER,$PASSWORD,$DATABASE);
    
    $query = "select distinct last_name, first_name, patient_id from patient_table";
    $set = $mysql->query($query);
    
    while ($row = $set->fetch_assoc()) {
        $patient_id = $row['patient_id'];
        
        $last_name = $row['last_name'];
        $first_name = $row['first_name'];
        
        echo "<option value='$patient_id'>$last_name, $first_name</option>";
    }
?>