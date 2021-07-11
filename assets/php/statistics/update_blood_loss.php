<?php
    /* update_blood_loss.php 
    Used in graph 'Blood LOS (ml)'. It shows the avg. LOS and the blood LOS range with the number of patients in each range. */
    
    //Connection to the DB
    $HOST = 'localhost';
    $DATABASE = 'LOSDB';
    $USER = 'bfokin';
    $PASSWORD = 'obSJX=a*Oyk}';
    $mysql = mysqli_connect($HOST,$USER,$PASSWORD,$DATABASE);
   
    //Get the LOS value from the slide bar selector
    $los = isset($_GET['los']) ? $_GET['los'] : 0;
    
    $mean_los_array = []; //Array where the mean LOS values are being stored
    $count_array = []; //Array count, stores the number of patients in a certain age range
    
    // note: the last one is 1000 so that it gives the effect of > 80! :)
    $blood_range = [0, 500, 1000, 1500, 2000, 2500, 3000, 3500, 4000, 4500, 5000];
    
    //for loop going through the blood range array
    for ($idx = 0; $idx < sizeof($blood_range) - 1; $idx++) {
        // get the start and end blood values for the query
        $start = $blood_range[$idx];
        $end = $blood_range[$idx + 1];
        
        $query = "SELECT AVG(estimation_table.est_los) AS 'num',
                  COUNT(statistics_table.patient_id) AS 'count'
                  FROM estimation_table INNER JOIN statistics_table 
                  ON estimation_table.patient_id = statistics_table.patient_id 
                  WHERE statistics_table.est_blood_loss>=$start AND statistics_table.est_blood_loss<$end 
                  AND estimation_table.est_los>='$los'";
                  
        $set = $mysql->query($query);
        $row = $set->fetch_assoc();
        
        //get mean los value
        $mean_los = ROUND($row['num']);
        //count los value
        $count = $row['count'];
        
        // push the result into our result array that will be returned
        array_push($mean_los_array, $mean_los);
        array_push($count_array, $count);
    }
    
    //Array with this structure (array with mean LOS values, arrays with label + [count of patients with that conditions])
    echo json_encode (array($mean_los_array, array('<500 ['.$count_array[0].']'), array('500 - 1000 ['.$count_array[1].']'), array('1000 - 1500 ['.$count_array[2].']'), array('1500 - 2000 ['.$count_array[3].']'), array('2000 - 2500 ['.$count_array[4].']'), array('2500 - 3000 ['.$count_array[5].']'), array('3000 - 3500 ['.$count_array[6].']'), array('3500 - 4000 ['.$count_array[7].']'), array('4000 - 4500 ['.$count_array[8].']'), array('4500 - 5000 ['.$count_array[9].']')));
?>