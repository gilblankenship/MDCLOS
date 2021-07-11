<?php

    /*update_technique.php
    This code calculates the average LOS for the two type of techniques. "Open" and "MIS". */
    $HOST = 'localhost';
    $DATABASE = 'LOSDB';
    $USER = 'bfokin';
    $PASSWORD = 'obSJX=a*Oyk}';
    $mysql = mysqli_connect($HOST,$USER,$PASSWORD,$DATABASE);

    //Get the LOS from the Chart Filter selection
    $los = isset($_GET['los']) ? $_GET['los'] : 0;
    
    //OPEN
    $openTec = "SELECT AVG(est_los), COUNT(est_los) FROM estimation_table INNER JOIN statistics_table ON estimation_table.patient_id = statistics_table.patient_id WHERE surgical_technique='Open' AND est_los>='$los'";
    $set = $mysql->query($openTec);
    $result = $set->fetch_assoc();
    $open_technique = ROUND($result['AVG(est_los)']);
    $open_technique_count = ROUND($result['COUNT(est_los)']);
    
    //MIS
    $misTec = "SELECT AVG(est_los), COUNT(est_los) FROM estimation_table INNER JOIN statistics_table ON estimation_table.patient_id = statistics_table.patient_id WHERE surgical_technique='Percutaneous/MIS' AND est_los>='$los'";
    $set = $mysql->query($misTec);
    $result = $set->fetch_assoc();
    $mis_technique = ROUND($result['AVG(est_los)']);
    $mis_technique_count = ROUND($result['COUNT(est_los)']);

    //Store in a Json array the mean LOS per technique and the count    
    echo json_encode (array(array($open_technique, $mis_technique),array('Open ['.$open_technique_count.']'),array('Percutaneous/MIS ['.$mis_technique_count.']')));
?>