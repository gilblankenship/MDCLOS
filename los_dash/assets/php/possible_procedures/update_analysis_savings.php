<?php
    /* update_analysis_savings.php 
    Used in 'Analysis of procedures by net savings'. Calculates the Net savings per method. This code calculates the total cost per method and substracts that to the savings, obtaining then the Net Savings. */
    
    $HOST = 'localhost';
    $DATABASE = 'LOSDB';
    $USER = 'bfokin';
    $PASSWORD = 'obSJX=a*Oyk}';
    $mysql = mysqli_connect($HOST,$USER,$PASSWORD,$DATABASE);
    
    // Get the savings per procedure
            $ns_ot = "SELECT AVG(savings) FROM procedure_table ";
            $net_savings_ot = $ns_ot.'WHERE `procedure`="occupational_therapy"';
            $net_savings_pt = $ns_ot.'WHERE `procedure`="physical_therapy"';
            
            $result = mysqli_query($mysql, $net_savings_ot);
            $row = mysqli_fetch_array($result);
            $ot_savings = $row['AVG(savings)'];
            
            $result = mysqli_query($mysql, $net_savings_pt);
            $row = mysqli_fetch_array($result);
            $pt_savings = $row['AVG(savings)'];
            
    //Reduction in cost (Savings - Cost of treatment)
            
        //Occupational Therapy   
            $avg_cost_ot = "SELECT procedure_cost_per_hour,minutes FROM procedure_table WHERE `procedure`='occupational_therapy'";
            $result = mysqli_query($mysql, $avg_cost_ot);
            
            //Array for storing the cost of treatment per patient
            $total_cost_per_ot = []; 
            
            //Push into an array the values
            while( $row = mysqli_fetch_array($result)) {
                $total_cost_ot = ($row['procedure_cost_per_hour']/60)*($row['minutes']);
                array_push($total_cost_per_ot, $total_cost_ot);
            }
            
            //Calculate the Therapist's avg cost
            $avg_total_cost_ot = array_sum($total_cost_per_ot) / count($total_cost_per_ot);
            //Net savings
            $ot_avg_reduction_cost = ($ot_savings)-($avg_total_cost_ot);
        
        
        //Physical therapy
            $avg_cost_pt = "SELECT procedure_cost_per_hour,minutes FROM procedure_table WHERE `procedure`='physical_therapy'";
             $result = mysqli_query($mysql, $avg_cost_pt);
             
            //Array for storing the cost of treatment per patient
            $total_cost_per_therapist = []; 
            
            //Push into an array all the values
            while( $row = mysqli_fetch_array($result)) {
                $total_cost_pt = ($row['procedure_cost_per_hour']/60)*$row['minutes'];
                array_push($total_cost_per_therapist, $total_cost_pt);
            }
            
            //Calculate the Therapist's avg cost
            $avg_total_cost_pt = array_sum($total_cost_per_therapist) / count($total_cost_per_therapist);
            //Net Savings
            $pt_avg_reduction_cost = ($pt_savings)-($avg_total_cost_pt);
    
    echo json_encode (array(array(ROUND($ot_avg_reduction_cost,2)),array(ROUND($pt_avg_reduction_cost,2))));
?>