<?php
    /* update_deviation.php
    was created for showing a deviation graph where the recorded and estimated los were compared. If there was a big difference between this two, something was happening, and that patient should be analysed. 
    This graph is not currently being displayed */
    
    $HOST = 'localhost';
    $DATABASE = 'LOSDB';
    $USER = 'bfokin';
    $PASSWORD = 'obSJX=a*Oyk}';
    $mysql = mysqli_connect($HOST,$USER,$PASSWORD,$DATABASE);
    
    //Array to store the deviation values of each patient
    $deviation = array();
    //array to store id for the x-axis
    $patients = array();
    
    //variable initialization at 0
    $i=0;
    
    //Query
    $query="SELECT est_los, current_los, id FROM estimation_table WHERE id<='197'";
    $result_set = $mysql->query($query);
        while($rows = $result_set->fetch_assoc()) {
                $current = $rows['current_los'];
                $estimated = $rows['est_los'];
                $deviation[$i] = ABS($current-$estimated); //Push into the deviation array the value
                $patients[$i] = $rows['id']; //Push into the patients array the value
                $i++;
        }
        
    echo json_encode (array($deviation,$patients));
?>