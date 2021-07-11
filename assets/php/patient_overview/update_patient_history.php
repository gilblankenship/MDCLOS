<?php

    $HOST = 'localhost';
    $DATABASE = 'LOSDB';
    $USER = 'bfokin';
    $PASSWORD = 'obSJX=a*Oyk}';
    
    $id = $_POST["id"]; 
           
    $mysql = mysqli_connect($HOST,$USER,$PASSWORD,$DATABASE);
    $query = "SELECT * FROM estimation_table WHERE patient_id = '$id' ORDER BY id
                    ";
    $result = mysqli_query($mysql, $query);
         
    $row = mysqli_fetch_array($result);
         
    if ($row) {  
        
        while($row) {
            $data = "";  
            
            $date_created = strval($row["entry_date"]);
            $date_created = strtotime($date_created);
            $date_created = date("m-d-Y", $date_created);

    
                      echo '
                      <hr class = "section_divider"/>';
                      
                      if ($row["model_number"] === '1'){
                         echo'
                            <p class="font-weight-bold" style="float: left; text-align: left;"> 
                                    Pre-OP Variable Estimated LOS : '.$row["est_los"].' Days
                            </p> 
                            <p class="font-weight-light font-italic" 
                                style=" text-align: right; font-size: 15px;">Data Created (m-d-y) : '.$date_created.'
                            </p>
                            ';
                            echo '</br>';
                    
                        
                        $data .= 'GCS: '.$row["gcs"].' || ';
                        $data .= 'ASA: '.$row["asa"].' || ';
                        $data .= 'Neuro: '.$row["neurological_status"].' || ';
                        $data .= ($row["polytrauma"] == 1)? 'Polytrauma || ': 'No Polytrauma || ';
                        $data .= 'ISS: '.$row["iss"].' || ';
                        
                        echo '<p class="font-weight-light" style = "text-align: left; font-size: 15px"> 
                                    '.$data.'
                            </p>';
                      }
                      else {
                        echo'
                            <p class="font-weight-bold">
                            <p class="font-weight-bold" style="float: left; text-align: left;"> 
                                    All Variable Estimated LOS : '.$row["est_los"].' Days
                            </p> 
                            <p class="font-weight-light font-italic" 
                                style=" text-align: right; font-size: 15px;">Data Created (m-d-y) : '.$date_created.'
                            </p>'
                            ;
                        echo '</br>';
                            
                        $data .= 'GCS: '.$row["gcs"].' || ';
                        $data .= 'ASA: '.$row["asa"].' || ';
                        $data .= 'Neuro: '.$row["neurological_status"].' || ';
                        $data .= ($row["polytrauma"] == 1)? 'Polytrauma || ': 'No Polytrauma || ';
                        $data .= '# Complications: '.$row["num_complications"].' || ';

                        echo '<p class="font-weight-light" style = "font-size: 15px"> 
                                    '.$data.'
                            </p>';
                        $data = '';
                        
                        $data .= ($row["prbc_transfusion"] == 1)? 'Transfusion || ': 'No Transfusion || ';
                        $data .= ($row["skin_complication"] == 1)? 'Skin Complication || ': 'No Skin Complication || ';
                        $data .= ($row["discharge_facility"] != NULL)? 'Discharge Facility: '.$row["discharge_facility"].' || ': '';
                        
                        echo '<p class="font-weight-light" style = "font-size: 15px"> 
                                    '.$data.'
                            </p>';    
                      }
                      
                      
                      echo '
                      <p class="font-weight-light font-italic" style = "font-size: 15px"
                                    align="right"> 
                                        ID: '.$row["id"].'
                      </p>';
                     
                      $row = mysqli_fetch_array($result);
                 }
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