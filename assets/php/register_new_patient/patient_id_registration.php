<?php
        
        $HOST = 'localhost';   
        $DATABASE = 'LOSDB';
        $USER = 'bfokin';      
        $PASSWORD = 'obSJX=a*Oyk}';
        $mysql = mysqli_connect($HOST,$USER,$PASSWORD,$DATABASE);
    
        //patient id calculation
        $sql = "SELECT MAX(`patient_id`) FROM `patient_table`";
        $result = $mysql->query($sql);
        $row = $result->fetch_assoc();
        $max_patientid_patientidtable = $row['MAX(`patient_id`)'];
        $patient_id_table1 = $max_patientid_patientidtable+1;
        
        $sql = "SELECT MAX(`patient_id`) FROM `statistics_table`";
        $result = $mysql->query($sql);
        $row = $result->fetch_assoc();
        $max_patientid_statstable = $row['MAX(`patient_id`)'];
        $patient_id_table2 = $max_patientid_statstable+1;
        
        //To check in case both patient ids differ due to an error. To avoid misunderstanding the code directly chooses between the maximum number and adds one to get the order back.
        if ($patient_id_table1===$patient_id_table2){
            echo $patient_id_table1;
        } else {
            $max_patient_id = max($patient_id_table1,$patient_id_table2)+1;
            echo $max_patient_id;
        }
?>