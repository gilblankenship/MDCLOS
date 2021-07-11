<!-- updateAnswersFinal.php
    Insert the answers of the questionnaire to the DB. This file is called in questionnaire3/questionnaire.php -->

<?php  
    // Connect to the DB 
    $HOST = 'localhost';
    $DATABASE = 'LOSDB';
    $USER = 'bfokin'; 
    $PASSWORD = 'obSJX=a*Oyk}';
    $mysql = mysqli_connect($HOST,$USER,$PASSWORD,$DATABASE);

    $los = $_POST['losEstimation']; 
    // Decode the sent array from the AJAX. The post method is used to retrieve it. 
    $answers = json_decode($_POST["answers"]); 
    
    // Assign a variable to each position in the array
    $id     = $answers[5];
    $gcs    = $answers[6];
    $asa    = $answers[7];
    $neuro  = $answers[8];
    $poly   = $answers[9];
    $iss    = $answers[10];
    $model  = '1';
;
    
    // Inserts it to the patient_activity_table
    $query="INSERT INTO estimation_table (patient_id, model_number, entry_date, gcs, asa, est_los, 
                                            neurological_status, polytrauma,iss) 
            VALUES ('$id', $model, CURDATE(), $gcs, $asa, $los, '$neuro' ,$poly, $iss)";
            
            
    $mysql->query($query);
    
    $mysql -> close();

?>