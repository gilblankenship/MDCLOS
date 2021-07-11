<!--
        'patient_overview.php'
-->
<!DOCTYPE html> <!-- HTML5 -->
<html lang="en">
    <head>
        <!-- specifiers to set page characteristics -->
        <meta http-equiv="Content-Type" content="text/html; charset=shift_jis">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <!-- icon and title in the page tag -->
        <link rel="icon" type="image/png" href="./assets/img/icon60.png">
        <title>Patient Overview</title> 

        <!-- Bootstrap core CSS -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" 
        integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
        
         <!-- Bootstrap datepicker CSS -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css"/>
        
        <!-- custom styles for this page -->
        <link href="./assets/css/main.css" rel="stylesheet">


        <!-- extra styling provided by Bootstrap -->
        <style>
            .bd-placeholder-img {
                font-size: 1.125rem;
                text-anchor: middle;
                -webkit-user-select: none;
                -moz-user-select: none;
                -ms-user-select: none;
                user-select: none;
            }
            @media (min-width: 768px) {
            .bd-placeholder-img-lg {
                    font-size: 3.5rem;
                }
            }
            
            /* controls floating button for discharges */
            .float-dis {
                position: fixed;
                right: -175px;
                top: 150px;
                transition: all 0.15s ease-in 0s;
                z-index: 9999;
                cursor: pointer;
            }
            
            .float-dis:hover {
                right: -10px;
            }
            
            /* controls floating button for supplemental actions */
            .float-supp {
                position: fixed;
                right: -210px;
                top: 210px;
                transition: all 0.15s ease-in 0s;
                z-index: 9999;
                cursor: pointer;
            }
            
            .float-supp:hover {
                right: -10px;
            }
        </style>
    </head>
  
    <body>
        <!-- set the timezone to EST -->
        <!-- this is utilized for auto-filling time fields in the forms -->
        <?php date_default_timezone_set('America/New_York'); ?>
        
        <!-- navbar at the top of the screen -->
        <nav class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0 shadow">
            <a class="navbar-brand col-md-3 col-lg-2 mr-0 px-3" href="#"><img style="img-fluid;width:50px" src="./assets/img/icon60.png" class="ml-2 mr-2">LOS | Summary</a>
            
            <!-- this menu appears when the page is very narrow (phones) -->
            <button class="navbar-toggler position-absolute d-md-none collapsed" type="button" data-toggle="collapse" data-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
        </nav> <!-- end navbar -->

        <!-- dashboard elements -->
        <div class="container-fluid">
            <div class="row">
                
                <!-- controls the items in the gray area to the left of the dashboard -->
                <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
                    <div class="sidebar-sticky pt-3">
                        <!-- first grouping; holds all main pages -->
                        <ul class="nav flex-column">
                            <li class="nav-item">
                                <a class="nav-link" href=".">
                                    <span data-feather="clipboard"></span>
                                    Dashboard <span class="sr-only"></span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="./los_statistics.php">
                                    <span data-feather="bar-chart-2"></span>
                                    LOS Statistics <span class="sr-only"></span>
                                </a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link active" href="./patient_overview.php">
                                    <span data-feather="users"></span>
                                    Patient Overview <span class="sr-only">(current)</span> 
                                </a>
                            </li>
                            
                            <li class="nav-item">
                                <a class="nav-link" href="./specialist_overview.php">
                                    <span data-feather="activity"></span>
                                    Specialist Overview <span class="sr-only"></span> 
                                </a>
                            </li> 
                            
                            <li class="nav-item">
                                <a class="nav-link" href="./possible_procedures.php">
                                    <span data-feather="tool"></span>
                                    Procedure Analysis <span class="sr-only"></span> 
                                </a>
                            </li> 
                            
                        </ul>
 
                        <!-- second grouping; holds LOS estimator page -->
                        <ul class="nav flex-column mt-3 mb-2">
                            <li class="nav-item">
                                <a class="nav-link" href="https://connectedcaresystems.com/los/los_questions/">
                                    <span data-feather="sliders"></span>
                                    LOS Estimator <span class="sr-only"></span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="./data_new_patient.php">
                                    <span data-feather="user-plus"></span>
                                    New Patient Registration <span class="sr-only"></span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </nav> <!-- end sidebar -->
                

                <!-- main panel, holds dashboard elements -->
                <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-md-4">
                    <div class=" d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                        <h3><b>Patient Overview</b></h3>
                    </div>
                    
                    <!-- sliding button to discharge a patient -->
                    <button type="button" class="btn btn-secondary btn-lg float-dis pl-2" data-toggle="modal" data-target="#dis_modal" id="dis_btn"  style="opacity:0" > <!-- onclick='myFunction()' -->
                        <span data-feather="briefcase" style="width:24px;height:24px"></span>
                         Discharge Patient
                    </button>
                    
                    <!-- sliding button to record supplemental actions taken -->
                    <button type="button" class="btn btn-secondary btn-lg float-supp pl-2" data-toggle="modal" data-target="#supp_act_modal" id="supp_action"  style="opacity:0">
                        <span data-feather="user-plus" style="width:24px;height:24px"></span>
                         Supplemental Actions
                    </button>

                    <!-- DROPDOWN BAR Medical Center select-->
                    <div class="row justify-content-center" style = "position: relative; top: -15px;">

                            <div class="jumbotron text-center pt-4 pb-4 mb-0" style="background-color:#fff;">
                                <h3>Medical Center Search</h3>
                                    <select class="form-control-lg text-center"  id="select_center" name="select_center" style="width:300px; text-align:center; background-color:#fff">
                                        <option value= "" disabled selected hidden>Select Medical Center</option>
                                        <?php include './assets/php/patient_overview/update_mcender_list.php'; ?>
                                    </select>
                            </div> 
                    </div>         
                    
                    <!-- DROPDOWN BAR Physician select-->
                    <div class="row justify-content-center" style = "position: relative; top: -40px;">

                            <div class="jumbotron text-center pt-4 pb-4 mb-0" style="background-color:#fff">
                                <h3>Physician Search</h3>
                                    <select class="form-control-lg text-center"  id="select_physician" name="select_physician" style="width:300px; text-align:center; background-color:#fff">
                                        <option value= "" disabled selected hidden>Select Physician</option>
                                    </select>
                            </div> 
                        
                        <!-- patient search box -->

                            <div class="jumbotron text-center pt-4 pb-4 mb-0" style="background-color:#fff">
                                <h3>Patient Search</h3>
                                <select class="form-control-lg text-center" id="select_patient" name="select_patient" style="width:300px; text-align:center; background-color:#fff">
                                    <option selected disabled value="">Select Patient</option>
                                </select>
                            </div>
                    </div>
                    
                    <hr style = "position: relative; top: -30px">
                    
                    <!-- first row; contains patient info and timeline -->
                    <div class="row mt-2 mb-2" id = "row_1" style="opacity:0">
                        <div class="col-lg-5"> <!-- lg so these adjust first -->
                            <div class="card w-100 h-100">
                                <div class="card-header ">
                                    <b>Patient Information</b>
                                    <div class="btn-group mr-2 float-right" id = "load_dis_button">
                                    </div>
                                </div>
                                <div class="card-body text-Left ">
                                    <div id="patient_info"></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-7"> <!-- lg so these adjust first -->
                            <div class="card w-100 h-100">
                                <div class="card-header">
                                    <b>Length of Stay Timeline</b>
                                </div>
                                <div class="card-body">
                                    <canvas id="chart_patient_overview" height="350"></canvas>
                                </div>
                                <div class="card-footer">
                                    <button type="button" class="btn btn-outline-secondary" data-toggle="modal" data-target="#prog_modal">
                                        Progression Details
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div> <!-- end of first row -->
                     

                    <!-- second row; contains initial analyses -->
                     <div class="row" id = "row_3" style="opacity:0">
                        <div class="col-lg-6">
                            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-2 pb-1 mb-2">
                                <div class="card w-100">
                                    <div class="card-header ">
                                        <b>Initial Pre-Op Analysis</b>
                                    </div>
                                    <div class="card-body ">
                                        <div id="pre_op"></div>
                                    </div>
                                </div>
                            </div> 
                        </div>
                        
                        <div class="col-lg-6">
                            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-2 pb-1 mb-2">
                                <div class="card w-100">
                                    <div class="card-header ">
                                        <b>Initial Post-Op Analysis</b>
                                    </div>
                                    <div class="card-body ">
                                        <div id="post_op"></div>
                                    </div>
                                </div>
                            </div> 
                        </div>
                    </div> <!-- end second row -->

                    <!-- third row; patient history -->
                    <div class="row" id = "row_4" style="opacity:0">
                        <div class="col-lg-12" style = "width: 800px"> <!-- lg so these adjust first -->
                            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-2 pb-1 mb-2">
                                <div class="card w-100">
                                    <div class="card-header ">
                                        <b>Patient History in Hospital</b>
                                    </div>
                                    <div style="overflow-y:auto;max-height:400px">
                                        <div class="card-body text-Left">
                                            <div id="patient_history"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>                    
                    </div> <!-- end third row -->

                </main> <!-- end main panel -->
                
                
                <!-- supplemental action modal -->
                <div class="modal fade" id="supp_act_modal" tabindex="-1" role="dialog" aria-labelledby="supp_act_modal_label" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title " id="supp_act_modal_label"><b>Supplemental Actions</b></h4>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            
                            <!-- this form will call the php script to insert the action -->
                            <div class="modal-body">
                                <form action="./assets/php/patient_overview/insert_supplemental_action.php" method="get">
                                    <div class="row justify-content-center">
                                        <!-- date taken datepicker -->
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label for="action_date" class="col-form-label ">Date:</label>
                                                <div class="input-group date" data-provide="datepicker">
                                                    <input type="text" class="form-control" id="action_date" name="action_date" placeholder="MM/DD/YYYY" autocomplete="off" value=<?php echo date('m/d/Y') ?>>
                                                    <div class="input-group-addon">
                                                        <span class="glyphicon glyphicon-th"></span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label for="action_time" class="col-form-label ">Time:</label>
                                                <input type="text" class="form-control " id="action_time" name="action_time" value="<?php echo date('g:i A')?>">
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="row">
                                        <!-- admission selector -->
                                        
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label for="patient_id" class="col-form-label ">Patient ID:</label>
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text" id="basic-addon1">#</span>
                                                    </div>
                                                    <input readonly type="text" class="form-control" id="patient_id" name="patient_id" >
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="col-sm-8">
                                            <div class="form-group">
                                                <label for="action_taken" class="col-form-label ">Supplemental Action Taken:</label>
                                                <select class="custom-select" id="action_taken" name="action_taken">
                                                    <option disabled selected>Select an action...</option>
                                                    <option value="physical_therapy">Physical Therapy Session</option>
                                                    <option value="occ_therapy">Occupational Therapy Session</option>
                                                    <option value="sw_visit">Social Worker Session</option>
                                                </select>
                                            </div> 
                                        </div>
                                    </div>
                                    
                                    
                                    
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label for="new_est" class="col-form-label ">Duration:</label>
                                                <div class="input-group">
                                                    <input type="text" class="form-control " id="min" name="min" disabled>
                                                    <div class="input-group-append">
                                                        <span class="input-group-text">minutes</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label for="new_est" class="col-form-label ">Estimated LOS:</label>
                                                <div class="input-group">
                                                    <input type="text" class="form-control " id="new_est" name="new_est" disabled>
                                                    <div class="input-group-append">
                                                        <span class="input-group-text">days</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <!-- action taken selector -->
                                    
                                    
                                    <!-- comment field -->
                                    <div class="form-group">
                                        <label for="comment" class="col-form-label ">Comment:</label>
                                        <textarea class="form-control " id="comment" name="comment" placeholder="Add additional information here..." ></textarea>
                                    </div>
                                    
                                    <!-- this button submits the form, triggering the php script -->
                                    <div class="modal-footer">
                                        <button type="submit" class="btn btn-secondary ">Submit</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div> <!-- end supplemental action modal -->
                
                <!-- progression details modal -->
                <div class="modal fade" id="prog_modal" tabindex="-1" role="dialog">
                    <div class="modal-dialog modal-lg modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title " id="prog_modal_label"><b>Progression Details</b></h4>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            
                            <!-- this form will call the php script to insert the action -->
                            <div class="modal-body">
                                <div style="overflow-y:auto;max-height:500px">
                                    <div class="card-body" id="prog">
                                        <!-- populated later -->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> <!-- end progression details modal -->
                
                <!-- discharge menu modal -->
                <div class="modal fade" id="dis_modal" tabindex="-1" role="dialog">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title " id="dis_modal_label"><b>Discharge Options</b></h4>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            
                            <div class="modal-body ">
                                <form action="./assets/php/patient_overview/discharge_patient.php" method="get">
                                    
                                    <div class="row justify-content-sm-center mt-3 mb-3">
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="dis_type" id="dis_stable" value="stable" checked>
                                            <label class="form-check-label" for="dis_stable">Stable for discharge</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="dis_type" id="dis_left" value="left">
                                            <label class="form-check-label" for="dis_stable">Discharged</label>
                                        </div>
                                    </div>
                                    
                                    <div class="row justify-content-center">
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label for="dis_date" class="col-form-label ">Date:</label>
                                                <div class="input-group date" data-provide="datepicker">
                                                    <input type="text" class="form-control" id="dis_date" name="dis_date" placeholder="MM/DD/YYYY" autocomplete="off" value=<?php echo date('m/d/Y') ?>>
                                                    <div class="input-group-addon">
                                                        <span class="glyphicon glyphicon-th"></span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label for="dis_time" class="col-form-label ">Time:</label>
                                                <input type="text" class="form-control " id="dis_time" name="dis_time" value="<?php echo date('g:i A')?>">
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label for="patient_id" class="col-form-label ">Patient ID:</label>
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text" id="basic-addon1">#</span>
                                                    </div>
                                                    <input readonly type="text" class="form-control" id="patient_id_2" name="patient_id_2" >
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-8">
                                            <div class="form-group">
                                                <label for="dis_loc" class="col-form-label ">Discharge Location:</label>
                                                <select class="custom-select" id="dis_loc" name="dis_loc" disabled>
                                                    <option disabled selected>N / A</option>
                                                    <option value="Home ">Home</option>
                                                    <option value="Home w/ Assistance ">Home w/ Assistance</option>
                                                    <option value="Acute Rehab Facility ">Acute Rehab Facility</option>
                                                    <option value="Sub-acute Rehab Facility">Sub-acute Rehab Facility</option>
                                                    <option value="Deceased">Patient Deceased</option>
                                                </select>
                                            </div> 
                                        </div>
                                    </div>
                                    
                                </div>
                                
                                <!-- this button triggers our discharge JS function -->
                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-secondary " onclick="">Submit</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div> <!-- end discharge menu modal -->
                
            </div>
        </div> <!-- end page elements -->


        <!-- jquery js library -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

        <!-- bootstrap js library -->
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" 
        integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>

        <!-- bootstrap datepicker js library -->
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
        
        <!-- popper js library -->
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" 
        integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
        
        <!-- feather icon js pack -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/feather-icons/4.24.1/feather.min.js"></script>

        <!-- moment js (for time-stuff) & chart js library -->
        <script src="https://momentjs.com/downloads/moment.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.3/Chart.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/chartjs-plugin-annotation/0.5.7/chartjs-plugin-annotation.min.js"></script>
        
        <!-- this page's specific js library for icons -->
        <script src="./assets/js/main.js"></script>
        
        <!-- initialization scripts for the timeline chart -->
        <script src="./assets/js/patient_overview/init_patient_overview_chart.js"></script>

        <!-- JS to control AJAX calls for the page-->
        <script src="./assets/js/patient_overview/update_patient_overview.js"></script>
        
        
    </body>
</html>