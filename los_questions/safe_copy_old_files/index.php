<!--
        'statistics.php'
-->
<!DOCTYPE html> <!-- HTML5 -->
<html lang="en">
    <head>
        <!-- specifiers to set page characteristics -->
        <meta http-equiv="Content-Type" content="text/html; charset=shift_jis">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <html lang="en"><!-- English language --> 
        <link rel="icon" type="image/png" href="./images/tab_logo.png" >
        
        <title>LOS Estimator</title>

        <!-- Bootstrap core CSS -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" 
        integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
        
         <!-- Bootstrap datepicker CSS -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css"/>
        
        <!-- custom styles for this page -->
        <link href="./css/main.css" rel="stylesheet">
        
        <!--<link rel="stylesheet" type="text/css" href="../CSS/back_button_style.css">-->
        <link rel="stylesheet" type="text/css" href="./css/answer_button_style.css">
        <link rel="stylesheet" type="text/css" href="./css/main.css">         

    </head>
  
    <body>
        <!-- navbar at the top of the screen -->
        <nav class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0 shadow">
            <a class="navbar-brand col-md-3 col-lg-2 mr-0 px-3" href="#"><img style="img-fluid;width:50px" src="./images/icon60.png" class="ml-2 mr-2">LOS | Estimator</a>
            
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
                                    <span data-feather="codepen"></span>
                                    Specialist Overview <span class="sr-only"></span> 
                                </a>
                            </li> 
                            
                            <li class="nav-item">
                                <a class="nav-link" href="./possible_procedures.php">
                                    <span data-feather="grid"></span>
                                    Procedure Analysis <span class="sr-only"></span> 
                                </a>
                            </li> 
                            
                        </ul>
                        
                        <!-- second grouping; holds LOS estimator page -->
                        <ul class="nav flex-column mt-3 mb-2">
                            <li class="nav-item active">
                                <a class="nav-link" href="https://connectedcaresystems.com/los/los_questions/">
                                    <span data-feather="cpu"></span>
                                    LOS Estimator <span class="sr-only"></span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="./data_new_patient.php">
                                    <span data-feather="cpu"></span>
                                    New Patient Registration <span class="sr-only"></span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </nav> <!-- end sidebar -->
                

                <!-- main panel, holds dashboard elements -->
                <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-md-4">

                    <div class="container-fluid header p-0" style="height:215px">
                            <div class="overlay"></div>
                                <!-- Header container placed after Navegation Bar -->
                                <div class="description" >
                                    <!-- Main title on the body part -->
                                    <h1 class="display-4" style="font-size:40px">Hospital Length of Stay</h1>
                                </div>
                    </div>
                    
                    <hr>
                    
                    <!--<form class="patient_type" id="q0">
                        <br><br><br>
                        <div class="button-wrap">
                           
                            
                        <button type="button" class="question_button" data-toggle="modal" data-target="#supp_act_modal" id="supp_action">
                             <h1 style="width:300px; text-align:center; font-weight:bold">New Patient</h1>
                        </button>
                            
                            
                            <input type="radio"  id="old"  name="q0" value="2" class="hidden radio-label" style="width:300px;"/></input>
                            <label for="old" id="old" value= "2" name="q0" class="question_button"><h1 style="width:300px; text-align:center;font-weight:bold">Existing Patient</h1></label>
                        </div>
                        <br>
                    </form>
                    
                    <form class="return" id="return_button">
                        <br><br>
                        <div class="button-wrap">
                            <input type="radio" id="radio_return"  name="q1" value="1" class="hidden radio-label" style="width:300px;"/></input>
                            <label for="radio_return" id="return" value="1" name="q1" class="question_button"><h1 style="width:300px; text-align:center; font-weight:bold">Return</h1></label>
                        </div>
                        <br>
                    </form>-->
            
                      <form class="model_select" id="q2">
                        <br>
                        <div class="button-wrap">
                            <input type="radio" id="radio_model_1"  name="q2" value="1" class="hidden radio-label" style="width:300px;"/></input>
                            <label for="radio_model_1" id="model_1" value="1" name="q2" class="question_button"><h1 style="width:300px; text-align:center; font-weight:bold">Pre-OP Vars Only</h1></label>
                            <script src="./js/main_page.js"></script>
                            <input type="radio"  id="radio_model_2"  name="q2" value="2" class="hidden radio-label" style="width:300px;"/></input>
                            <label for="radio_model_2" id="model_2" value= "2" name="q2" class="question_button"><h1 style="width:300px; text-align:center;font-weight:bold">All Vars</h1></label>
                        </div>
                        <br>
                    </form> 
                    
                </main> <!-- end main panel -->

                <!-- modal to test supplemental action recorder -->
                <!--<div class="modal fade" id="supp_act_modal" tabindex="-1" role="dialog" aria-labelledby="supp_act_modal_label" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title " id="supp_act_modal_label"><b>New Patient Registration</b></h4>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            
                            <!-- this form will call the php script to insert the action -->
                        <!-- <div class="modal-body">
                            <form action = "./php/insert_new_patient.php" method = "get" class="needs-validation" novalidate>
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label for="center_selection" class="col-form-label">Medical Center:</label>
                                                <select class="custom-select"  id="select_center" name="select_center" required>
                                                    // php include './php/update_mcender_list.php'; ?>
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
                                         <div class="col-sm-6">
                                            <div class="form-group">
                                                    <label for="mrn" class="col-form-label ">MRN:</label>
                                                    <input type="text" class="form-control" id="mrn" onkeypress="return is_mrn_key(event)" placeholder = "mrn" name="mrn" required pattern="^[a-zA-Z0-9-]+$"> 
                                            </div>
                                        </div>
                                        
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label for="action_date" class="col-form-label ">DOB:</label>
                                                    <input type="date" class="form-control" id="dob" name="dob" placeholder="MM/DD/YYYY" required>
                                                    <div class="input-group-addon">
                                                        <span class="glyphicon glyphicon-th"></span>
                                                    </div>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label for="gender" class="col-form-label ">Gender:</label>
                                                <select class="custom-select" id="gender" name="gender" required>
                                                    <option value="" disabled selected>Select...</option>
                                                    <option value="Male">male</option>
                                                    <option value="Female">female</option>
                                            </select>
                                            </div> 
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label for="bmi" class="col-form-label ">BMI:</label>
                                                <input type="text" class="form-control " id="bmi" name="bmi"  onkeypress="return is_number_key(event)" placeholder="bmi" required pattern="^\d{1,3}(\.\d{1,3})?$">
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
                                              <input type="time" id="default-picker" class="form-control" id="admin_time" name="admin_time" placeholder="Select time" required>
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
                                              <input type="time" id="default-picker" class="form-control" id="surgery_time" name="surgery_time" placeholder="Select time" required>
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
                                    </div>    -->
                                    
                                    <!-- this button submits the form, triggering the php script -->
                                    <!--<div class="modal-footer">
                                        <button type="submit" class="btn btn-secondary ">Submit</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div> <!-- end supplemental action modal -->-->


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
        <script src="./js/main_page.js"></script>
        <!--<script src="./js/feather.js"></script>-->
        <!--<script src="./js/register.js"></script>-->
        
    </body>
</html>

