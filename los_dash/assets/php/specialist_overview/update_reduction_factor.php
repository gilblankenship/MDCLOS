<?php
    /* update_redution_factor.php 
    This code is used in the Reduction factor graph comparison among specialists. Gets all the specialists ids and their reduction factors and plots them in a graph */
    
    $HOST = 'localhost';
    $DATABASE = 'LOSDB';
    $USER = 'bfokin';
    $PASSWORD = 'obSJX=a*Oyk}';
    $mysql = mysqli_connect($HOST,$USER,$PASSWORD,$DATABASE);

    //Get the Specialist ID from the AJAX call
    $id = $_GET['id'];
    //Get the Minimum and Maximum LOS entered in the Chart Filter 'Choose LOS'
    $min_los = $_GET["min_los"];
    $max_los = $_GET["max_los"];
    
    //Query to get the procedure of the selected specialist 
    $query = "SELECT `procedure_performed` FROM specialist_table WHERE specialist_id = '$id'";
    $set = $mysql->query($query);
    $result = $set->fetch_assoc();
    $procedure = $result["procedure_performed"];
    
    //Get all the possible specialists
    $query = "SELECT DISTINCT specialist_id FROM procedure_table WHERE `procedure` = '$procedure'
                            ";
    $all_ids = []; //Array to store all the ids
    $rf = [];

    $result = $mysql->query($query);
    
    //Push all the specialists id into the array
    while( $row = mysqli_fetch_array($result)) {
        $id = $row['specialist_id'];
        array_push($all_ids, $id);
    }
    
    //go across the array for each specialist
    for($i=0;$i<sizeof($all_ids);$i++){
        $current_id = $all_ids[$i];
        //Get info of the current specialist
        
        $query = "SELECT * FROM procedure_table INNER JOIN estimation_table ON procedure_table.patient_id = estimation_table.patient_id WHERE procedure_table.specialist_id = '$current_id'
        AND estimation_table.est_los>=$min_los AND estimation_table.est_los<=$max_los
                            "; 
        
        $result = mysqli_query($mysql, $query);
            //Calculate the average reduction factor of the selected speccialist
            $reduction_fact_therapist = []; //Array for storing the reduction factor
                    //Push into an array all the reduction factors
                    while( $row = mysqli_fetch_array($result)) {
                        $rf_therapist = $row["reduction_days"]/($row["minutes"]/15);
                        array_push($reduction_fact_therapist, $rf_therapist);
                    }
                    //Calculate the Therapist's avg reduction in LOS per hour
                    $reduction_in_los_per_15mins_therapist = array_sum($reduction_fact_therapist) / count($reduction_fact_therapist);
                    array_push($rf, ROUND($reduction_in_los_per_15mins_therapist,2));
    }
    
    echo json_encode (array($all_ids,$rf));
?>