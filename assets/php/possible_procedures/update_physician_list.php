<?php
    $HOST = 'localhost';
    $DATABASE = 'LOSDB';
    $USER = 'bfokin';
    $PASSWORD = 'obSJX=a*Oyk}';
    
    $center_id = $_GET["center_id"];
    
    $mysql = mysqli_connect($HOST,$USER,$PASSWORD,$DATABASE);
    $query = "SELECT DISTINCT last_name, first_name, physician_id FROM physician_table WHERE primary_center = $center_id OR secondary_center = $center_id";
    $result_set = $mysql->query($query);
    
     echo '<option value= "" disabled selected hidden>Select Physician</option>';    
                                                            
    while($rows = $result_set->fetch_assoc()) {
        //Pick out the data of the patients from the query result set
        $last_name = $rows['last_name'];
        $first_name = $rows['first_name'];
        $physician_id = $rows['physician_id'];
        //Complete name
        $name=$last_name." , ".$first_name;
        echo "<option value='$physician_id'>$name</option>";
        }
?>