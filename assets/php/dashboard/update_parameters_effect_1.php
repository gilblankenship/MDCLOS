<?php

    /* update_parametersVSlos_1.php 
    Parameters statistics of model 1*/
    
    $HOST = 'localhost';
    $DATABASE = 'LOSDB';
    $USER = 'bfokin';
    $PASSWORD = 'obSJX=a*Oyk}';
    $mysql = mysqli_connect($HOST,$USER,$PASSWORD,$DATABASE);

    //Get LOS from slide bar 
    $los = isset($_GET['los']) ? $_GET['los'] : 0;
    
    //Get the estimated avg LOS for each of the parameters of model 1:
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
    
    //Array containing the LOS per paramters
    echo json_encode(array(array($p1,$p3,$p5,$p7),array($p2,$p4,$p6,$p8)));
?>