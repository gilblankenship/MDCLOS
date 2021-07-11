<?php
    $HOST = 'localhost';
    $DATABASE = 'LOSDB';
    $USER = 'bfokin';
    $PASSWORD = 'obSJX=a*Oyk}';
    $mysql = mysqli_connect($HOST,$USER,$PASSWORD,$DATABASE);
    $query = "SELECT DISTINCT medical_center, center_id FROM medical_center_table";
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