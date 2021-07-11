<!DOCTYPE html> <!-- HTML5 -->
<html lang="en">
    <head>
        <!-- specifiers to set page characteristics -->
        <meta http-equiv="Content-Type" content="text/html; charset=shift_jis">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <!-- icon and title in the page tag -->
        <link rel="icon" type="image/png" href="./assets/img/icon60.png">
        <title>Procedure Analysis</title>

        <!-- Bootstrap core CSS -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" 
        integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
        
        <!-- Bootstrap datepicker CSS -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css"/>
        
        <!-- custom styles for this page -->
        <link href="./assets/css/main.css" rel="stylesheet">
        <link href="./assets/css/specialist_overview.css" rel="stylesheet">

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
                                    LOS Statistics <span class="sr-only"></span>
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
                                <a class="nav-link active" href="./possible_procedures.php">
                                    <span data-feather="tool"></span>
                                    Procedure Analysis <span class="sr-only">(current)</span> 
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
                
                <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-md-4">
                    <div class=" d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                        <h3 class="lead" style="font-size:28px;"><b>Analysis of procedures for Length-Of-Stay reduction</b></h3>
                    </div>
                    
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
                    
                <!-- modal for table update -->
                <div class="modal fade" id="filter_select_duration" tabindex="-1" role="dialog" aria-labelledby="filter_select_duration" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <!-- Title -->
                                <h4 class="modal-title" id="filter_modal_label"><b>Select desired treatment duration</b></h4>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form action="./assets/php/specialist_overview/update_table_procedure.php" method="post">
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <label for="new_est" class="col-form-label " style="font-weight:700;">Enter time to update 'Procedure analysis table'</label>
                                                <input type="text" class="form-control " id="treat_duration" name="treat_duration" placeholder="Minutes">
                                            </div>
                                        </div>
                                    </div>
                                     <input type="button" class="btn btn-secondary" name="select_duration" id="select_duration" value="Apply Changes"/>
                                </form>
                            </div>
                        </div>
                    </div>
                </div> <!-- end chart filter modal -->
                
                <button type="button" class="btn btn-secondary float-left" data-toggle="modal" id="button_select_treat_duration" data-target="#filter_select_duration">SELECT TREATMENT DURATION</button>

                <hr style = "position: relative; top: -30px">
                    
                <br>
                    <style>
                        .dotted-line{
                            border-bottom:dashed;
                            border-bottom-width:thin;
                            border-width:2px;
                            border-bottom-color:'rgba(0,0,0,0.1)';
                        }
                    </style>
                    
                    
                    
                    <div class="row" id = "row_1">
                        <div class="col-lg-12">
                            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-2 pb-1 mb-2">
                                <div class="card w-100" id="personal_procedure_analysis">
                                    <div class="card-body">
                                        <div class=" d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                                            <h3 class="text-center">Possible procedures</h3>
                                        </div>
                                        <div id="table_procedures" height="300"></div>
                                        
                                            <div class="row">
                                                <div class="col-lg-6">
                                                    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-2 pb-1 mb-2">
                                                        <div class="card w-100">
                                                            <div class="card-header">
                                                                <b>Method with maximum reduction in length-of-stay</b>
                                                            </div>
                                                            <div class="card-body">
                                                                 <h4 style="text-align:center;" id="maximum_reduction_days"></h4>
                                                            </div>
                                                        </div>
                                                    </div> 
                                                </div>
                                                
                                                <div class="col-lg-6">
                                                    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-2 pb-1 mb-2">
                                                        <div class="card w-100">
                                                            <div class="card-header">
                                                                <b>Method with maximum reduction in treatment cost</b>
                                                            </div>
                                                            <div class="card-body">
                                                                <h4 style="text-align:center;" id="maximum_reduction_cost"></h4>
                                                            </div>
                                                        </div>
                                                    </div> 
                                                </div>
                                            </div>
                                            
                                            <br> 
                                            
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <div class="card w-100">
                                                        <div class="card-header">
                                                            <h2 class="lead">Efficiency per method</h2>
                                                            <h6 class="lead" style="font-size:15px">[Net Savings / Total cost of treatment]</h6>
                                                        </div>
                                                        <div class="card-body">
                                                            <canvas id="chart_efficiency" height="300"></canvas>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                </div>
                            </div> 
                        </div>
                      </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-2 pb-1 mb-2">
                                <div class="card w-100">
                                    <div class="card-body">
                                        <div class=" d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                                            <h3 class="text-center">Statistical analysis of procedures</h3>
                                        </div>
                                        <?php include './assets/php/possible_procedures/update_analysis_minutes.php'?>
                                        <table class="table table-hover">
                                          <thead >
                                            <tr>
                                              <th scope="col"></th>
                                              <th scope="col">Occupational Therapy</th>
                                              <th scope="col">Physical Therapy</th>
                                            </tr>
                                          </thead>
                                          <tbody>
                                            <tr>
                                              <th scope="row">Average minutes of treatment</th>
                                              <td><?php echo $ot_avg_minutes?></td>
                                              <td><?php echo $pt_avg_minutes?></td>
                                            </tr>
                                           </tbody>
                                        </table>
                                        
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-2 pb-1 mb-2">
                                                    <div class="card w-100">
                                                        <div class="card-header">
                                                            <b>Analysis of procedures by net savings ($)</b>
                                                        </div>
                                                        <div class="card-body">
                                                            <canvas id="chart_analysis" height="300"></canvas>
                                                        </div>
                                                    </div>
                                                </div> 
                                            </div>
                                            
                                            <div class="col-lg-6">
                                                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-2 pb-1 mb-2">
                                                    <div class="card w-100">
                                                        <div class="card-header">
                                                            <b>Analysis of procedures by LOS reduction</b>
                                                        </div>
                                                        <div class="card-body">
                                                            <canvas id="chart_analysis_days" height="300"></canvas>
                                                        </div>
                                                    </div>
                                                </div> 
                                            </div>
                                        </div>
                                    </div>
                                </div> 
                            </div>
                        </div>
                    </div>
                </main> <!-- end main panel -->
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
        
        
        <!-- this page's specific js library for icons -->
        <script src="./assets/js/main.js"></script>
        
         <!-- initialization scripts for each chart -->
        <script src="./assets/js/possible_procedures/init_efficiency.js"></script> <!-- Chart personalized efficiency -->
        <script src="./assets/js/possible_procedures/init_graph_analysis.js"></script>
        <script src="./assets/js/possible_procedures/init_graph_analysis_days.js"></script>


        <!-- global variable initialization -->
        <script type="text/javascript">
            window.grouped = 'f'; // f is for false
            window.range_active = 'f'; // f is for false
        </script>
        
        <!-- chart initializer / updater script -->
        <script src="./assets/js/possible_procedures/update_analysis.js"></script>
    </body>
</html>