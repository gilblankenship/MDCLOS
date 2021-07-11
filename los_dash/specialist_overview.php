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
        <title>Specialist Overview</title> 

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
                                <a class="nav-link active" href="./specialist_overview.php">
                                    <span data-feather="activity"></span>
                                    Specialist Overview <span class="sr-only">(current)</span> 
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
                        <h3><b>Specialist Overview</b></h3>
                    </div>
                   
                   <!-- Specialist search -->
                    <div class="jumbotron text-center pt-4 pb-4 m-0" style="background-color:#fff">
                        <h3>Specialist Search</h3>
                        <select class="form-control-lg text-center" id="select_specialist" name="specialist_select" style="width:auto; background-color:#fff">
                                <option selected disabled value="">Last name, First name</option>
                                <!-- populated by the PHP script -->
                                <?php include './assets/php/specialist_overview/fetch_specialist_options.php'; ?>
                        </select>
                    </div>
                                    
                    <hr>
                
                <!-- modal for chart filter controls -->
                <div class="modal fade" id="filter_comparison_graph" tabindex="-1" role="dialog" aria-labelledby="filter_modal_label" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <!-- Title -->
                                <h4 class="modal-title" id="filter_modal_label"><b>Choose LOS range</b></h4>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form action="./assets/php/specialist_overview/update_reduction_factor.php" method="post">
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label for="new_est" class="col-form-label " style="font-weight:700;">Limit minimum LOS</label>
                                                <input type="text" class="form-control " id="minimum_los" name="min_los" placeholder="Min LOS">
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label for="new_est" class="col-form-label " style="font-weight:700;">Limit maximum LOS</label>
                                                <input type="text" class="form-control " id="maximum_los" name="max_los" placeholder="Max LOS">
                                            </div>
                                        </div>
                                    </div>
                                     <input type="button" class="btn btn-secondary" name="select_limits" id="select_limits" value="Apply Changes"/>
                                </form>
                            </div>
                        </div>
                    </div>
                </div> <!-- end chart filter modal -->
                
                    <!-- first row -->
                    <div class="row" id = "row_1">
                            <div class="col-lg-6" >
                                    <!-- Specialist information -->
                                    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-2 pb-1 mb-2">
                                        <div class="card w-100">
                                            <div class="card-header">
                                                <b>Specialist Information:</b>
                                            </div>
                                            <div class="card-body text-Left">
                                                <div id="specialist_info"></div>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <!-- Quality analysis: Table with Avg. reduction factor and Avg. Savings -->
                                    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-2 pb-1 mb-2">
                                        <div class="card w-100" style = "max-height: 500px;">
                                            <div class="card-header">
                                                <b>Quality analysis: </b>
                                            </div>
                                            <div class="card-body text-Left overflow-auto">
                                                <div id="specialist_quality"></div>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <!-- Quality analysis: Table with Avg. reduction factor and Avg. Savings -->
                                    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-2 pb-1 mb-2">
                                        <div class="card w-100"  >
                                            <div class="card-header">
                                                <div id="los_range"></div>
                                            </div>
                                            <div class="card-body">
                                                <button type="button" class="btn btn-secondary float-right" data-toggle="modal" data-target="#filter_comparison_graph">SELECT LOS</button>
                                                <canvas id="specialist_comparison" ></canvas>
                                            </div>
                                        </div>
                                    </div>
                            </div> 
                            
                            <!-- Card showing the patients that have been treated by the specialist -->
                            <div class="col-lg-6" >
                                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-2 pb-1 mb-2">
                                    <div class="card w-100" style = "max-height: 640px;">
                                        <div class="card-header">
                                            <b>Patients treated: </b>
                                        </div>
                                        <div class="card-body text-Left overflow-auto">
                                            <div id="specialist_history" ></div>
                                        </div>
                                    </div>
                                </div>
                                
                                <!-- Card showing the reduction in days per type of procedure -->
                                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-2 pb-1 mb-2">
                                    <div class="card w-100" >
                                        <div class="card-header">
                                            <b>Specialist reduction in days per type of procedure: </b>
                                        </div>
                                        <div class="card-body">
                                            <canvas id="chart_type_procedure" ></canvas>
                                        </div>
                                    </div>
                                </div>
                            </div>  
                
                    </div><!-- end first row -->
                </main> <!-- end main panel -->

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
        
        <!-- Graph initiation -->
        <script src="./assets/js/specialist_overview/init_comparison_specialists.js"></script>
        <script src="./assets/js/specialist_overview/init_type_procedure.js"></script>
        
        <!-- this page's specific js library for icons -->
        <script src="./assets/js/main.js"></script>
        
        <!-- Add's the update functionality -->
        <script src="./assets/js/specialist_overview/update_specialists.js"></script>
        
    </body>
</html>