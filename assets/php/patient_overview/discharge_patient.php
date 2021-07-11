<?php
    // establish the database connection
    $HOST = 'localhost';   
    $DATABASE = 'LOSDB';
    $USER = 'bfokin';      
    $PASSWORD = 'obSJX=a*Oyk}';
    $mysql = mysqli_connect($HOST,$USER,$PASSWORD,$DATABASE);
    
    $dis_type = $_GET["dis_type"];
    
    $dis_date =date('Y-m-d', strtotime($_GET["dis_date"]));
    $patient_id = $_GET["patient_id_2"];
    
    $query = "select min(id) as id from estimation_table where patient_id='$patient_id'";
    $patient_admission = $mysql->query($query)->fetch_assoc()['id'];
    
    // stable_dis ... discharged
    
    if ($dis_type == 'stable') {
        // first add an entry into the supp_action_table
        $query = "insert into supplemental_action_table 
                  (id, supp_action, action_date, new_est_los) values
                  ($patient_admission, 'stable_dis', '$dis_date', 0)";
        $mysql->query($query);
    } else {
        $dis_loc = $_GET["dis_loc"];
        
        $query = "select entry_date from estimation_table where id=$patient_admission";
        $entry_date = $mysql->query($query)->fetch_assoc()['entry_date'];

        $actual_los = (strtotime($dis_date) - strtotime($entry_date)) / 86400;
        
        echo $patient_admission;
        
        // first add an entry into the supp_action_table
        $query = "insert into supplemental_action_table 
                  (id, supp_action, action_date, new_est_los) values
                  ($patient_admission, 'discharged', '$dis_date', 0)";
        $mysql->query($query);
        
        // update the original db entry to reflect the discharge
        $query = "update estimation_table set 
                  exit_date='$dis_date', discharge_facility='$dis_loc', actual_los=$actual_los
                  where id=$patient_admission";
        $mysql->query($query);
    }
?>