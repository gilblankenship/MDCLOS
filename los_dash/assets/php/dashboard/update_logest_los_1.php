<?php
    /* update_longest_los_1.php 
    gets the parameter with the longest LOS contribution in model 1 */
    
    $HOST = 'localhost';
    $DATABASE = 'LOSDB';
    $USER = 'bfokin';
    $PASSWORD = 'obSJX=a*Oyk}';
    $mysql = mysqli_connect($HOST,$USER,$PASSWORD,$DATABASE);

    //get LOS from slider selector
    $los = isset($_GET['los']) ? $_GET['los'] : 0;
    
    
    //Glasgow Coma Scale: >=11                
    $GCShigher11 = "SELECT AVG(est_los) AS 'avgGSC1' FROM estimation_table WHERE gcs='>= 11' AND model_number='1' AND est_los>='$los'";
    $set = $mysql->query($GCShigher11);
    $result = $set->fetch_assoc();
    $p1 = ROUND($result['avgGSC1']);
    
    //Glasgow Coma Scale: <11 
    $GCSlower11 = "SELECT AVG(est_los) AS 'avgGSC2' FROM estimation_table WHERE gcs='<11' AND model_number='1' AND est_los>='$los'";
    $set = $mysql->query($GCSlower11);
    $result = $set->fetch_assoc();
    $p2 = ROUND($result['avgGSC2']);
    
    //American Society of Anesthesiologists: 1 o 2
    $ASA1o2 = "SELECT AVG(est_los) AS 'ASA1' FROM estimation_table WHERE asa='1 or 2' AND model_number='1' AND est_los>='$los'";
    $set = $mysql->query($ASA1o2);
    $result = $set->fetch_assoc();
    $p3 = ROUND($result['ASA1']);
    
    //American Society of Anesthesiologists: 3 o 4
    $ASA3o4 = "SELECT AVG(est_los) AS 'ASA2' FROM estimation_table WHERE asa='3 or 4' AND model_number='1' AND est_los>='$los'";
    $set = $mysql->query($ASA3o4);
    $result = $set->fetch_assoc();
    $p4 = ROUND($result['ASA2']);
    
    //Neurological Status Complete Injury
    $NSci = "SELECT AVG(est_los) AS 'NS1' FROM estimation_table WHERE neurological_status='Complete Injury' AND model_number='1' AND est_los>='$los'";
    $set = $mysql->query($NSci);
    $result = $set->fetch_assoc();
    $p5 = ROUND($result['NS1']);
    
    //Neurological Status Other
    $NSother = "SELECT AVG(est_los) AS 'NS2' FROM estimation_table WHERE neurological_status='Other' AND model_number='1' AND est_los>='$los'";
    $set = $mysql->query($NSother);
    $result = $set->fetch_assoc();
    $p6 = ROUND($result['NS2']);
    
    //Polytrauma: YES
    $Pyes = "SELECT AVG(est_los) AS 'Pyes' FROM estimation_table WHERE polytrauma='1' AND model_number='1' AND est_los>='$los'";
    $set = $mysql->query($Pyes);
    $result = $set->fetch_assoc();
    $p7 = ROUND($result['Pyes']);

    //Polytrauma: NO
    $Pno = "SELECT AVG(est_los) AS 'Pno' FROM estimation_table WHERE polytrauma='0' AND model_number='1' AND est_los>='$los'";
    $set = $mysql->query($Pno);
    $result = $set->fetch_assoc();
    $p8 = ROUND($result['Pno']);
    
    $maxOption1 = max($p1,$p3,$p5,$p7);
    $maxOption2 = max($p2,$p4,$p6,$p8);
    
    $max = max($maxOption1,$maxOption2);
    //Get the parameters with a higher LOS and print them 
    if ($max == $p1){
        echo ' Glasgow Coma Scale >= 11';
    }
    if ($max == $p2){
        echo ' Glasgow Coma Scale < 11';
    }
    if ($max == $p3){
        echo ' ASA 1 or 2';
    }
    if ($max == $p4){
        echo ' ASA 3 or 4';
    }
    if ($max == $p5){
        echo ' Neurological Status: Complete Injury';
    }
    if ($max == $p6){
        echo ' Neurological Status: Other';
    }
    if ($max == $p7){
        echo ' Polytrauma: Yes';
    }
    if ($max == $p8){
        echo ' Polytrauma: No';
    }
    
?>