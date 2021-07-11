<?php
    
    $HOST = 'localhost';
    $DATABASE = 'LOSDB';
    $USER = 'bfokin';
    $PASSWORD = 'obSJX=a*Oyk}';
    $mysql = mysqli_connect($HOST,$USER,$PASSWORD,$DATABASE);
     
    //Reduction in days calculation
        //Social workers
        $avg_minutes_ot = "SELECT AVG(minutes) FROM procedure_table WHERE `procedure`='occupational_therapy'";
        $set = $mysql->query($avg_minutes_ot);
        $result = $set->fetch_assoc();
        $ot_avg_minutes = ROUND($result['AVG(minutes)'],2);
        
        //physical therapy
        $avg_minutes_pt = "SELECT AVG(minutes) FROM procedure_table WHERE `procedure`='physical_therapy'";
        $set = $mysql->query($avg_minutes_pt);
        $result = $set->fetch_assoc();
        $pt_avg_minutes = ROUND($result['AVG(minutes)'],2);

?>