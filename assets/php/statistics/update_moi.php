<?php

    /*update_moi.php
    get the average LOS and count of patients of each mechanism of injury
    */
    $HOST = 'localhost';
    $DATABASE = 'LOSDB';
    $USER = 'bfokin';
    $PASSWORD = 'obSJX=a*Oyk}';
    $mysql = mysqli_connect($HOST,$USER,$PASSWORD,$DATABASE);
   
    //get LOS value from slider (Chart filters)
    $los = isset($_GET['los']) ? $_GET['los'] : 0;
    
    $mean_los_array = []; //array to store mean los
    $count_array = []; //array to store the count
    
    // note: the last one is 1000 so that it gives the effect of > 80! :)
    $moi_array = ['FFH','FFSH','PED','Fall Stairs','MVC','MCC','Other'];
    
    //go over the array to query by moi
    for ($idx = 0; $idx < sizeof($moi_array); $idx++) {
        // get the start and end ages for the query
        $moi = $moi_array[$idx];
        
        $query = "SELECT AVG(estimation_table.est_los) AS 'num',
                  COUNT(statistics_table.patient_id) AS 'count'
                  FROM estimation_table INNER JOIN statistics_table 
                  ON estimation_table.patient_id = statistics_table.patient_id 
                  WHERE statistics_table.moi='$moi'
                  AND estimation_table.est_los>='$los'";
                  
        $set = $mysql->query($query);
        $row = $set->fetch_assoc();
        
        $mean_los = ROUND($row['num']);
        $count = ROUND($row['count']);
        
        // push the result into our result array that will be returned
        array_push($mean_los_array, $mean_los);
        array_push($count_array, $count);
    }
    
     echo json_encode (array($mean_los_array,array('Fall From Height ['.$count_array[0].']'),array('Fall From Standing Height ['.$count_array[1].']'),array('Pedestrian Struck ['.$count_array[2].']'),array('Fall Stairs ['.$count_array[3].']'),array('Motor Vehicle Crash ['.$count_array[4].']'),array('Motorcycle Crash ['.$count_array[5].']'),array('Other ['.$count_array[6].']')));
?>