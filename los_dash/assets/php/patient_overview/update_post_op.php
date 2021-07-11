<?php

function dateDifference($date_1 , $date_2 , $differenceFormat = '%r%a' )
{
    $datetime1 = date_create($date_1);
    $datetime2 = date_create($date_2);
   
    $interval = date_diff($datetime1, $datetime2);
   
    return $interval->format($differenceFormat);
   
}
  


    $HOST = 'localhost';
    $DATABASE = 'LOSDB';
    $USER = 'bfokin';
    $PASSWORD = 'obSJX=a*Oyk}';
    $mysql = mysqli_connect($HOST,$USER,$PASSWORD,$DATABASE);

    
    $id = $_GET['id'];
    
    $query = "SELECT * FROM estimation_table WHERE patient_id = '$id' AND model_number = '2' ORDER BY id ASC
                    ";
    $result = mysqli_query($mysql, $query);
    $row = mysqli_fetch_array($result);
    
    
    if ($row != NULL) {
        
        echo '
            <table class="table table-hover">
                <tbody>
                    <tr>
                    <th scope="row">Ticket ID : </th>
                    <td>'.$row["id"].'</td>
                    </tr>
                    <tr>
            ';

        // Shows the patient's entry date
        $entry_day = strval($row["entry_date"]);
        $temp = $entry_day;
        $entry_day = strtotime($entry_day);
        $entry_day = date("m-d-Y", $entry_day);
        echo '<th scope="row">Ticket Created (m-d-y) :</th>
                <td>'.$entry_day.'</td>
                </tr>
                <tr>
            ';
        
        // Shows estimated LOS
        $est_los = strval($row["est_los"]);
        echo '<th scope="row">Estimated LOS in Day(s):</th>
                <td>'.$est_los.'</td>
                </tr>
                <tr>
            ';
        
        
        // Shows estimated discharge
        $est_dis = strval(date('m-d-Y', strtotime($temp. ' + '. $est_los. 'days')));
        $temp = strval(date('Y-m-d', strtotime($temp. ' + '. $est_los. 'days')));
        echo '<th scope="row">Estimated Discharge (m-d-y):</th>
                <td>'.$est_dis.'</td>
                </tr>
                <tr>
                ';
        
        // Shows days left 
        $temp_2 =  strval(date('Y-m-d'));
        $days_remaining = dateDifference($temp_2,$temp);
        
        // If there is an exit date
        if ($row['exit_date'] != NULL) {
            $exit_date = strval($row["exit_date"]);
            $exit_date = strval(date('Y-m-d', strtotime($exit_date)));
            $exit_v_los = dateDifference($temp,$exit_date);
            
            if ($exit_v_los > 0) {
                echo '<th scope="row">Days LOS was underestimated by : </th>
                        <td>'.$exit_v_los.'</td>
                        </tr>
                        <tr>
                    ';                  
            }
            else if ($exit_v_los < 0 ){
                echo '<th scope="row">Days LOS was overestimated by by : </th>
                        <td>'.abs($exit_v_los).'</td>
                        </tr>
                        <tr>
                    ';                
            } 
            else {
                echo '<th scope="row">LOS estimation was correct</th>
                        </tr>
                        <tr>
                    ';                 
            }
        
        }
        
        // If there is no exit date
        else {
            if ($days_remaining < 0) {
                echo '<th scope="row">Days LOS was underestimated by : </th>
                        <td>'.abs($days_remaining).'</td>
                        </tr>
                        <tr>
                        ';
            }
            else {
                echo '<th scope="row">Days Remaining : </th>
                        <td>'.$days_remaining.'</td>
                        </tr>
                        <tr>
                        ';
            }            
        }
        echo '</tbody>
                </table>';        
    }
    
    else {
        // Shows the patient's entry date
        echo '
            <table class="table table-hover">
                <tbody>
                    <th scope="row"></th>
                    <td>No Data Avalible for POST-OP Analysis</td>
                    </tr>
                    <tr>
            </tbody>
            </table>
                ';
    }
?>