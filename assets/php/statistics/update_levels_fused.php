<?php
    /*update_morphology.php 
    Get the average LOS and count of patients wuth a certain fracture morphology.*/
    
    $HOST = 'localhost';
    $DATABASE = 'LOSDB';
    $USER = 'bfokin';
    $PASSWORD = 'obSJX=a*Oyk}';
    $mysql = mysqli_connect($HOST,$USER,$PASSWORD,$DATABASE);

    //los from the slide selector
    $los = isset($_GET['los']) ? $_GET['los'] : 0;

    //queries             
    $between1and2 = "SELECT AVG(est_los), COUNT(est_los) FROM estimation_table INNER JOIN statistics_table ON estimation_table.patient_id = statistics_table.patient_id WHERE levels_fused>=1 AND levels_fused<=2";
    $set = $mysql->query($between1and2);
    $result = $set->fetch_assoc();
    $first_level_avg = ROUND($result['AVG(est_los)']);
    $first_level_count = ROUND($result['COUNT(est_los)']);
    
    $between3and6 = "SELECT AVG(est_los), COUNT(est_los) FROM estimation_table INNER JOIN statistics_table ON estimation_table.patient_id = statistics_table.patient_id WHERE levels_fused>=3 AND levels_fused<=6";
    $set = $mysql->query($between3and6);
    $result = $set->fetch_assoc();
    $second_level_avg = ROUND($result['AVG(est_los)']);
    $second_level_count = ROUND($result['COUNT(est_los)']);
    
    $between7and12 = "SELECT AVG(est_los), COUNT(est_los) FROM estimation_table INNER JOIN statistics_table ON estimation_table.patient_id = statistics_table.patient_id WHERE levels_fused>=7 AND levels_fused<=12";
    $set = $mysql->query($between7and12);
    $result = $set->fetch_assoc();
    $third_level_avg = ROUND($result['AVG(est_los)']);
    $third_level_count = ROUND($result['COUNT(est_los)']);
    
    $higherthan12 = "SELECT AVG(est_los), COUNT(est_los) FROM estimation_table INNER JOIN statistics_table ON estimation_table.patient_id = statistics_table.patient_id WHERE levels_fused>12";
    $set = $mysql->query($higherthan12);
    $result = $set->fetch_assoc();
    $forth_level_avg = ROUND($result['AVG(est_los)']);
    $forth_level_count = ROUND($result['COUNT(est_los)']);
    
    //array format (array of estimatedLOS, array of counts)
    echo json_encode (array(array($first_level_avg,$second_level_avg,$third_level_avg,$forth_level_avg),array('1 - 2 ['.$first_level_count.']'),array('3 - 6 ['.$second_level_count.']'),array('7 - 12 ['.$third_level_count.']'),array('>12 ['.$forth_level_count.']')));
?>