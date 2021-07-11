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
        <title>Statistics</title>

        <!-- Bootstrap core CSS -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" 
        integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
        
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
                                <a class="nav-link active" href="./los_statistics.php">
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
                                <a class="nav-link" href="./data_new_patient.php">
                                    <span data-feather="user-plus"></span>
                                    New Patient Registration <span class="sr-only"></span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </nav> <!-- end sidebar -->
                

                <div class="modal fade" id="filter_modal" tabindex="-1" role="dialog" aria-labelledby="filter_modal_label" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title" id="filter_modal_label"><b>Chart Filters</b></h4>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body mt-3 mb-3">
                                <div class="d-flex flex-row justify-content-center">
                                    <label for="include_los_over"><b>Include Admissions With LOS Over __ Days</b></label>
                                </div>
                                <div class="d-flex flex-row justify-content-center w-100">
                                    <?php
                                        $HOST = 'localhost';
                                        $DATABASE = 'LOSDB';
                                        $USER = 'bfokin';
                                        $PASSWORD = 'obSJX=a*Oyk}';
                                        $mysql = mysqli_connect($HOST,$USER,$PASSWORD,$DATABASE);
                                        
                                        $query="SELECT MAX(est_los), MIN(est_los) FROM estimation_table";
                                        $set = $mysql->query($query);
                                        $result = $set->fetch_assoc();
                                        $max = $result['MAX(est_los)'];
                                        $min = $result['MIN(est_los)'];
                                    ?>
                                    <form class="range-field w-100%">
                                        <input id="los_range" style="background-color:#c70e17;" class="border-0" type="range" value="0" min="0" max="<?php echo $max ?>" />
                                    </form>
                                    <span class="font-weight-bold text-primary ml-2 mt-1 valueSpan"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- main panel, holds dashboard elements -->
                <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-md-4">
                    <!-- Main bar title -->
                    <div class=" d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                        <h3><b>LOS Statistics</b></h3>
                        <div class="btn-toolbar mb-2 mb-md-0">
                            <div class="btn-group mr-2">
                                <button type="button" class="btn btn-sm btn-outline-secondary" data-toggle="modal" data-target="#filter_modal"><b>Chart Filters</b></button>
                            </div>
                        </div>
                    </div>
                    
                    <!-- INJURY STATISTICS; moi, fracture level, and fracture morphology -->
                    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-2 pb-1 mb-2">
                        <div class="card w-100">
                            <div class="card-body">
                                    <h3 classs="lead">Injury Statistics</h3>
                                <hr>
                                <div class="row">
                                    <div class="col-lg-12"> <!-- lg so these adjust first -->
                                        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-2 pb-1 mb-2">
                                            <div class="card w-100">
                                                <div class="card-header">
                                                    Mechanism of Injury
                                                </div>
                                                <div class="card-body">
                                                    <canvas id="chart_MOIVSlos" height="200"></canvas>
                                                </div>
                                            </div>
                                        </div> 
                                    </div>
                                </div>
                                 
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-2 pb-1 mb-2">
                                            <div class="card w-100">
                                                <div class="card-header">
                                                    Fracture Level
                                                </div>
                                                <div class="card-body">
                                                    <canvas id="chart_fracturelevel" height="150"></canvas>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="col-lg-6">
                                        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-2 pb-1 mb-2">
                                            <div class="card w-100">
                                                <div class="card-header">
                                                    Fracture Morphology
                                                </div>
                                                <div class="card-body">
                                                    <canvas id="chart_fracturemorphology" height="150"></canvas>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-2 pb-1 mb-2">
                                            <div class="card w-100">
                                                <div class="card-header">
                                                    Levels fused
                                                </div>
                                                <div class="card-body">
                                                    <canvas id="chart_fused_levels" height="200"></canvas>
                                                </div>
                                            </div>
                                        </div> 
                                    </div>
                                </div> 
                            </div> <!-- end second row -->
                        </div>
                    </div>
                    
                    <!-- SURGERY STATISTICS; blood loss, surgery length, surgical technique and approach -->
                    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-2 pb-1 mb-2">
                        <div class="card w-100">
                            <div class="card-body">
                                <h3 classs="lead">Surgery Statistics</h3>
                                <hr>
                                <div class="row">
                                    <div class="col-lg-6"> <!-- lg so these adjust first -->
                                        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-2 pb-1 mb-2">
                                            <div class="card w-100">
                                                <div class="card-header">
                                                    Blood Loss (mL)
                                                </div>
                                                <div class="card-body">
                                                    <canvas id="chart_bloodloss" height="200"></canvas>
                                                </div>
                                            </div>
                                        </div> 
                                    </div>
                        
                                    <div class="col-lg-6">
                                        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-2 pb-1 mb-2">
                                            <div class="card w-100">
                                                <div class="card-header">
                                                    Surgery Length
                                                </div>
                                                <div class="card-body">
                                                    <canvas id="chart_surgery_length" height="200"></canvas>
                                                </div>
                                            </div>
                                        </div> 
                                    </div>
                                </div>
                                
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-2 pb-1 mb-2">
                                            <div class="card w-100">
                                                <div class="card-header">
                                                    Surgical Technique
                                                </div>
                                                <div class="card-body">
                                                    <canvas id="chart_technique" height="200"></canvas>
                                                </div>
                                            </div>
                                        </div> 
                                    </div>
                                    
                                    <div class="col-lg-6">
                                        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-2 pb-1 mb-2">
                                            <div class="card w-100">
                                                <div class="card-header">
                                                    Surgical Approach
                                                </div>
                                                <div class="card-body">
                                                    <canvas id="chart_approachVSlos" height="200"></canvas>
                                                </div>
                                            </div>
                                        </div> 
                                    </div>
                                </div> 
                                
                            </div> <!-- End surgery statistics -->
                        </div>
                    </div>
                        
                        
                    
                    <!--
                    <!-- fourth row; deviation from estimate LOS 
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-2 pb-1 mb-2">
                                <div class="card w-100">
                                    <div class="card-header">
                                        Average deviation graph per patient (days)
                                    </div>
                                    <div class="card-body">
                                        <canvas id="chart_deviation" height="300"></canvas>
                                    </div>
                                </div>
                            </div> 
                        </div>
                    </div> <!-- end fourth row 
                    -->
                    
            
                    
                    <!-- PATIENT STATISTICS; insurance type, discharge location, age distribution -->
                    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-2 pb-1 mb-2">
                        <div class="card w-100">
                            <div class="card-body">
                                <h3 classs="lead">Patient Statistics</h3>
                                <hr>
                                
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-2 pb-1 mb-2">
                                            <div class="card w-100">
                                                <div class="card-header">
                                                    Insurance Type
                                                </div>
                                                <div class="card-body">
                                                    <canvas id="chart_insuranceVSlos" height="300"></canvas>
                                                </div>
                                            </div>
                                        </div> 
                                    </div>
                                    
                                    <div class="col-lg-6">
                                        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-2 pb-1 mb-2">
                                            <div class="card w-100">
                                                <div class="card-header">
                                                    Discharge Location
                                                </div>
                                                <div class="card-body">
                                                    <canvas id="chart_discharge" height="300"></canvas>
                                                </div>
                                            </div>
                                        </div> 
                                    </div>
                                </div> 
                            
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-2 pb-1 mb-2">
                                            <div class="card w-100">
                                                <div class="card-header">
                                                    Mean LOS By Age
                                                </div>
                                                <div class="card-body">
                                                    <canvas id="chart_ageVSlos2" height="300"></canvas>
                                                </div>
                                            </div>
                                        </div> 
                                    </div>
                                </div> 
                            </div>
                        </div>
                    </div> <!-- end patient statistics -->
                    
                </main> <!-- end main panel -->
            </div>
        </div>
        </div> <!-- end of dashboard elements -->

        <!-- jquery js library -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

        <!-- bootstrap js library -->
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" 
        integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
        
        <!-- popper js library -->
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" 
        integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
        
        <!-- feather icon js pack -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/feather-icons/4.24.1/feather.min.js"></script>
        
        <!-- chart js library -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.3/Chart.min.js"></script>
        
        <!-- this page's specific js library for icons -->
        <script src="./assets/js/main.js"></script>
        
        <!-- initialization scripts for each chart -->
        <script src="./assets/js/statistics/init_insurance.js"></script>
        <script src="./assets/js/statistics/init_injury_mechanism.js"></script>
        
        <script src="./assets/js/statistics/init_ageVSlos2.js"></script>
        <script src="./assets/js/statistics/init_approach.js"></script>
        <script src="./assets/js/statistics/init_fracturelevel.js"></script>
        <script src="./assets/js/statistics/init_fracturemorphology.js"></script>
        <script src="./assets/js/statistics/init_blood_loss.js"></script>
        <script src="./assets/js/statistics/init_technique.js"></script>
        <script src="./assets/js/statistics/init_length.js"></script>
        <script src="./assets/js/statistics/init_discharge_facility.js"></script>
        <script src="./assets/js/statistics/init_levels_fused.js"></script>
        <!-- <script src="./assets/js/statistics/init_deviation.js"></script> -->
        
        <!-- Slider initialization -->
        <script src="./assets/js/statistics/selector_statistics.js"></script>
        
        <!-- chart initializer / updater script -->
        <script src="./assets/js/statistics/update_statistics_cards.js"></script>
    </body>
</html>