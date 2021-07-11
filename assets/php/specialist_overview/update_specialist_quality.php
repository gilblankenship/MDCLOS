<?php

    /*update_specialist_quality.php 
    Used in the quality analysis table comparing the reduction factor and savings of one therapist vs all therapists
    */
    
    //DB connection
    $HOST = 'localhost';
    $DATABASE = 'LOSDB';
    $USER = 'bfokin';
    $PASSWORD = 'obSJX=a*Oyk}';
    $mysql = mysqli_connect($HOST,$USER,$PASSWORD,$DATABASE);

    //Get the Specialist ID from the AJAX call
    $id = $_GET['id'];
    
    /*The table compares between the currently selected Specialist and All Specialists*/
    
    //FIRST ROW
        //Query for 'selected specialist'
            $query = "SELECT * FROM procedure_table WHERE specialist_id = '$id' 
                            ";
            $result = mysqli_query($mysql, $query);
            $row = mysqli_fetch_array($result);
            
            //Check the user's procedure (Occupational Therapist or Physical Therapist)
            $procedure = $row["procedure"];
            
            //Calculate the Avg. reduction factor of the selected speccialist
                    $reduction_fact_therapist = []; //Array for storing the reduction factor
                    
                    //Push into an array all the reduction factors
                    while( $row = mysqli_fetch_array($result)) {
                        $rf_therapist = $row["reduction_days"]/($row["minutes"]/15);
                        array_push($reduction_fact_therapist, $rf_therapist);
                    }
                    //Calculate the Therapist's avg reduction in LOS per hour
                    $reduction_in_los_per_hour_therapist = array_sum($reduction_fact_therapist) / count($reduction_fact_therapist);
                    
        
        //Query for 'all therapists'
            $query = "SELECT * FROM procedure_table";
                            
            if ($procedure == 'occupational_therapy'){
                $end_query = $query." WHERE `procedure`='occupational_therapy'";
            }else{
                $end_query = $query." WHERE `procedure`='physical_therapy'";
            }
            
            $result = mysqli_query($mysql, $end_query);
            
            //Calculate the Avg. reduction factor of all specialists
                $reduction_fact_all_therapists = []; //Array for storing the reduction factor
            
                    //Push into an array all the reduction factors
                    while($row = mysqli_fetch_array($result)) {
                        $rf_all = $row["reduction_days"]/($row["minutes"]/15);
                        array_push($reduction_fact_all_therapists, $rf_all);
                    }
                    //Calculate the Therapist's avg reduction in LOS per hour
                    $reduction_in_los_per_hour_all_therapists = array_sum($reduction_fact_all_therapists) / count($reduction_fact_all_therapists);
                    
    
    //SECOND ROW
        //Query therapist savings
            $query = "SELECT AVG(savings),AVG(reduction_days),AVG(minutes) FROM procedure_table WHERE specialist_id = '$id' 
                            ";
            $result = mysqli_query($mysql, $query);
            $row = mysqli_fetch_array($result);
            $net_savings_therapist = $row["AVG(savings)"];
            $reduction_days_therapist = $row["AVG(reduction_days)"];
            $treatment_duration_therapist = $row["AVG(minutes)"];
    
        //Query all therapists savings
            $query = "SELECT AVG(savings),COUNT(specialist_id),AVG(reduction_days),AVG(minutes) FROM procedure_table 
                            ";
            if ($procedure == 'occupational_therapy'){
                $end_query = $query."WHERE `procedure`='occupational_therapy'";
            }else{
                $end_query = $query."WHERE `procedure`='physical_therapy'";
            }
            
            $result = mysqli_query($mysql, $end_query);
            $row = mysqli_fetch_array($result);
            $net_savings_all_therapists = $row["AVG(savings)"];
            $reduction_days_all_therapists = $row["AVG(reduction_days)"];
            $treatment_duration_all_therapists = $row["AVG(minutes)"];
            
            $number_therapists = $row["COUNT(specialist_id)"]; //Number of specialists
            
    
    //TABLE 
    if ($procedure == 'physical_therapy'){
        echo'<table class="table table-hover">
                        <thead>
                            <tr>
                              <th scope="col"></th>
                              <th scope="col">Physical Therapist</th>
                              <th scope="col">All P. Therapists ('.$number_therapists.')</th>
                            </tr>
                        </thead>
                      <tbody>
                          <tr>
                          <th scope="row">Avg. LOS Reduction Factor </th>
                          <td>'.ROUND($reduction_in_los_per_hour_therapist,2).'</td>
                          <td>'.ROUND($reduction_in_los_per_hour_all_therapists,2).'</td>
                        </tr>
                        
                        <tr>
                          <th scope="row">Avg. Savings </th>
                          <td><b style="font-weight:600">$</b>'.number_format($net_savings_therapist).'</td>
                          <td><b style="font-weight:600">$</b>'.number_format($net_savings_all_therapists).'</td>
                        </tr>
                        
                        <tr>
                          <th scope="row" class="text-left">Avg. Reduction In Days </th>
                          <td class="text-left">'.ROUND($reduction_days_therapist,3).'</td>
                          <td class="text-left">'.ROUND($reduction_days_all_therapists,3).'</td>
                        </tr>
                        
                        <tr>
                          <th scope="row" class="text-left">Avg. Treatment Duration </th>
                          <td class="text-left">'.ROUND($treatment_duration_therapist,2).'</td>
                          <td class="text-left">'.ROUND($treatment_duration_all_therapists,2).'</td>
                        </tr>
                    </tbody>
                </table>';
    }else{
        echo'<table class="table table-hover">
                        <thead>
                            <tr>
                              <th scope="col" class="text-left"></th>
                              <th scope="col" class="text-left">Occupational Therapist</th>
                              <th scope="col" class="text-left">All O. Therapists ('.$number_therapists.')</th>
                            </tr>
                        </thead>
                      <tbody>
                          <tr>
                          <th scope="row" class="text-left">Avg. LOS Reduction Factor </th>
                          <td class="text-left">'.ROUND($reduction_in_los_per_hour_therapist,3).'</td>
                          <td class="text-left">'.ROUND($reduction_in_los_per_hour_all_therapists,3).'</td>
                        </tr>
                        
                        <tr>
                          <th scope="row" class="text-left">Avg. Savings </th>
                          <td class="text-left"><b style="font-weight:600" >$</b>'.number_format($net_savings_therapist).'</td>
                          <td class="text-left"><b style="font-weight:600" >$</b>'.number_format($net_savings_all_therapists).'</td>
                        </tr>
                        
                        <tr>
                          <th scope="row" class="text-left">Avg. Reduction In Days </th>
                          <td class="text-left">'.ROUND($reduction_days_therapist,3).'</td>
                          <td class="text-left">'.ROUND($reduction_days_all_therapists,3).'</td>
                        </tr>
                        
                        <tr>
                          <th scope="row" class="text-left">Avg. Treatment Duration </th>
                          <td class="text-left">'.ROUND($treatment_duration_therapist,2).'</td>
                          <td class="text-left">'.ROUND($treatment_duration_all_therapists,2).'</td>
                        </tr>
                    </tbody>
                </table>';
    }
                    
    
?>