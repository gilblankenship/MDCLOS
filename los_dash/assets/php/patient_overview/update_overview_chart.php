<?php
    // establish the database connection
    $HOST = 'localhost';
    $DATABASE = 'LOSDB';
    $USER = 'bfokin';
    $PASSWORD = 'obSJX=a*Oyk}';
    
    $mysql = mysqli_connect($HOST,$USER,$PASSWORD,$DATABASE);
    
    // pull the patient id from the GET fields
    $patient_id = $_GET['patient_id'];
    
    $query = "SELECT * FROM estimation_table WHERE patient_id = '$patient_id'";
    $result = mysqli_query($mysql, $query);
    $row = mysqli_fetch_array($result);    

    //If the patient has data created in the estimation table
    if($row) {     
        
        if ($patient_id != "") {
        
            // STEP 1: Get the estimate curve
            
            // get the patient's entry and exit dates
            $query = "select min(id) as id, entry_date, est_los 
                      from estimation_table where patient_id='$patient_id'";
            $row = $mysql->query($query)->fetch_assoc();;
            
            // retrieve values from the query
            $id = $row['id'];
            $entry_date = date('m/d/Y', strtotime($row['entry_date']));
            $est_los = $row['est_los'];
            
            // calculate the estimated exit date from the values
            $est_exit_date = date('m/d/Y', strtotime($entry_date. " + $est_los days"));
            
            // create the data array to be exported
            $est_curve = [['x'=>$entry_date, 'y'=> $est_los], ['x'=>$est_exit_date, 'y'=> 0]];
        
        
        
            // STEP 2: Get the updates curve
            $query = "select action_date, new_est_los from supplemental_action_table
                      where id=$id";
            $set = $mysql->query($query);
            
            $update_curve = [['x'=>$entry_date, 'y'=> $est_los]];
            
            while ($row = $set->fetch_assoc()) {
                $action_date = date('m/d/Y', strtotime($row['action_date']));
                $new_est_los = $row['new_est_los'];
                
                array_push($update_curve, ['x'=>$action_date, 'y'=>$new_est_los]);
            }
            
            // figure out the admission id for the patient
            $query = "select min(id) as id from estimation_table where patient_id='$patient_id'";
            $id = $mysql->query($query)->fetch_assoc()['id'];
            
            // retrieve all supplemental actions
            $query = "select supp_action, comment, action_date, new_est_los from
                      supplemental_action_table where id=$id order by action_date desc";
            $set = $mysql->query($query);
            
            // ensures the first HTML element doesn't have an <hr> at the start
            $first = true;
            
            // we have two outputs, an HTML element and an array containing the
            // progression items (for annotations)
            $html_result = "";
            $arr_result = [];
            
            while ($row = $set->fetch_assoc()) {
                // get all the values from the row
                
                if ($row['supp_action'] == 'physical_therapy') {
                    $supp_action = 'Physical therapy session';
                } else if ($row['supp_action'] == 'sw_visit') {
                    $supp_action = 'Social worker session';
                } else if ($row['supp_action'] == 'occ_therapy') {
                    $supp_action = 'Occupational therapy session';
                } else if ($row['supp_action'] == 'stable_dis') {
                    $supp_action = 'Patient marked stable for discharge';
                } else if ($row['supp_action'] == 'discharged') {
                    $supp_action = 'Patient discharged';
                }
                
                $comment = $row['comment'];
                $action_date = date('F j, Y', strtotime($row['action_date']));
                $new_est_los = $row['new_est_los'];
                
                // arr_result items are formatted as [action, date]
                array_push($arr_result, [$row['supp_action'], date('m/d/Y', strtotime($row['action_date']))]);
                
                if ($first) {
                    $first = false;
                } else {
                    $html_result = $html_result."<hr>";
                }
                $html_result = $html_result."<dl class='row'>
                                       <dt class='col-sm-4'>Date</dt>
                                       <dd class='col-sm-8'>$action_date</dd>
                                       
                                       <dt class='col-sm-4'>New Est. LOS</dt>
                                       <dd class='col-sm-8'>$new_est_los days</dd>
                                       
                                       <dt class='col-sm-4'>Action Taken</dt>
                                       <dd class='col-sm-8'>$supp_action</dd>
                                       
                                       <dt class='col-sm-4'>Comment</dt>
                                       <dd class='col-sm-8'>$comment</dd>
                                   </dl>";
            }
            
            // output the result data array.... in the order [chart, prog]
            echo json_encode([[$update_curve, $est_curve], [$html_result, $arr_result]]);
        
        } else {
            echo json_encode([[],[]]);
        }
    }
    
    else {
     // output the result data array.... in the order [chart, prog]
            echo json_encode([[[],[]],["",[]]]); 
    }
    
 
    
?>