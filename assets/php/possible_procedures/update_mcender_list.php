<?php
    $HOST = 'localhost';
    $DATABASE = 'LOSDB';
    $USER = 'bfokin';
    $PASSWORD = 'obSJX=a*Oyk}';
    $mysql = mysqli_connect($HOST,$USER,$PASSWORD,$DATABASE);
    $query = "SELECT `patient_id`,`first_name`,`last_name` FROM patient_table WHERE physician_id = $phys_id 
                    AND center_id = $center_id";

    $result_set = $mysql->query($query);
    
     echo '<option value= "" disabled selected hidden>Select Medical Center</option>';    
                                                            
    while($rows = $result_set->fetch_assoc()) {
        //Pick out the data of the patients from the query result set
        $medical_center = $rows['medical_center'];
        $center_id = $rows['center_id'];
        //Complete name
        echo "<option value='$center_id'>$medical_center</option>";
        }
?>