<?php
    /* update_AgeVSlos.php 
    Used in graph 'Mean LOS by age'. It shows the avg. LOS and the age range with the number of patients in each range. */
    
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
    $age_range = [0, 10, 20, 30, 40, 50, 60, 70, 80, 1000];
    
    //for loop going through the age range array 
    for ($idx = 0; $idx < sizeof($age_range) - 1; $idx++) {
        // get the start and end ages for the query
            //start age range
            $start = $age_range[$idx];
            //end age range 
            $end = $age_range[$idx + 1];
        
        //query
        $query = "SELECT AVG(estimation_table.est_los) AS 'num',
                  COUNT(patient_table.age) AS 'count'
                  FROM estimation_table INNER JOIN patient_table 
                  ON estimation_table.patient_id = patient_table.patient_id 
                  WHERE patient_table.age>=$start AND patient_table.age<$end 
                  AND estimation_table.est_los>='$los'";
        
        $set = $mysql->query($query);
        $row = $set->fetch_assoc();
        
        //get mean los value
        $mean_los = ROUND($row['num']);
        
        //get count value
        $count = ROUND($row['count']);
        
        // push the result into our result array that will be returned
        array_push($mean_los_array, $mean_los);
        array_push($count_array, $count);
    }
    
    //Array with this structure (array with mean LOS values, arrays with label + [count of patients with that conditions])
    echo json_encode(array($mean_los_array,array("<10 [".$count_array[0]."]"),array("10 - 20 [".$count_array[1]."]"),array("20 - 30 [".$count_array[2]."]"),array("30 - 40 [".$count_array[3]."]"),array("40 - 50 [".$count_array[4]."]"),array("50 - 60 [".$count_array[5]."]"),array("60 - 70 [".$count_array[6]."]"),array("70 - 80 [".$count_array[7]."]"),array(">80 [".$count_array[8]."]")));
?>