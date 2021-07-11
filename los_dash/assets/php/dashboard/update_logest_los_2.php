<?php
    $HOST = 'localhost';
    $DATABASE = 'LOSDB';
    $USER = 'bfokin';
    $PASSWORD = 'obSJX=a*Oyk}';
    $mysql = mysqli_connect($HOST,$USER,$PASSWORD,$DATABASE);

    $los = isset($_GET['los']) ? $_GET['los'] : 0;
    
    //Glasgow Coma Scale: >=11                
    $GCShigher11 = "SELECT AVG(est_los) AS 'avgGSC1' FROM estimation_table WHERE gcs='>= 11' AND model_number='2' AND est_los>='$los'";
    $set = $mysql->query($GCShigher11);
    $result = $set->fetch_assoc();
    $p1 = ROUND($result['avgGSC1']);
    
    //Glasgow Coma Scale: <11 
    $GCSlower11 = "SELECT AVG(est_los) AS 'avgGSC2' FROM estimation_table WHERE gcs='<11' AND model_number='2' AND est_los>='$los'";
    $set = $mysql->query($GCSlower11);
    $result = $set->fetch_assoc();
    $p2 = ROUND($result['avgGSC2']);
    
    //American Society of Anesthesiologists: 1 o 2
    $ASA1o2 = "SELECT AVG(est_los) AS 'ASA1' FROM estimation_table WHERE asa='1 or 2' AND model_number='2' AND est_los>='$los'";
    $set = $mysql->query($ASA1o2);
    $result = $set->fetch_assoc();
    $p3 = ROUND($result['ASA1']);
    
    //American Society of Anesthesiologists: 3 o 4
    $ASA3o4 = "SELECT AVG(est_los) AS 'ASA2' FROM estimation_table WHERE asa='3 or 4' AND model_number='2' AND est_los>='$los'";
    $set = $mysql->query($ASA3o4);
    $result = $set->fetch_assoc();
    $p4 = ROUND($result['ASA2']);
    
    //Neurological Status Complete Injury
    $NSci = "SELECT AVG(est_los) AS 'NS1' FROM estimation_table WHERE neurological_status='Complete Injury' AND model_number='2' AND est_los>='$los'";
    $set = $mysql->query($NSci);
    $result = $set->fetch_assoc();
    $p5 = ROUND($result['NS1']);
    
    //Neurological Status Other
    $NSother = "SELECT AVG(est_los) AS 'NS2' FROM estimation_table WHERE neurological_status='Other' AND model_number='2' AND est_los>='$los'";
    $set = $mysql->query($NSother);
    $result = $set->fetch_assoc();
    $p6 = ROUND($result['NS2']);
    
    //Polytrauma: YES
    $Pyes = "SELECT AVG(est_los) AS 'Pyes' FROM estimation_table WHERE polytrauma='1' AND model_number='2' AND est_los>='$los'";
    $set = $mysql->query($Pyes);
    $result = $set->fetch_assoc();
    $p7 = ROUND($result['Pyes']);

    //Polytrauma: NO
    $Pno = "SELECT AVG(est_los) AS 'Pno' FROM estimation_table WHERE polytrauma='0' AND model_number='2' AND est_los>='$los'";
    $set = $mysql->query($Pno);
    $result = $set->fetch_assoc();
    $p8 = ROUND($result['Pno']);
    
    //PRBC Transfusion_Yes
    $PtransY = "SELECT AVG(est_los) AS 'PtransY' FROM estimation_table WHERE prbc_transfusion='1' AND model_number='2' AND est_los>='$los'";
    $set = $mysql->query($PtransY);
    $result = $set->fetch_assoc();
    $p9 = ROUND($result['PtransY']);
    
    //PRBC Transfusion_No
    $PtransN = "SELECT AVG(est_los) AS 'PtransN' FROM estimation_table WHERE prbc_transfusion='0' AND model_number='2' AND est_los>='$los'";
    $set = $mysql->query($PtransN);
    $result = $set->fetch_assoc();
    $p10 = ROUND($result['PtransN']);
    
    //Skin Complication_No
    $SC_N = "SELECT AVG(est_los) AS 'SC_N' FROM estimation_table WHERE skin_complication='0' AND model_number='2' AND est_los>='$los'";
    $set = $mysql->query($SC_N);
    $result = $set->fetch_assoc();
    $p11 = ROUND($result['SC_N']);
    
    //Skin Complication_Yes
    $SC_Y = "SELECT AVG(est_los) AS 'SC_Yes' FROM estimation_table WHERE skin_complication='1' AND model_number='2' AND est_los>='$los'";
    $set = $mysql->query($SC_Y);
    $result = $set->fetch_assoc();
    $p12 = ROUND($result['SC_Yes']);
    
    //Discharge Facility: Other
    $DF_other = "SELECT AVG(est_los) AS 'DF_other' FROM estimation_table WHERE discharge_facility='Other' AND model_number='2' AND est_los>='$los'";
    $set = $mysql->query($DF_other);
    $result = $set->fetch_assoc();
    $p13 = ROUND($result['DF_other']);
    
    //Discharge Facility: Rehab
    $DF_rehab = "SELECT AVG(est_los) AS 'DF_rehab' FROM estimation_table WHERE discharge_facility='Rehab' AND model_number='2' AND est_los>='$los'";
    $set = $mysql->query($DF_rehab);
    $result = $set->fetch_assoc();
    $p14 = ROUND($result['DF_rehab']);
    
    $maxOption1 = max($p1,$p3,$p5,$p7,$p9,$p11,$p13);
    $maxOption2 = max($p2,$p4,$p6,$p8,$p10,$p12,$p14);
    
    $max = max($maxOption1,$maxOption2);
    if ($max == $p1){
        echo 'Glasgow Coma Scale >= 11';
    }
    if ($max == $p2){
        echo 'Glasgow Coma Scale < 11';
    }
    if ($max == $p3){
        echo 'ASA 1 or 2';
    }
    if ($max == $p4){
        echo 'ASA 3 or 4';
    }
    if ($max == $p5){
        echo 'Neurological Status: Complete Injury';
    }
    if ($max == $p6){
        echo 'Neurological Status: Other';
    }
    if ($max == $p7){
        echo 'Polytrauma: Yes';
    }
    if ($max == $p8){
        echo 'Polytrauma: No';
    }
    if ($max == $p9){
        echo 'PRBC Transfusion: Yes';
    }
    if ($max == $p10){
        echo 'PRBC Transfusion: No';
    }
    if ($max == $p11){
        echo 'Skin Complication: No';
    }
    if ($max == $p12){
        echo 'Skin Complication: Yes';
    }
    if ($max == $p13){
        echo 'Discharge Facility: Other';
    }
    if ($max == $p14){
        echo 'Discharge Facility: Rehab';
    }
    
?>