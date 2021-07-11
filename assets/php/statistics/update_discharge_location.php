<?php

    /* update_discharge_location.php 
     Used in graph 'Discharge Location'. It shows the avg. LOS per location with the number of patients at each location. */
    $HOST = 'localhost';
    $DATABASE = 'LOSDB';
    $USER = 'bfokin';
    $PASSWORD = 'obSJX=a*Oyk}';
    $mysql = mysqli_connect($HOST,$USER,$PASSWORD,$DATABASE);

     //Get the LOS value from the slide bar selector
    $los = isset($_GET['los']) ? $_GET['los'] : 0;

    //Final LOS               
    $df_home = "SELECT AVG(est_los), COUNT(est_los) FROM estimation_table WHERE discharge_facility='Home' AND est_los>='$los'";
    $set = $mysql->query($df_home);
    $result = $set->fetch_assoc();
    $dfacility_home = ROUND($result['AVG(est_los)']);
    $dfacility_home_count = ROUND($result['COUNT(est_los)']);
    
    $df_rehab = "SELECT AVG(est_los),COUNT(est_los) FROM estimation_table WHERE discharge_facility='Rehab facility' AND est_los>='$los'";
    $set = $mysql->query($df_rehab);
    $result = $set->fetch_assoc();
    $dfacility_rehab = ROUND($result['AVG(est_los)']);
    $dfacility_rehab_count = ROUND($result['COUNT(est_los)']);
    
    $df_other = "SELECT AVG(est_los),COUNT(est_los) FROM estimation_table WHERE discharge_facility='Other' AND est_los>='$los'";
    $set = $mysql->query($df_other);
    $result = $set->fetch_assoc();
    $dfacility_other = ROUND($result['AVG(est_los)']);
    $dfacility_other_count = ROUND($result['COUNT(est_los)']);
    
    
    echo json_encode (array(array($dfacility_home, $dfacility_rehab, $dfacility_other),array('Home ['.$dfacility_home_count.']'),array('Rehab Facility ['.$dfacility_rehab_count.']'),array('Other ['.$dfacility_other_count.']')));
?>