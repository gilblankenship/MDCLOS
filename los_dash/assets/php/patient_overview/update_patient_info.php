<?php

    function dateDiffInDays($date1, $date2) { 
        // Calculating the difference in timestamps 
        $diff = strtotime($date2) - strtotime($date1); 
          
        // 1 day = 24 hours  
        // 24 * 60 * 60 = 86400 seconds  
        return $diff / 86400.00;  
    }  
  


    $HOST = 'localhost';
    $DATABASE = 'LOSDB';
    $USER = 'bfokin';
    $PASSWORD = 'obSJX=a*Oyk}';
    $mysql = mysqli_connect($HOST,$USER,$PASSWORD,$DATABASE);

    
    $id = $_GET['id'];
    
    $query = "SELECT * FROM estimation_table WHERE patient_id = '$id'";
    $result = mysqli_query($mysql, $query);
    $row = mysqli_fetch_array($result);
    
    //If the patient has data created in the estimation table
    if($row) {    
    
        $query = "SELECT * FROM estimation_table WHERE patient_id = '$id' AND exit_date IS NOT NULL ORDER BY id DESC
                        ";
        $result = mysqli_query($mysql, $query);
        $row = mysqli_fetch_array($result);
        
        echo '
            <table class="table table-hover">
            <tbody>
            ';
        
        // patient has not been discharged
        if ($row == NULL) {
            
            $query = "SELECT * FROM patient_table WHERE patient_id = '$id'
                            ";
            $result = mysqli_query($mysql, $query);
            $row = mysqli_fetch_array($result); 
            
            echo '
                        <tr>
                        <th scope="row">MRN : </th>
                        <td>'.$row["mrn"].'</td>
                        </tr>
                        <tr>
                ';
    
            echo '<th scope="row">Admission Time Stamp (y-m-d):</th>
                    <td>'.$row["admin_date"].'</td>
                    </tr>
                    <tr>
                ';
                    
            
            if ($row["transfer"] != NULL) {
                $transfer = ($row["transfer"] == 1)? 'Outside Transfer': 'Direct to Trauma Center';
    
                echo '<th scope="row">Patient Transfer Status :</th>
                        <td>'.$transfer.'</td>
                        </tr>
                        <tr>
                    ';            
            }
            
            //shows patient's age/sex
            echo ' <th scope="row">DOB (y-m-d):</th>
                        <td>'.$row["dob"].'</td>
                        </tr>
                        <tr>
                        
                    <th scope="row">Sex :</th>
                        <td>'.$row["gender"].'</td>
                        </tr>
                        <tr>
                        
                    <th scope="row">BMI :</th>
                        <td>'.$row["bmi"].'</td>
                        </tr>
                        <tr>
                        
                    <th scope="row">Insurance Coverage :</th>
                        <td>'.$row["insurance"].'</td>
                        </tr>
                        <tr>       
                    ';
            
            // Shows patient status
            echo ' <th scope="row">Status :</th>
                        <td>ACTIVE</td>
                        </tr>
                ';
            
        }
        
        //patient has been discharged
        else {
    
            // Shows the patient's entry date
    
            $exit_day = strval($row["exit_date"]);
            $exit_day = strtotime($exit_day);
            $exit_day = date("m-d-Y", $exit_day);
            
            $query = "SELECT * FROM patient_table WHERE patient_id = '$id'
                            ";
            $result = mysqli_query($mysql, $query);
            $row = mysqli_fetch_array($result); 
            
            echo '
                        <tr>
                        <th scope="row">MRN : </th>
                        <td>'.$row["mrn"].'</td>
                        </tr>
                        <tr>
                ';
    
            echo '<th scope="row">Admission Time Stamp (y-m-d):</th>
                    <td>'.$row["admin_date"].'</td>
                    </tr>
                    <tr>
                ';
                
            $query = "SELECT * FROM patient_table WHERE patient_id = '$id'
                            ";
            $result = mysqli_query($mysql, $query);
            $row = mysqli_fetch_array($result); 
            
            if ($row["transfer"] != NULL) {
                $transfer = ($row["transfer"] == 1)? 'Outside Transfer': 'Direct to Trauma Center';
    
                echo '<th scope="row">Patient Transfer Status :</th>
                        <td>'.$transfer.'</td>
                        </tr>
                        <tr>
                    ';            
            }
            
            //shows patient's age/sex/bmi/insurance type
            echo ' <th scope="row">DOB (y-m-d):</th>
                        <td>'.$row["dob"].'</td>
                        </tr>
                        <tr>
                        
                    <th scope="row">Sex :</th>
                        <td>'.$row["gender"].'</td>
                        </tr>
                        <tr>
                        
                    <th scope="row">BMI :</th>
                        <td>'.$row["bmi"].'</td>
                        </tr>
                        <tr>
                        
                    <th scope="row">Insurance Coverage :</th>
                        <td>'.$row["insurance"].'</td>
                        </tr>
                        <tr>    
                    ';
    
            echo ' <th scope="row">Status :</th>
                        <td>DISCHARGED</td>
                        </tr>
                        <tr>
                    ';
                    
            echo '<th scope="row">Discharged (m-d-y) :</th>
                    <td>'.$exit_day.'</td>
                    </tr>
                    <tr>
                    ';
        }
        echo '
                </tbody>
                </table>
                    ';
    }
    
    else {
        // Shows the patient's entry date
        echo '
            <table class="table table-hover">
                <tbody>
                    <th scope="row"></th>
                    <td>No Data Avalible</td>
                    </tr>
                    <tr>
            </tbody>
            </table>
                ';
    }
    
?>