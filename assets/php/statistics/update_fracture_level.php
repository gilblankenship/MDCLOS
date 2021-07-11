<?php

    /*update_fracture_level.php
    
    Get the average LOS and count of patients per fracture level*/
    
    $HOST = 'localhost';
    $DATABASE = 'LOSDB';
    $USER = 'bfokin';
    $PASSWORD = 'obSJX=a*Oyk}';
    $mysql = mysqli_connect($HOST,$USER,$PASSWORD,$DATABASE);

    $los = isset($_GET['los']) ? $_GET['los'] : 0;

    //Final LOS               
    $T1T9 = "SELECT AVG(est_los),COUNT(est_los) FROM estimation_table INNER JOIN statistics_table ON estimation_table.patient_id = statistics_table.patient_id WHERE fracture_level='(T1-T9)' AND est_los>='$los'";
    $set = $mysql->query($T1T9);
    $result = $set->fetch_assoc();
    $FractT1T9 = ROUND($result['AVG(est_los)']);
    $FractT1T9_count = $result['COUNT(est_los)'];
    
    $T10L2 = "SELECT AVG(est_los),COUNT(est_los) FROM estimation_table INNER JOIN statistics_table ON estimation_table.patient_id = statistics_table.patient_id WHERE fracture_level='(T10-L2)' AND est_los>='$los'";
    $set = $mysql->query($T10L2);
    $result = $set->fetch_assoc();
    $FractT10L2 = ROUND($result['AVG(est_los)']);
    $FractT10L2_count = $result['COUNT(est_los)'];
    
    $L3L5 = "SELECT AVG(est_los),COUNT(est_los) FROM estimation_table INNER JOIN statistics_table ON estimation_table.patient_id = statistics_table.patient_id WHERE fracture_level='(L3-L5)' AND est_los>='$los'";
    $set = $mysql->query($L3L5);
    $result = $set->fetch_assoc();
    $FractL3L5 = ROUND($result['AVG(est_los)']);
    $FractL3L5_count = $result['COUNT(est_los)'];
    
    //array format (est_los array, arrays of labels (count))
    echo json_encode (array(array($FractT1T9,$FractT10L2,$FractL3L5),array("(T1-T9) Thoracic [".$FractT1T9_count."]"),array("(T10-L2) Thorcolumbar [".$FractT10L2_count."]"),array("(L3-L5) Low Lumbar [".$FractL3L5_count."]")));
?>