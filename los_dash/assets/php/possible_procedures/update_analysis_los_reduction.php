<?php

/* update_analysis_los_reduction.php 
    Used in 'Analysis of procedures by LOS reduction'. Calculates the Reduction in days per method. */
    
    $HOST = 'localhost';
    $DATABASE = 'LOSDB';
    $USER = 'bfokin';
    $PASSWORD = 'obSJX=a*Oyk}';
    $mysql = mysqli_connect($HOST,$USER,$PASSWORD,$DATABASE);
     
    //Reduction in days calculation
        //Social workers
        $avg_days_sw = "SELECT AVG(reduction_days) FROM procedure_table WHERE `procedure`='occupational_therapy'";
        $set = $mysql->query($avg_days_sw);
        $result = $set->fetch_assoc();
        $sw_avg_reduction_days = ROUND($result['AVG(reduction_days)'],2);
        
        //physical therapy
        $avg_days_pt = "SELECT AVG(reduction_days) FROM procedure_table WHERE `procedure`='physical_therapy'";
        $set = $mysql->query($avg_days_pt);
        $result = $set->fetch_assoc();
        $pt_avg_reduction_days = ROUND($result['AVG(reduction_days)'],2);
    
    echo json_encode (array(array($sw_avg_reduction_days),array($pt_avg_reduction_days)));

?>