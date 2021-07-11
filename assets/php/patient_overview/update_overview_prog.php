<?php
    // establish the database connection
    $HOST = 'localhost';
    $DATABASE = 'LOSDB';
    $USER = 'bfokin';
    $PASSWORD = 'obSJX=a*Oyk}';
    
    $mysql = mysqli_connect($HOST,$USER,$PASSWORD,$DATABASE);
    
    // pull the patient id from the GET fields
    $patient_id = $_GET['patient_id'];
    
    if ($patient_id != "") {
    
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
            $supp_action = $row['supp_action'] == 'physical_therapy' ? 'Began physical therapy' : 'Assigned a social worker';
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
        
        echo json_encode([$html_result, $arr_result]);
    
    } else {
        echo json_encode(['None yet!', []]);
    }
?>