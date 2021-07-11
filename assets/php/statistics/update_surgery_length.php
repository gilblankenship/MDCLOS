<?php
    /*update_sur_length.php 
    Used in graph 'Surgery Length'. It shows the avg. LOS and the surgery length range with the number of patients in each range.*/
    
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
    
    // note: the last one is 1000 so that it gives the effect of > 600! :)
    $surgery_length = [0, 60, 120, 180, 240, 300, 360, 420, 480, 540, 600, 1200];
    
    //for loop going through the surgery length array
    for ($idx = 0; $idx < sizeof($surgery_length) - 1; $idx++) {
        // get the start and end surgery length values for the query
        $start = $surgery_length[$idx];
        $end = $surgery_length[$idx + 1];
        
        $query = "SELECT AVG(est_los),COUNT(est_los) FROM estimation_table INNER JOIN statistics_table
        ON estimation_table.patient_id = statistics_table.patient_id WHERE surgery_length>=$start AND surgery_length<=$end AND est_los>='$los'";
                  
        $set = $mysql->query($query);
        $row = $set->fetch_assoc();
        
        //get mean los value
        $mean_los = ROUND($row['AVG(est_los)']);
        //count los value
        $count = $row['COUNT(est_los)'];
        
        // push the result into our result array that will be returned
        array_push($mean_los_array, $mean_los);
        array_push($count_array, $count);
    }
    
    //Array with this structure (array with mean LOS values, arrays with label + [count of patients with that conditions])
    echo json_encode (array($mean_los_array, array('<60 min ['.$count_array[0].']'), array('1 - 2 hr ['.$count_array[1].']'), array('2 - 3 hr ['.$count_array[2].']'), array('3 - 4 hr ['.$count_array[3].']'), array('4 - 5 hr ['.$count_array[4].']'), array('5 - 6 hr ['.$count_array[5].']'), array('6 - 7 hr ['.$count_array[6].']'), array('7 - 8 hr ['.$count_array[7].']'), array('8 - 9 hr ['.$count_array[8].']'), array('9 - 10 hr ['.$count_array[9].']')));


   ?>