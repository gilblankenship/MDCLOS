<?php

    $HOST = 'localhost';
    $DATABASE = 'LOSDB';
    $USER = 'bfokin';
    $PASSWORD = 'obSJX=a*Oyk}';
    
    $phys_id = $_GET["physician_id"];
    $center_id = $_GET["center_id"];
           
    $mysql = mysqli_connect($HOST,$USER,$PASSWORD,$DATABASE);
    $query = "SELECT `patient_id`, `mrn` FROM patient_table WHERE physician_id = $phys_id 
                AND center_id = $center_id";
    $result = mysqli_query($mysql, $query);
    
     echo '
                <option value = "" disable selected hidden>Select Patient</option>
                ';
                     while($rows = $result->fetch_assoc()) {
                          //Pick out the data of the patients from the query result set
                          //$mrn = $rows["mrn"];
                          $patient_id = $rows["patient_id"];

                          echo' <option value='.$patient_id.'>'.$patient_id.'</option>;';
                      } 
?>