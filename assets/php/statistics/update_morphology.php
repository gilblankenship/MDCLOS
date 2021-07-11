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
    $FractureDislocation = "SELECT AVG(est_los), COUNT(est_los) FROM estimation_table INNER JOIN statistics_table ON estimation_table.patient_id = statistics_table.patient_id WHERE morphology='Fracture-Dislocation' AND est_los>='$los'";
    $set = $mysql->query($FractureDislocation);
    $result = $set->fetch_assoc();
    $FractDis = ROUND($result['AVG(est_los)']);
    $FractDisloCount = ROUND($result['COUNT(est_los)']);
    
    $FlexionDistraction = "SELECT AVG(est_los), COUNT(est_los) FROM estimation_table INNER JOIN statistics_table ON estimation_table.patient_id = statistics_table.patient_id WHERE morphology='Flexion-Distraction' AND est_los>='$los'";
    $set = $mysql->query($FlexionDistraction);
    $result = $set->fetch_assoc();
    $FlexionDis = ROUND($result['AVG(est_los)']);
    $FlexionDisCount = ROUND($result['COUNT(est_los)']);
    
    $Combination = "SELECT AVG(est_los), COUNT(est_los) FROM estimation_table INNER JOIN statistics_table ON estimation_table.patient_id = statistics_table.patient_id WHERE morphology='Combination >1' AND est_los>='$los'";
    $set = $mysql->query($Combination);
    $result = $set->fetch_assoc();
    $Comb = ROUND($result['AVG(est_los)']);
    $CombCount = ROUND($result['COUNT(est_los)']);
    
    $ExtDistraction = "SELECT AVG(est_los),COUNT(est_los) FROM estimation_table INNER JOIN statistics_table ON estimation_table.patient_id = statistics_table.patient_id WHERE morphology='Extension-Distraction' AND est_los>='$los'";
    $set = $mysql->query($ExtDistraction);
    $result = $set->fetch_assoc();
    $ExtDistrac = ROUND($result['AVG(est_los)']);
    $ExtDistracCount = ROUND($result['COUNT(est_los)']);
    
    $Burst = "SELECT AVG(est_los), COUNT(est_los) FROM estimation_table INNER JOIN statistics_table ON estimation_table.patient_id = statistics_table.patient_id WHERE morphology='Burst/Compression' AND est_los>='$los'";
    $set = $mysql->query($Burst);
    $result = $set->fetch_assoc();
    $BComp = ROUND($result['AVG(est_los)']);
    $BCompCount = ROUND($result['COUNT(est_los)']);
    
    //array format (array of estimatedLOS, array of counts)
    echo json_encode (array(array($FractDis,$FlexionDis,$Comb,$ExtDistrac,$BComp),array('Fracture-Dislocation ['.$FractDisloCount.']'),array('Flexion-Distraction ['.$FlexionDisCount.']'),array('Combination >1 ['.$CombCount.']'),array('Extension-Distraction ['.$ExtDistracCount.']'),array('Burst/Compression ['.$BCompCount.']')));
?>