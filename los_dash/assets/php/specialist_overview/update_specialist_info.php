<?php
    
    /* update_specialist_info.php 
    Code to update the information regarding the specialists. Creates a table that shows their ID, Type, Associated Medical Center and Phone Number
    */
  
    $HOST = 'localhost';
    $DATABASE = 'LOSDB';
    $USER = 'bfokin';
    $PASSWORD = 'obSJX=a*Oyk}';
    $mysql = mysqli_connect($HOST,$USER,$PASSWORD,$DATABASE);
    
    //Get selected specialist ID from AJAX call
    $id = $_GET['id'];
    
    //Query information regarding the selected 'id'
    $query = "SELECT * FROM specialist_table WHERE specialist_id = '$id'";
    $result = mysqli_query($mysql, $query);
    $row = mysqli_fetch_array($result);
        
        //Table with the info:
        echo '
            <table class="table table-hover">
                <tbody>
                    <tr>
                    <th scope="row">ID : </th>
                    <td>'.$id.'</td>
                    </tr>
                    <tr>
                    <th scope="row">Type : </th>
                    <td>'.$row["procedure_performed"].'</td>
                    </tr>
                    <tr>
                    <th scope="row">Associated medical center : </th>
                    <td>'.$row["medical_center"].'</td>
                    </tr>
                    <tr>
                    <th scope="row">Phone Number : </th>
                    <td>'.$row["phone_number"].'</td>
                    </tr>
                    
                </tbody>
            </table>
                ';
?>