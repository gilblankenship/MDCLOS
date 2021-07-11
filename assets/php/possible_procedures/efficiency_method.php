<?php

    /* EFFICIENCY PER METHOD 
     This php code works on the efficiency per method graph. In this graph we will be able to see which method saves more money per dolar invested in treatment. 
     Therefore, in order to obtain this efficiency ratio, we will be dividing the Net Savings (Savings - Cost of treatment)/Cost of treatment.
     
     In order to calculate the cost of treatment = cost of treatment per hour * hours invested.*/
 
    $HOST = 'localhost';
    $DATABASE = 'LOSDB';
    $USER = 'bfokin';
    $PASSWORD = 'obSJX=a*Oyk}';
    $mysql = mysqli_connect($HOST,$USER,$PASSWORD,$DATABASE);
    
    //For just one patient
        //Occupational Therapy
            $avg_cost_ot_p = "SELECT savings, procedure_cost_per_hour, minutes FROM procedure_table WHERE `procedure`='occupational_therapy' AND patient_id='16'";
            $set = $mysql->query($avg_cost_ot_p);
            $result = $set->fetch_assoc();
            
            //Total cost of treatment of this social worker
            $cost_sw_personal = ($result['procedure_cost_per_hour']/60)*($result['minutes']);
            //Savings with this social worker
            $savings_ot = $result['savings'];
            //Net savings/Total cost
            $factor_ot = ($savings_ot - $cost_sw_personal)/$cost_sw_personal;
            
        
        //Physical therapy
            $avg_cost_pt_p = "SELECT savings, procedure_cost_per_hour, minutes FROM procedure_table WHERE `procedure`='physical_therapy' AND patient_id='16'";
            $set = $mysql->query($avg_cost_pt_p);
            $result = $set->fetch_assoc();
            
            //Total cost of treatment of this physical therapist
            $cost_pt_personal = ($result['procedure_cost_per_hour']/60)*($result['minutes']);
            //Savings with this physical therapist
            $savings_pt = $result['savings'];
            //Net savings/Total cost
            $factor_pt = ($savings_pt - $cost_pt_personal)/$cost_pt_personal;
        
    //For all the patients
        //SAVINGS
            $ns_ot = "SELECT AVG(savings) FROM procedure_table ";
            $savings_ot = $ns_ot.'WHERE `procedure`="occupational_therapy"';
            $savings_pt = $ns_ot.'WHERE `procedure`="physical_therapy"';
            
            $set = $mysql->query($savings_ot);
            $result = $set->fetch_assoc();
            $ot_savings = $result['AVG(savings)'];
            
            $set = $mysql->query($savings_pt);
            $result = $set->fetch_assoc();
            $pt_savings = $result['AVG(savings)'];
            
        //Occupational therapy    
            $avg_cost_ot = "SELECT procedure_cost_per_hour,minutes FROM procedure_table WHERE `procedure`='occupational_therapy'";
            $result = mysqli_query($mysql, $avg_cost_ot);
            //Array for storing the cost of treatment per patient
            $total_cost_per_ot = []; 
            //Push into an array the values
            while( $row = mysqli_fetch_array($result)) {
                $total_cost_ot = ($row['procedure_cost_per_hour']/60)*($row['minutes']);
                array_push($total_cost_per_ot, $total_cost_ot);
            }
            //Calculate the ot's avg cost
            $avg_total_cost_ot = array_sum($total_cost_per_ot) / count($total_cost_per_ot);
            
            $factor_all_ot = ($ot_savings - $avg_total_cost_ot)/$avg_total_cost_ot;

        
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
            $factor_all_pt = ($pt_savings - $avg_total_cost_pt)/$avg_total_cost_pt;
        
    
    echo json_encode (array(array(ROUND($factor_ot,2),ROUND($factor_pt,2)),array(ROUND($factor_all_ot,2),ROUND($factor_all_pt,2))));
?>