<?php

    /* method_maximum_reduction.php 
    Code used for the 2 cards with quick analysis. Extracts the procedure with the maximum reduction in days and cost.
    */
    
            $HOST = 'localhost';
            $DATABASE = 'LOSDB';
            $USER = 'bfokin';
            $PASSWORD = 'obSJX=a*Oyk}';
            $mysql = mysqli_connect($HOST,$USER,$PASSWORD,$DATABASE);
            
            $treatment_duration = $_GET['treat_duration'];
            
            //Query for physical therapy
            $query = "SELECT insurance_type, procedure_cost_per_hour, type_procedure, reduction_days, savings FROM procedure_table WHERE `procedure`='physical_therapy' AND patient_id='16'";
            $set = $mysql->query($query);
            $result = $set->fetch_assoc();
            
            //Get information of insurance_type, cost of procedure per hour, hours invested in the procedure, type of procedure, reduction in days and net savings.
            $insurancept = $result['insurance_type'];
            $cost_procedure_hourpt = number_format($result['procedure_cost_per_hour']);
            
            $treatment_costpt = ROUND(($cost_procedure_hourpt/60) * $treatment_duration, 2);
            $type_procedurept = $result['type_procedure'];
            $reduction_dayspt = exp(0.002*$treatment_duration);
            $savings = $reduction_dayspt*1325;
            $net_savingspt = number_format($savings-$treatment_costpt);
            
            //Query for occupational therapy
            $query = "SELECT insurance_type, minutes, procedure_cost_per_hour, type_procedure, reduction_days, savings FROM procedure_table WHERE `procedure`='occupational_therapy' AND patient_id='16'";
            $set = $mysql->query($query);
            $result = $set->fetch_assoc();
            
            //Get information of insurance_type, cost of procedure per hour, hours invested in the procedure, type of procedure, reduction in days and net savings.
            $insuranceot = $result['insurance_type'];
            $cost_procedure_hourot = number_format($result['procedure_cost_per_hour']);
            $treatment_costot = ROUND(($cost_procedure_hourot/60) * $treatment_duration,2);
            $type_procedureot = $result['type_procedure'];
            $reduction_daysot = exp(0.0003*$treatment_duration);
            $savings = $reduction_daysot*1325;
            $net_savingsot = number_format($savings-$treatment_costot);
            

        //For the two 'Quick analysis' cards
            //Method with maximum reduction in days
            if ($reduction_dayspt>$reduction_daysot){
                $max_reduction_days = 'Physical therapy';
            }else{
                $max_reduction_days = 'Occupational Therapy';
            }
            
            //Method with maximum reduction in cost
            if ($net_savingspt>$net_savingsot){
                $max_reduction_cost = 'Physical therapy';
            }else{
                $max_reduction_cost = 'Occupational Therapy';
            }
            
            echo json_encode (array($max_reduction_days,$max_reduction_cost));
?>