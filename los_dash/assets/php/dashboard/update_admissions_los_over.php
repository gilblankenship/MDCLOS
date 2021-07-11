<?php

/* update_more_selected_days.php 
  Count of patients with est_los higher than 1 */
  
    $HOST = 'localhost';
    $DATABASE = 'LOSDB';
    $USER = 'bfokin';
    $PASSWORD = 'obSJX=a*Oyk}';
    $mysql = mysqli_connect($HOST,$USER,$PASSWORD,$DATABASE);
   
    //Get the value selected in the slide bar
    $los = isset($_GET['los']) ? $_GET['los'] : 0;
    
    //Get from the query the number of patients in the DB that has an estimated LOS value higher than the selected value in the slider bar.
    $query = "SELECT COUNT(`patient_id`) AS 'Num' FROM `estimation_table` WHERE ROUND(est_los)>='$los'";
    $set = $mysql->query($query);
    $result = $set->fetch_assoc();
    $countHigherNum = $result['Num'];
    echo $countHigherNum;
?>