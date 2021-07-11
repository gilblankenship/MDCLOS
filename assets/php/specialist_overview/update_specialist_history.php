<?php
    
    /* update_specialist_history.php 
    Code to update the history regarding the past treated patients by the specialist. Inside the card the ID of the patient will appear, together with the 'reduction in days','hours in treatment' and
    Reduction factor (LOS reduced by hours of treatment)
    */
    
    $HOST = 'localhost';
    $DATABASE = 'LOSDB';
    $USER = 'bfokin';
    $PASSWORD = 'obSJX=a*Oyk}';
    
    //Get the Specialist ID from the AJAX call
    $id = $_GET['id'];
           
    $mysql = mysqli_connect($HOST,$USER,$PASSWORD,$DATABASE);
    //Query with a particular id
    $query = "SELECT * FROM procedure_table WHERE specialist_id = '$id'";
    $result = mysqli_query($mysql, $query);
    
    //Count the number of patients treated by that specialist and print it
    $query_num = "SELECT COUNT(`patient_id`) FROM procedure_table WHERE specialist_id = '$id'";
    $set = $mysql->query($query_num);
    $result_num = $set->fetch_assoc();
    $total_patients_treated = $result_num['COUNT(`patient_id`)'];
    echo '<h4>Total # of patients: '.$total_patients_treated.'</h4> ';

    //List of patients:                        
    while( $row = mysqli_fetch_array($result)) {
        
                      //Stripped line divider
                          echo '
                          <hr class = "section_divider"/>';
                      
                      //Patient treated & Reduction in days
                         echo'
                            <h4 style="float: left; font-size: 18px; text-align: left; font-weight:500;"> 
                                    Patient ID : '.$row["patient_id"].' 
                            </h4>
                            <p class="font-weight-light font-italic" 
                                style=" text-align: right; font-size: 15px;">Reduction in days : '.ROUND($row["reduction_days"],2).'
                            </p>
                            ';
                            
                        //Line divider
                        echo'<br>';
                        
                        //Calculate reduction factor
                        $sessions_15min = $row["minutes"]/15;
                        $reduction_factor = $row["reduction_days"]/$sessions_15min;
                        
                        //Print: Type of procedure, Duration of treatment & Reduction Factor
                        echo '
                        <p style = "text-align: left; font-size: 15px; font-family: "Lato", sans-serif;"><b style="font-weight:600;">Type of procedure :</b> '.$row["type_procedure"].'
                            </p>
                        <p style = "text-align: left; font-size: 15px; font-family: "Lato", sans-serif;"><b style="font-weight:600;">Treatment duration :</b> '.$row["minutes"].' minutes
                            </p>
                        <p style = "text-align: left; font-size: 15px; font-family: "Lato", sans-serif;"><b style="font-weight:600;"> Reduction factor [Day/s reduced by every 15 mins of treatment] :</b> '.(ROUND($reduction_factor,1)).'
                            </p>
                        
                        ';
                        
        }
        
    

?>