<?php
    // establish the database connection
    $HOST = 'localhost';   
    $DATABASE = 'LOSDB';
    $USER = 'bfokin';      
    $PASSWORD = 'obSJX=a*Oyk}';
    $mysql = mysqli_connect($HOST,$USER,$PASSWORD,$DATABASE);
    
    // create a prepared statement, (safety :D)
    $stmt = $mysql->prepare("insert into supplemental_action_table 
                            (id, supp_action, action_date, action_time, minutes, comment, new_est_los) 
                            values (?, ?, ?, ?, ?, ?, ?)");


    // bind our parameters to the statement        
    $stmt->bind_param("sssssss", $patient_admission, $action_taken, $action_date,
                                 $action_time, $minutes, $comment, $new_est_los);
                            
    // retrieve the variables sent by the form
    $patient_id = $_GET["patient_id"];
    
    $action_taken = $_GET["action_taken"];
    $comment = $_GET["comment"];
    
    $action_date = date('Y-m-d',strtotime($_GET["action_date"]));
    $action_time = $_GET["action_time"];
    
    $new_est_los = $_GET["new_est"];
    $minutes = $_GET['min'];
    
    
    $query = "select min(id) as id from estimation_table where patient_id='$patient_id'";
    $patient_admission = $mysql->query($query)->fetch_assoc()['id'];

    $stmt->execute();
    $stmt->close();
    
    // return back to the page and signal its success
    header("Location: ../../../../patient_overview.php?signup=success");
?>