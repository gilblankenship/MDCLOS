<?php

    /*update_patientsVSlos.php 
    LOS distribution among admissions. In other words, number of patients with a certain estimated LOS. Using the Chart Filter option, 
    the information can be grouped in bins of 5 days or individually*/
     
    //DB connection
    $HOST = 'localhost';
    $DATABASE = 'LOSDB';
    $USER = 'bfokin';
    $PASSWORD = 'obSJX=a*Oyk}';
    $mysql = mysqli_connect($HOST,$USER,$PASSWORD,$DATABASE);
    
    //Grouped option in Chart FIlters
    $grouped = isset($_GET['grouped']) ? $_GET['grouped'] : False;
    
    if (strcmp($grouped, 't') == 0) {
        $group = True;
    } else {
        $group = False;
    }
    
    // how much to group by
    $grouping_amt = 5;
    
    // get the maximum LOS to figure out how many queries need to be done
    $max_los_set = $mysql->query("select max(est_los) as max_los from estimation_table");
    $max_los = $max_los_set->fetch_assoc()['max_los'];
    
    // round the maximum LOS up a multiple of the grouping amount (for easy grouping)
    $max_los_rounded = $max_los + ($grouping_amt - ($max_los % $grouping_amt));

    // instantiate lists to hold our labels and return values
    $labels = [];
    $values = [];
    
    if ($group) {
        for ($idx = 1; $idx < $max_los_rounded; $idx += $grouping_amt) {
            $end_idx = $idx + $grouping_amt - 1;
            $label = strval($idx)."-".strval($end_idx);
            
            // add the label "start-end" to the labels list
            array_push($labels, $label);
            
            $query = "select count(patient_id) as num from estimation_table
                      where est_los >= $idx and est_los <= $end_idx";
                      
            $los_count_set = $mysql->query($query);
            $los_count = $los_count_set->fetch_assoc()["num"];
            
            array_push($values, $los_count);
        }
    } else {
        // this query can get kind of slow, adding an index on est_los sped it up
        for ($idx = 1; $idx < $max_los_rounded; $idx += 1) {
            $label = strval($idx);
            
            // add the label "start-end" to the labels list
            array_push($labels, $label);
            
            $query = "select count(patient_id) as num from estimation_table
                      where est_los = $idx";
                      
            $los_count_set = $mysql->query($query);
            $los_count = $los_count_set->fetch_assoc()["num"];
            
            array_push($values, $los_count);
        }
    }
    
    echo json_encode(array($labels, $values));
?>