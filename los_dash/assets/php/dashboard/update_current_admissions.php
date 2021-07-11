<!-- updateAdmittedPatient.php 
    Number of currently admitted patients in the hospital. These are counted if the exit date is null what means that they exit the hospital yet -->
<?php
    $HOST = 'localhost';
    $DATABASE = 'LOSDB';
    $USER = 'bfokin';
    $PASSWORD = 'obSJX=a*Oyk}';
    $mysql = mysqli_connect($HOST,$USER,$PASSWORD,$DATABASE);
   
    //query count patients where exit date is empty (meaning that the patient didn't leave yet)
    $query="SELECT COUNT(patient_id) AS 'num' FROM estimation_table WHERE exit_date is NULL";
    $set = $mysql->query($query);
    $result = $set->fetch_assoc();
    $admissions = $result['num'];
    echo round($admissions);
?>