<?php
    // establish the database connection
    $HOST = 'localhost';
    $DATABASE = 'LOSDB';
    $USER = 'bfokin';
    $PASSWORD = 'obSJX=a*Oyk}';
    
    $mysql = mysqli_connect($HOST,$USER,$PASSWORD,$DATABASE);
    
    // pull the patient id from the GET fields
    $patient_id = $_GET['patient_id'];
    $action_date = $_GET['action_date'];
    $supp_action = $_GET['supp_action'];
    $min = $_GET['min'];
    
    if ($patient_id != "") {
    
        // STEP 1: Get the estimate curve
        
        // get the patient's entry and exit dates
        $query = "select min(id) as id, entry_date, est_los 
                  from estimation_table where patient_id='$patient_id'";
        $row = $mysql->query($query)->fetch_assoc();
        
        // retrieve values from the query
        $id = $row['id'];
        $entry_date = date('m/d/Y', strtotime($row['entry_date']));
        $est_los = $row['est_los'];
        
        // calculate the number of minutes the patient has spent doing PT
        $pt_min_query = "select sum(minutes) as num from supplemental_action_table
                        where id=$id and supp_action='physical_therapy'";
        $pt_min = $mysql->query($pt_min_query)->fetch_assoc()['num'];
  
        // calculate the number of minutes the patient has spent doing OT
        $ot_min_query = "select sum(minutes) as num from supplemental_action_table
                        where id=$id and supp_action='occ_therapy'";
        $ot_min = $mysql->query($ot_min_query)->fetch_assoc()['num'];
        
        // add in the new time to the appropriate sum
        if ($supp_action == "physical_therapy") {
            $pt_min += $min;
        } else if ($supp_action == "occ_therapy") {
            $ot_min += $min;
        }
        
        // calculate the effect of the action
        $offset = exp(0.002*$pt_min + 0.0003*$ot_min);
        
        // get the number of days that have passed so far
        $days_past = (strtotime($action_date) - strtotime($entry_date)) / 86400;
        
        $new_est_los = max(round($est_los - $offset - $days_past, 0), 1);
        
        echo $new_est_los;
    } else {
        echo 9999; // error!
    }
?>