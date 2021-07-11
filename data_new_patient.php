<!--
        'statistics.php'
-->
<!DOCTYPE html> <!-- HTML5 -->
<html lang="en">
    <head>
        <!-- specifiers to set page characteristics -->
        <meta http-equiv="Content-Type" content="text/html; charset=shift_jis">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <!-- icon and title in the page tag -->
        <link rel="icon" type="image/png" href="./assets/img/icon60.png">
        <title>New Patient Registration</title>

        <!-- Bootstrap core CSS -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" 
        integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
        
        <!-- custom styles for this page -->
        <link href="./assets/css/main.css" rel="stylesheet">
        <link href="./assets/css/new_patient.css" rel="stylesheet">

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
        </style>
    </head>
  
    <body>
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
                                    LOS Statistics <span class="sr-only">(current)</span>
                                </a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link" href="./patient_overview.php">
                                    <span data-feather="users"></span>
                                    Patient Overview <span class="sr-only"></span> 
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
                                <a class="nav-link active" href="./data_new_patient.php">
                                    <span data-feather="user-plus"></span>
                                    New Patient Registration <span class="sr-only"></span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </nav> <!-- end sidebar -->
               
                </script>
                <!-- main panel, holds dashboard elements -->
                <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-md-4">
                    <!-- Main bar title -->
                    <div class=" d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                        <h3><b>New Patient Registration</b> <h3 id="patient_id"></h3></h3>
                    </div>
                    
                    <!-- INJURY STATISTICS; moi, fracture level, and fracture morphology -->
                    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-2 pb-1 mb-2">
                        <div class="card w-100">
                            <div class="card-body">
                                    <h3 classs="lead">Personal information</h3>
                                <hr>
                                <form action = "" method = "get" class="needs-validation" id="myform" novalidate>
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label for="select_center" class="col-form-label">Medical Center:</label>
                                                <select class="custom-select"  id="select_center" name="select_center" required>
                                                    <?php include '../los_questions/php/update_mcender_list.php'; ?>
                                                </select>
                                                
                                            </div>
                                        </div>

                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label for="patient_admission" class="col-form-label">Admitting Physician:</label>
                                                <select class="custom-select" id="select_physician" name="select_physician" required>
                                                <option disable selected hidden>Select Physician</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div> 
                                    
                                    <div class="row">
                                        
                                        <!--
                                        Date Of Birth
                                        <div class="col-sm-3">
                                            <div class="form-group">
                                                <label for="action_date" class="col-form-label ">Date Of Birth:</label>
                                                    <input type="date" class="form-control" id="dob" name="dob" placeholder="MM/DD/YYYY" required>
                                                    <div class="input-group-addon">
                                                        <span class="glyphicon glyphicon-th"></span>
                                                    </div>
                                            </div>
                                        </div>-->
                                        <div class="col-sm-3">
                                            <div class="form-group">
                                                <label for="age" class="col-form-label ">Age:</label>
                                                    <input type="number" class="form-control" min="0" max="99" id="age" name="age" placeholder="Age" onkeypress="return is_number_key(event)" required pattern="^\d{1,2}(\.\d{1,2})?$">
                                                <div class="invalid-feedback" id="age_error">
                                                    Please introduce a valid age.
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-3">
                                            <div class="form-group">
                                                <label for="gender" class="col-form-label ">Gender:</label>
                                                <select class="custom-select" id="gender" name="gender" required>
                                                    <option value="" disabled selected>Select...</option>
                                                    <option value="Male">Male</option>
                                                    <option value="Female">Female</option>
                                            </select>
                                            </div> 
                                        </div>
                                        <div class="col-sm-3">
                                            <div class="form-group">
                                                <label for="bmi" class="col-form-label ">BMI:</label>
                                                <input type="number" class="form-control " id="bmi" min="15" max="99" step="any" name="bmi"  onkeypress="return is_number_key(event)" placeholder="Body Mass Index" >
                                                <div class="invalid-feedback" id="bmi_error">
                                                    Please introduce a valid BMI.
                                                </div>
                                            </div>
                                        </div> 
                                        <div class="col-sm-3">
                                            <div class="form-group">
                                                <label for="cci" class="col-form-label ">CCI:</label>
                                                <input type="number" class="form-control " id="cci" name="cci" min="0" max="37" onkeypress="return is_number_key(event)" placeholder="Charlson Comorbidity Index" required pattern="^\d{1,2}(\.\d{1,2})?$">
                                            </div>
                                            <div class="invalid-feedback" id="cci_error">
                                                    Please introduce a valid CCI.
                                                </div>
                                        </div> 
                                    </div>   
                                    
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label for="admin_date" class="col-form-label ">Admission Date:</label>
                                                    <input type="date" class="form-control" id="admin_date" name="admin_date" placeholder="MM/DD/YYYY" required>
                                                    <div class="input-group-addon">
                                                        <span class="glyphicon glyphicon-th"></span>
                                                    </div>
                                            </div>
                                        </div>
                                        
                                        <div class="col-sm-6">
                                            <div class="md-form md-outline">
                                              <label for="admin_time" class="col-form-label ">Admission Time:</label>    
                                              <input type="time"  class="form-control" id="admin_time" name="admin_time" placeholder="Select time" required>
                                            </div>  
                                        </div>      
                                    </div>
                                    
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label for="surgery_date" class="col-form-label ">Surgery Date:</label>
                                                    <input type="date" class="form-control" id="surgery_date" name="surgery_date" placeholder="MM/DD/YYYY" required>
                                                    <div class="input-group-addon">
                                                        <span class="glyphicon glyphicon-th"></span>
                                                    </div>
                                            </div>
                                        </div>
                                        
                                        <div class="col-sm-6">
                                            <div class="md-form md-outline">
                                              <label for="surgery_time" class="col-form-label ">Surgery Time:</label>    
                                              <input type="time"  class="form-control" id="surgery_time" name="surgery_time" placeholder="Select time" required>
                                            </div>  
                                        </div>      
                                    </div>                                    
                                    
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label for="transfer_status" class="col-form-label ">Transfer Status:</label>
                                                <select class="custom-select" id="transfer" name="transfer" required>
                                                    <option disabled selected>Select...</option>
                                                    <option value="0">Direct</option>
                                                    <option value="1">Outside Transfer</option>
                                                </select>
                                            </div> 
                                        </div>
                                    
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label for="insurance" class="col-form-label ">Insurance Type:</label>
                                                <select class="custom-select" id="insurance" name="insurance" required>
                                                    <option disabled selected>Select...</option>
                                                    <option value="Private">Private</option>
                                                    <option value="Medicare">Medicare</option>
                                                    <option value="Medicaid">Medicaid</option>
                                                    <option value="Other">Other</option>
                                                </select>
                                            </div> 
                                        </div>
                                    </div>    
                                    
                                    <br>
                                    <h3 classs="lead">Statistical information</h3>
                                    <hr>
                                    <div class="row">
                                        <div class="col-sm-3">
                                            <div class="form-group">
                                                <label for="moi" class="col-form-label">Mechanism Of Injury:</label>
                                                <select class="custom-select"  id="moi" name="moi" required>
                                                    <option disabled selected>Select...</option>
                                                    <option value="FFH">Fall From Height</option>
                                                    <option value="FFSH">Fall From Standing Height</option>
                                                    <option value="PED">Pedestrian Struck</option>
                                                    <option value="Fall Stairs">Fall Stairs</option>
                                                    <option value="MVC">Motor Vehicle Crash</option>
                                                    <option value="MCC">Motorcycle Crash</option>
                                                    <option value="Other">Other</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-sm-3">
                                            <div class="form-group">
                                                <label for="fract_level" class="col-form-label">Fracture Level</label>
                                                <select class="custom-select" id="fract_level" name="fract_level" required>
                                                    <option disable selected>Select..</option>
                                                    <option value="(T1-T9)">(T1-T9) Thoracic</option>
                                                    <option value="(T10-L2)">(T10-L2) Thorcolumbar</option>
                                                    <option value="(L3-L5)">(L3-L5) Low Lumbar</option>
                                                </select>
                                            </div>
                                        </div>
                                        
                                        <div class="col-sm-3">
                                            <div class="form-group">
                                                <label for="fract_morph" class="col-form-label">Fracture Morphology</label>
                                                <select class="custom-select" id="fract_morph" name="fract_morph" required>
                                                    <option disable selected>Select..</option>
                                                    <option value="Fracture-Dislocation">Fracture - Dislocation</option></option>
                                                    <option value="Flexion-Distraction">Flexion - Distraction</option>
                                                    <option value="Combination >1">Combination > 1</option>
                                                    <option value="Extension-Distraction">Extension - Distraction</option>
                                                    <option value="Burst/Compression">Burst/Compression</option>
                                                </select>
                                            </div>
                                        </div>
                                        
                                        <div class="col-sm-3">
                                            <div class="form-group">
                                                <label for="levels_fused" class="col-form-label ">Levels Fused</label>
                                                <select class="custom-select" id="levels_fused" name="levels_fused" required>
                                                    <option disable selected>Select..</option>
                                                    <option value="1-2">1 - 2</option></option>
                                                    <option value="3-6">3 - 6</option>
                                                    <option value="7-12">7 - 12</option>
                                                    <option value=">12">>12</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div> 
                                    
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label for="surgery_length" class="col-form-label ">Surgery Length (minutes)</label>
                                                <input type="number" class="form-control" min="30" max="1200" id="surgery_length" name="surgery_length"  onkeypress="return is_number_key(event)" placeholder="Surgery Length" required pattern="^\d{1,3}(\.\d{1,3})?$">
                                            </div>
                                            <div class="invalid-feedback" id="surgery_length_error">
                                                Please introduce a valid surgery-length value.
                                            </div>
                                        </div>
                                        
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label for="surg_technique" class="col-form-label ">Surgical Technique:</label>
                                                <select class="custom-select" id="surg_technique" name="surg_technique" required>
                                                    <option disabled selected>Select...</option>
                                                    <option value="Open">Open</option>
                                                    <option value="Percutaneous/MIS">Percutaneous/MIS</option>
                                                </select>
                                            </div> 
                                        </div>
                                        
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label for="surg_approach" class="col-form-label ">Surgical Approach:</label>
                                                <select class="custom-select" id="surg_approach" name="surg_approach" required>
                                                    <option disabled selected>Select...</option>
                                                    <option value="Posterior">Posterior</option>
                                                    <option value="Anterior">Anterior</option>
                                                    <option value="Combined">Combined</option>
                                                </select>
                                            </div> 
                                        </div>
                                    </div> 
                                    
                                    <div class="row">
                                        <!--<div class="col-sm-6">
                                            <div class="form-group">
                                                <label for="disch_location" class="col-form-label ">Discharge Location:</label>
                                                <select class="custom-select" id="disch_location" name="disch_location" required>
                                                    <option disabled selected>Select...</option>
                                                    <option value="Home">Home</option>
                                                    <option value="RehabFacility">Rehab Facility</option>
                                                    <option value="Other">Other</option>
                                                </select>
                                            </div> 
                                        </div>-->
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label for="blood_loss" class="col-form-label ">Blood Loss (mL)</label>
                                                <input type="number" class="form-control " id="blood_loss" min="0" max="9999" name="blood_loss"  onkeypress="return is_number_key(event)" placeholder="Blood Loss" required pattern="^\d{1,4}(\.\d{1,4})?$">
                                            </div>
                                            <div class="invalid-feedback" id="blood_loss_error">
                                                Please introduce a valid blood-loss value.
                                            </div>
                                        </div>
                                        
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label for="readmission" class="col-form-label ">Readmitted?</label>
                                                <select class="custom-select" id="readmission" name="readmission" required>
                                                    <option disabled selected>Select...</option>
                                                    <option value="1">Yes</option>
                                                    <option value="0">No</option>
                                                </select>
                                            </div> 
                                        </div>
                                        
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label for="reoperation" class="col-form-label ">Reoperated?</label>
                                                <select class="custom-select" id="reoperation" name="reoperation" required>
                                                    <option disabled selected>Select...</option>
                                                    <option value="1">Yes</option>
                                                    <option value="0">No</option>
                                                </select>
                                            </div> 
                                        </div>
                                    </div>
                                    
                                    <script>
                                        function erase_fields(){
                                            $("#surgery_length_error").hide();
                                            $("#blood_loss_error").hide();
                                            $("#cci_error").hide();
                                            $("#age_error").hide();
                                            $("#bmi_error").hide();
                                            console.log("Hide all");
                                        }
                                    </script>
                                    
                                    <!-- this button submits the form, triggering the php script -->
                                    <div class="modal-footer">
                                        <button type="reset" class="btn btn-registration" onclick="erase_fields()"><h6>Erase all fields</h6></button>
                                        <!-- <button type="submit" class="btn btn-secondary" id="submit">Submit</button> -->
                                        <button type="button" class="btn btn-registration" id="button_modal" onclick="call_modal()" ><h6>Submit</h6></button>
                                    </div>
                                    
                                    <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                      <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                                        <div class="modal-content">
                                          <div class="modal-header">
                                            <h3 class="modal-title" id="exampleModalLongTitle">Summary of patient registration</h3> <!-- Tittle -->
                                            <button type="button" class="btn btn-tertiary" data-dismiss="modal" aria-label="Edit">
                                                <span data-feather="edit"></span>
                                                         E D I T <span class="sr-only"></span>
                                            </button>
                                          </div>
                                          <div class="modal-body">
                                            <h4 id="patient_id_summary"></h4>
                                            <hr style="border-top: 3px dashed">
                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <p><b>Medical Center: </b></p><p id="modal_med_center"></p>
                                                </div>
                                                <div class="col-sm-6">
                                                    <p><b>Admitting Physician: </b></p><p id="modal_adm_phys"></p>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-sm-3">
                                                    <p><b>Age: </b></p><p id="modal_age"></p>
                                                </div>
                                                 
                                                <div class="col-sm-3">
                                                    <p><b>Gender: </b></p><p id="modal_gender"></p>
                                                </div>
                                                <div class="col-sm-3">
                                                    <p><b>BMI: </b></p><p id="modal_bmi"></p>
                                                </div>
                                                <div class="col-sm-3">
                                                    <p><b>CCI: </b></p><p id="modal_cci"></p>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <p><b>Admission Date: </b></p><p id="modal_admin_date"></p>
                                                </div>
                                                <div class="col-sm-6">
                                                    <p><b>Admission Time: </b></p><p id="modal_admin_time"></p>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <p><b>Surgery Date: </b></p><p id="modal_surg_date"></p>
                                                </div>
                                                <div class="col-sm-6">
                                                    <p><b>Surgery Time: </b></p><p id="modal_surg_time"></p>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <p><b>Transfer Status: </b></p><p id="modal_trans"></p>
                                                </div>
                                                <div class="col-sm-6">
                                                    <p><b>Insurance Type: </b></p><p id="modal_insur"></p>
                                                </div>
                                            </div>
                                            <h5>Statistical Information</h5>
                                            <hr style="border-top: 3px dashed">
                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <p><b>Mechanism Of Injury: </b></p><p id="modal_moi"></p>
                                                </div>
                                                <div class="col-sm-6">
                                                    <p><b>Fracture Level: </b></p><p id="modal_frac_lvl"></p>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <p><b>Fracture Morphology: </b></p><p id="modal_frac_morph"></p>
                                                </div>
                                                <div class="col-sm-6">
                                                    <p><b>Levels Fused: </b></p><p id="modal_lvl_fused"></p>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <p><b>Blood Loss (mL): </b></p><p id="modal_blood_loss"></p>
                                                </div>
                                                <div class="col-sm-6">
                                                    <p><b>Surgery Length (minutes): </b></p><p id="modal_surg_len"></p>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <p><b>Surgical Technique: </b></p><p id="modal_surg_tech"></p>
                                                </div>
                                                <div class="col-sm-6">
                                                    <p><b>Surgical Approach: </b></p><p id="modal_surg_app"></p>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <p><b>Readmitted: </b></p><p id="modal_readmission"></p>
                                                </div>
                                                <div class="col-sm-6">
                                                    <p><b>Reoperated: </b></p><p id="modal_reoperation"></p>
                                                </div>
                                            </div>
                                          </div>
                                          <div class="modal-footer">
                                                    <!-- Button to register an imager -->
                                                    <button type="submit" onclick="send_to_php()" id="submit_modal" class="btn btn-secondary">Submit</button>
                                          </div>
                                      </div>
                                    </div>
                                </div> <!-- End of the modal form -->
                                    
                                </form>
                            </div>
                        </div> <!-- end second row -->
                    </div>
            
                 
                    
                </div>
                </main> <!-- end main panel -->
            </div>
        </div>
        </div> <!-- end of dashboard elements -->

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
        <script src="./assets/js/register_new_patient/feather.js"></script>
        <script src="./assets/js/register_new_patient/register.js"></script>
        <!-- Warning messages when clicking out of the input boxes -->
        <script src="./assets/js/register_new_patient/validation.js"></script>
        <script src="./assets/js/register_new_patient/submit.js"></script>
        <script src="./assets/js/register_new_patient/increase_patient_id.js"></script>
    </body>
</html>