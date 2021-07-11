<?php

    /* fetch_procedures.php 
    The main goal of the possible procedures page is showing the comparison between procedures once a future algorythim processes the reduction in days and savings the patient would have choosing a procedure or another.
    
    This code fills the table in possible procedures. You must know that in the procedure_table in the LOS DB only the patient with patient_id='16' has data for PT and OT. The rest of the patients just have data for
    either PT or OT, that's the reason why the queries are made with 'WHERE patient_id='16' no matter what the patient selected in the dropdown was.'
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
            $reduction_dayspt = ROUND(exp(0.002*$treatment_duration),2);
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
            $reduction_daysot = ROUND(exp(0.0003*$treatment_duration),2);
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
            
            echo'<table class="table table-hover table-striped">
                                            <thead>
                                                <tr>
                                                  <th scope="col"></th>
                                                  <th scope="col">Occupational Therapy</th>
                                                  <th scope="col">Physical Therapy</th>
                                                </tr>
                                            </thead>
                                          <tbody>
                                             <tr>
                                              <th scope="row">Type of physical therapy performed</th>
                                              <td>'.$type_procedureot.'</td>
                                              <td>'.$type_procedurept.'</td>
                                            </tr>
                                            <tr>
                                              <th scope="row">Insurance Type</th>
                                              <td>'.$insuranceot.'</td>
                                              <td>'.$insurancept.'</td>
                                            </tr>
                                            <tr>
                                              <th scope="row">Procedure Cost Per Hour</th>
                                              <td><b style="font-weight:600" >$</b>'.$cost_procedure_hourot.'</td>
                                              <td><b style="font-weight:600" >$</b>'.$cost_procedure_hourpt.'</td>
                                            </tr>
                                            <tr>
                                              <th scope="row">Time Invested (min)</th>
                                              <td>'.$treatment_duration.'</td>
                                              <td>'.$treatment_duration.'</td>
                                            </tr>
                                            <tr>
                                              <th scope="row">Total cost of treatment</th>
                                              <td><b style="font-weight:600" >$</b>'.$treatment_costot.'</td>
                                              <td><b style="font-weight:600" >$</b>'.$treatment_costpt.'</td>
                                            </tr>
                                            <tr>
                                              <th scope="row">Reduction in LOS</th>
                                              <td>'.$reduction_daysot.'</td>
                                              <td>'.$reduction_dayspt.'</td>
                                            </tr>
                                            <tr>
                                              <th scope="row">Net Savings</th>
                                              <td><b style="font-weight:600" >$</b>'.$net_savingsot.'</td>
                                              <td><b style="font-weight:600" >$</b>'.$net_savingspt.'</td>
                                            </tr>
                                            </tbody>
                                        </table>';
?>