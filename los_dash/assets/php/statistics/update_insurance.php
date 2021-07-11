<?php

    /*update_insurance.php 
    Get the average LOS and count of patients per insurance type.*/
    $HOST = 'localhost';
    $DATABASE = 'LOSDB';
    $USER = 'bfokin';
    $PASSWORD = 'obSJX=a*Oyk}';
    $mysql = mysqli_connect($HOST,$USER,$PASSWORD,$DATABASE);

    //Get the los for the 'Chart Filters'
    $los = isset($_GET['los']) ? $_GET['los'] : 0;
     
    //queries with recorded LOS              
    $privateInsurance = "SELECT AVG(actual_los),COUNT(actual_los) FROM estimation_table INNER JOIN patient_table ON estimation_table.patient_id = patient_table.patient_id WHERE insurance='Private' AND est_los>='$los'";
    $set = $mysql->query($privateInsurance);
    $result = $set->fetch_assoc();
    $private = ROUND($result['AVG(actual_los)']);
    $private_count = ROUND($result['COUNT(actual_los)']);
    
    $medicaidInsurance = "SELECT AVG(actual_los),COUNT(actual_los) FROM estimation_table INNER JOIN patient_table ON estimation_table.patient_id = patient_table.patient_id WHERE insurance='Medicaid' AND est_los>='$los'";
    $set = $mysql->query($medicaidInsurance);
    $result = $set->fetch_assoc();
    $medicaid = ROUND($result['AVG(actual_los)']);
    $medicaid_count = ROUND($result['COUNT(actual_los)']);
    
    $medicareInsurance = "SELECT AVG(actual_los),COUNT(actual_los) FROM estimation_table INNER JOIN patient_table ON estimation_table.patient_id = patient_table.patient_id WHERE insurance='Medicare' AND est_los>='$los'";
    $set = $mysql->query($medicareInsurance);
    $result = $set->fetch_assoc();
    $medicare = ROUND($result['AVG(actual_los)']);
    $medicare_count = ROUND($result['COUNT(actual_los)']);
    
    $NoInsurance = "SELECT AVG(actual_los),COUNT(actual_los) FROM estimation_table INNER JOIN patient_table ON estimation_table.patient_id = patient_table.patient_id WHERE insurance='No insurance/Self-pay' AND est_los>='$los'";
    $set = $mysql->query($NoInsurance);
    $result = $set->fetch_assoc();
    $noInsurance = ROUND($result['AVG(actual_los)']);
    $noInsurance_count = ROUND($result['COUNT(actual_los)']);
    
    $medicareOther = "SELECT AVG(actual_los),COUNT(actual_los) FROM estimation_table INNER JOIN patient_table ON estimation_table.patient_id = patient_table.patient_id WHERE insurance='Other' AND est_los>='$los'";
    $set = $mysql->query($medicareOther);
    $result = $set->fetch_assoc();
    $other = ROUND($result['AVG(actual_los)']);
    $other_count = ROUND($result['COUNT(actual_los)']);
    
    //queries with estimated LOS
    
    $privateInsurance = "SELECT AVG(est_los),COUNT(est_los) FROM estimation_table INNER JOIN patient_table ON estimation_table.patient_id = patient_table.patient_id WHERE insurance='Private' AND est_los>='$los'";
    $set = $mysql->query($privateInsurance);
    $result = $set->fetch_assoc();
    $privateLOS = ROUND($result['AVG(est_los)']);
    $privateLOS_count = ROUND($result['COUNT(est_los)']);
    
    $medicaidInsurance = "SELECT AVG(est_los),COUNT(est_los) FROM estimation_table INNER JOIN patient_table ON estimation_table.patient_id = patient_table.patient_id WHERE insurance='Medicaid' AND est_los>='$los'";
    $set = $mysql->query($medicaidInsurance);
    $result = $set->fetch_assoc();
    $medicaidLOS = ROUND($result['AVG(est_los)']);
    $medicaidLOS_count = ROUND($result['COUNT(est_los)']);
    
    $medicareInsurance = "SELECT AVG(est_los),COUNT(est_los) FROM estimation_table INNER JOIN patient_table ON estimation_table.patient_id = patient_table.patient_id WHERE insurance='Medicare' AND est_los>='$los'";
    $set = $mysql->query($medicareInsurance);
    $result = $set->fetch_assoc();
    $medicareLOS = ROUND($result['AVG(est_los)']);
    $medicareLOS_count = ROUND($result['COUNT(est_los)']);
    
    
    $NoInsurance = "SELECT AVG(est_los),COUNT(est_los) FROM estimation_table INNER JOIN patient_table ON estimation_table.patient_id = patient_table.patient_id WHERE insurance='No insurance/Self-pay' AND est_los>='$los'";
    $set = $mysql->query($NoInsurance);
    $result = $set->fetch_assoc();
    $noInsuranceLOS = ROUND($result['AVG(est_los)']);
    $noInsuranceLOS_count = ROUND($result['COUNT(est_los)']);
    
    
    $medicareOther = "SELECT AVG(est_los),COUNT(est_los) FROM estimation_table INNER JOIN patient_table ON estimation_table.patient_id = patient_table.patient_id WHERE insurance='Other' AND est_los>='$los'";
    $set = $mysql->query($medicareOther);
    $result = $set->fetch_assoc();
    $otherLOS = ROUND($result['AVG(est_los)']);
    $otherLOS_count = ROUND($result['COUNT(est_los)']);
    
    $actual_los = [$private,$medicaid,$medicare,$noInsurance,$other];
    $est_los = [$privateLOS,$medicaidLOS,$medicareLOS,$noInsuranceLOS,$otherLOS];
    
    //array format (recorded LOS array, estimated LOS array, graph labels with count)
    echo json_encode (array($actual_los,$est_los,array('Private ['.$privateLOS_count.']'),array('Medicaid ['.$medicaidLOS_count.']'),array('Medicare ['.$medicareLOS_count.']'),array('No Insurance ['.$noInsuranceLOS_count.']'),array('Other ['.$otherLOS_count.']')));
?>