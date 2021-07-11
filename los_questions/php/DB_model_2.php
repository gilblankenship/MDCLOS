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
    $id   = $answers[8];
    $gcs   = $answers[9];
    $asa = $answers[10];
    
    $neuro  = $answers[11];
    $poly   = $answers[12];  
    $prbc = $answers[13];
    $skin = $answers[14];
    $discharge = $answers[15];
    $num_comp = $answers[16];
    $model = '2';
;
    // Inserts it to the patient_activity_table
    $query="INSERT INTO estimation_table (patient_id, model_number, entry_date, gcs, asa, est_los,
                                            neurological_status, polytrauma, num_complications,
                                            prbc_transfusion, skin_complication, discharge_facility) 
            VALUES ('$id', $model, CURDATE(), $gcs, $asa, $los, '$neuro', $poly, $num_comp, $prbc, $skin, '$discharge')";
            
    $mysql->query($query);
    
    $mysql -> close();
    
?>