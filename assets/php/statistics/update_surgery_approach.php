<?php

    /* update_surgery_approach.php
    LOS analysis of the different types of LOS approaches [Posterior, Anterior, Combined] */
    
    $HOST = 'localhost';
    $DATABASE = 'LOSDB';
    $USER = 'bfokin';
    $PASSWORD = 'obSJX=a*Oyk}';
    $mysql = mysqli_connect($HOST,$USER,$PASSWORD,$DATABASE);
    
    //Get the LOS from the Chart Filters tool
    $los = isset($_GET['los']) ? $_GET['los'] : 0;

    //Get the average est_los and the count of patients with a certain approach:
    //POSTERIOR
    $Posterior = "SELECT AVG(est_los),COUNT(est_los) FROM estimation_table INNER JOIN statistics_table ON estimation_table.patient_id = statistics_table.patient_id WHERE surgical_approach='Posterior' AND est_los>='$los'";
    $set = $mysql->query($Posterior);
    $result = $set->fetch_assoc();
    $Post = ROUND($result['AVG(est_los)']);
    $Post_count = ROUND($result['COUNT(est_los)']);
    //ANTERIOR
    $Anterior = "SELECT AVG(est_los),COUNT(est_los) FROM estimation_table INNER JOIN statistics_table ON estimation_table.patient_id = statistics_table.patient_id WHERE surgical_approach='Anterior' AND est_los>='$los'";
    $set = $mysql->query($Anterior);
    $result = $set->fetch_assoc();
    $Ant = ROUND($result['AVG(est_los)']);
    $Ant_count = ROUND($result['COUNT(est_los)']);
    //COMBINED
    $Combined = "SELECT AVG(est_los),COUNT(est_los) FROM estimation_table INNER JOIN statistics_table ON estimation_table.patient_id = statistics_table.patient_id WHERE surgical_approach='Combined' AND est_los>='$los'";
    $set = $mysql->query($Combined);
    $result = $set->fetch_assoc();
    $Comb = ROUND($result['AVG(est_los)']);
    $Comb_count = ROUND($result['COUNT(est_los)']);
    
    
    echo json_encode (array(array($Post,$Ant,$Comb),array('Posterior ['.$Post_count.']'),array('Anterior ['.$Ant_count.']'),array('Combined ['.$Comb_count.']')));
?>