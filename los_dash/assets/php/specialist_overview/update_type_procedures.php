<?php
    /* update_type_procedures.php 
    This code is used in the 'Reduction in days per type of procedure' */
    
    //Connect to the DB 
    $HOST = 'localhost';
    $DATABASE = 'LOSDB';
    $USER = 'bfokin';
    $PASSWORD = 'obSJX=a*Oyk}';
    $mysql = mysqli_connect($HOST,$USER,$PASSWORD,$DATABASE);

    //Get the Specialist ID from the AJAX call
    $id = $_GET['id'];
    
    //Query to get the procedure of the selected specialist 
    $query = "SELECT `procedure_performed` FROM specialist_table WHERE specialist_id = '$id'";
    $set = $mysql->query($query);
    $result = $set->fetch_assoc();
    $procedure = $result["procedure_performed"];
    
    //Create arrays to store the values of the graph (y-axis: type of procedure, x-axis: reduction in days)
    $all_avg_reductions = [];
    $all_procedures = [];
    
    //Depending on the procedure (PT or OT) there are different types of procedures
    if($procedure=='physical_therapy'){
        $procedures = ['Massage','Exercise','Acupuncture'];
    }
    if($procedure=='occupational_therapy'){
        $procedures = ['OT_A','OT_B'];
    }
    
    //For each element of the array query
    for($i=0;$i<sizeof($procedures);$i++){
    //Get all the possible specialists
        $type_procedure = $procedures[$i];
        $query = "SELECT AVG(reduction_days) FROM procedure_table WHERE type_procedure = '$type_procedure' AND specialist_id = '$id'";
        $set = $mysql->query($query);
        $result = $set->fetch_assoc();
        $reduction_days_per_procedure = $result['AVG(reduction_days)'];    
        
        array_push($all_avg_reductions, ROUND($reduction_days_per_procedure,3));
        array_push($all_procedures,$type_procedure);
    }
    
    echo json_encode (array($all_avg_reductions,$all_procedures));
?>