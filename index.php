<!--
        'index.php'
        
        This page hosts the main dashboard of the LOS project. In it the admission 
        statistics and distribution is being analysed with the parameters of the
        models that contribute to aa longer or shorter LOS.
-->

<!DOCTYPE html>
<html lang="en">
    <head>
        <!-- specifiers to set page characteristics -->
        <meta http-equiv="Content-Type" content="text/html; charset=shift_jis">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <!-- icon and title in the page tag -->
        <link rel="icon" type="image/png" href="./assets/img/icon60.png">
        <title>Dashboard</title>

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
        </style>
        
        <!-- Set default selected variable at the bar = 1 t the beginning-->
        <script type="text/javascript">
            window.selectedMinLOS=1;
        </script>
    </head>
  
    <body>
        <!-- navbar at the top of the screen -->
        <nav class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0 shadow">
            <a class="navbar-brand col-md-3 col-lg-2 mr-0 px-3" href="#">
                <img style="img-fluid;width:50px" src="./assets/img/icon60.png" class="ml-2 mr-2">LOS | Summary</a>
            
            <!-- this menu appears when the page is very narrow (phones) -->
            <button class="navbar-toggler position-absolute d-md-none collapsed" type="button" 
            data-toggle="collapse" data-target="#sidebarMenu" aria-controls="sidebarMenu" 
            aria-expanded="false" aria-label="Toggle navigation">
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
                                <a class="nav-link active" href=".">
                                    <span data-feather="clipboard"></span>
                                    Dashboard <span class="sr-only">(current)</span>
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

                <!-- modal for chart filter controls -->
                <div class="modal fade" id="filter_modal" tabindex="-1" role="dialog" aria-labelledby="filter_modal_label" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <!-- Title -->
                                <h4 class="modal-title" id="filter_modal_label"><b>Chart Filters</b></h4>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="d-flex flex-row justify-content-center">
                                    <label for="distribution_buttons"><b>LOS Distribution Grouping</b></label>
                                </div>
                                <!-- The singular/grouped buttons group the data into groups of 5 days or display the information in 1 day distribution -->
                                <div class="d-flex flex-row justify-content-center">
                                    <div class="btn-group btn-group-lg" role="group" aria-label="distribution_grouping" id="distribution_buttons">
                                        <button type="button" class="btn btn-sm btn-outline-secondary" id="toggle_single">Singular</button>
                                        <button type="button" class="btn btn-sm btn-outline-secondary" id="toggle_group">Grouped</button>
                                    </div>  
                                </div>
                                <div class="d-flex flex-row justify-content-center mt-4">
                                    <label for="include_los_over"><b>Include admissions with LOS over __ days</b></label>
                                </div>
                                
                                <div class="d-flex flex-row justify-content-center w-100">
                                    <?php
                                        $HOST = 'localhost';
                                        $DATABASE = 'losdb';
                                        $USER = 'root';
                                        $PASSWORD = 'root';
                                        $mysql = mysqli_connect($HOST,$USER,$PASSWORD,$DATABASE);
                                        
                                        $query="SELECT MAX(est_los), MIN(est_los) FROM estimation_table";
                                        $set = $mysql->query($query);
                                        $result = $set->fetch_assoc();
                                        $max = $result['MAX(est_los)'];
                                        $min = $result['MIN(est_los)'];
                                    ?>
                                    <!-- Slider bar -->
                                    <form class="range-field w-100%">
                                        <input id="los_range" class="border-0" type="range" value="0" min="0" max="<?php echo $max ?>" />
                                    </form>
                                    <span class="font-weight-bold text-primary ml-2 mt-1 valueSpan"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> <!-- end chart filter modal -->
                
                <!-- modal to test supplemental action recorder -->
                <div class="modal fade" id="supp_act_modal" tabindex="-1" role="dialog" aria-labelledby="supp_act_modal_label" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title" id="supp_act_modal_label"><b>Supplemental Actions</b></h4>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            
                            <!-- this form will call the php script to insert the action -->
                            <div class="modal-body">
                                <form action="./assets/php/dashboard/insert_supplemental_action.php" method="get">
                                    <div class="row">
                                        <!-- admission selector -->
                                        <div class="col-sm-8">
                                            <div class="form-group">
                                                <label for="patient_admission" class="col-form-label">Patient Admission:</label>
                                                <select class="custom-select" id="patient_admission" name="patient_admission">
                                                    <option disabled selected>Patient ID - Admission Date</option>
                                                    <?php
                                                        $HOST = 'localhost';   $DATABASE = 'losdb';
                                                        $USER = 'root';      $PASSWORD = 'root';
                                                        $mysql = mysqli_connect($HOST,$USER,$PASSWORD,$DATABASE);
                                                        
                                                        $set = $mysql->query("select id, patient_id, entry_date from estimation_table order by entry_date desc");
                                                        
                                                        while ($row = $set->fetch_assoc()) {
                                                            $id = $row['id'];
                                                            $patient_id = $row['patient_id'];
                                                            $entry_date = date('M j Y',strtotime($row['entry_date']));
                                                            
                                                            echo '<option value="'.$id.'">'.$patient_id.' - '.$entry_date.'</option>';
                                                        }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                        
                                        <!-- date taken datepicker -->
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label for="action_date" class="col-form-label">Date Action Taken:</label>
                                                <div class="input-group date" data-provide="datepicker">
                                                    <input type="text" class="form-control" id="action_date" name="action_date" placeholder="MM/DD/YYYY" autocomplete="off">
                                                    <div class="input-group-addon">
                                                        <span class="glyphicon glyphicon-th"></span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <!-- action taken selector -->
                                    <div class="form-group">
                                        <label for="action_taken" class="col-form-label">Supplemental Action Taken:</label>
                                        <select class="custom-select" id="action_taken" name="action_taken">
                                            <option disabled selected>Select an action...</option>
                                            <option value="physical_therapy">Began physical therapy</option>
                                            <option value="social_worker_assigned">Assigned a social worker</option>
                                        </select>
                                    </div>
                                    
                                    <!-- comment field -->
                                    <div class="form-group">
                                        <label for="comment" class="col-form-label">Comment:</label>
                                        <textarea class="form-control" id="comment" name="comment" placeholder="Add additional information here..." ></textarea>
                                    </div>
                                    
                                    <!-- this button submits the form, triggering the php script -->
                                    <div class="modal-footer">
                                        <button type="submit" class="btn btn-primary">Submit</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div> <!-- end supplemental action modal -->

                <!-- main panel, holds dashboard elements -->
                <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-md-4">
                    <div class=" d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                        <h3><b>Dashboard</b></h3>
                        <div class="btn-toolbar mb-2 mb-md-0">
                            <div class="btn-group mr-2">
                                <button type="button" class="btn btn-sm btn-outline-secondary" data-toggle="modal" data-target="#filter_modal"><b>Chart Filters</b></button>
                            </div>
                        </div>
                    </div>
                    
                    <!-- first row; basic number cards -->
                    <div class="row">
                        <!-- Chart calculating the Avg. LOS and displaying the value -->
                        <div class="col-lg-4 cards_first_row"> 
                            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-2 pb-1 mb-2">
                                <div class="card w-100">
                                    <div class="card-header">
                                       Mean Length-Of-Stay
                                    </div>
                                    <div class="card-body text-center">
                                        <h2 id="averageLOS"></h2>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- These two charts calculate the admissions analyzed so far (Amount of records in the DB) -->
                            <!-- This first chart is displayed when the slide bar selector is set at 1 -->
                            <div class="col-lg-4 cards_first_row" id="admissions_analysed"> <!-- lg so these adjust first -->
                                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-2 pb-1 mb-2">
                                    <div class="card w-100" id="admissions_analysed">
                                        <div class="card-header">
                                           Admissions Analyzed
                                        </div>
                                        <div class="card-body text-center">
                                            <h2 id="count_data"></h2>
                                        </div>
                                    </div>
                                </div>
                            </div>
                    
                            <!-- The second graph is displayed if the selector is at more than 1 day -->
                            <div class="col-lg-4 cards_first_row" id="admissions_higher_than_1_day">
                                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-2 pb-1 mb-2">
                                    <div class="card w-100" >
                                        <div class="card-header">
                                            Patients With LOS ><span class="font-weight-bold text-primary ml-2 mt-1 valueSpan"></span> Days
                                        </div>
                                        <div class="card-body text-center">
                                            <h2 id="countMore5"></h2>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        
                        <!-- Chart of admitted patients at the moment. AKA patients that haven't been discharged yet -->
                        <div class="col-lg-4 cards_first_row">
                            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-2 pb-1 mb-2">
                                <div class="card w-100">
                                    <div class="card-header">
                                       Current Admissions
                                    </div>
                                    <div class="card-body text-center">
                                        <h2 id="admittedpatients"></h2>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> <!-- end first row -->
                    
                    
                    <!-- this was going to be the slider, clean up later -Ryan -->
                    <!--<div class="row">
                     <div class="col-md-6">
                          <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-2 pb-1 mb-2">
                                <div class="card w-100">
                                    <div class="card-header">
                                        MAXIMUM LOS SELECTOR
                                    </div>
                                    
                                    <div class="card-body">
                                        <div class="d-flex justify-content-center">
                                          <form class="range-field w-100%">
                                            <input id="slider11" class="border-0" type="range" min="<?php echo $min ?>" max="<?php echo $max ?>" />
                                          </form>
                                          <span class="font-weight-bold text-primary ml-2 mt-1 valueSpan"></span>
                                        </div>
                                
                                    </div>
                                </div>
                            </div> 
                     </div>-->
                    
                    <!-- second row; LOS distribution among people. Amount of people with a certain LOS. Chart filters can be applied to this graph grouping by 5 days or keeping it individually -->
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-2 pb-1 mb-2">
                                <div class="card w-100">
                                    <div class="card-header">
                                        Length-Of-Stay distribution among admissions
                                    </div>
                                    <div class="card-body">
                                        <canvas id="chart_patientsVSlos" height="300"></canvas>
                                    </div>
                                </div>
                            </div> 
                        </div>
                    </div> <!-- end second row -->
                    
                    <!-- Third row; effect of the parameters on the LOS. Analyses both models showing ordered by longer LOS what factors are more determinant -->
                    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-2 pb-1 mb-2">
                        <div class="card w-100">
                            <div class="card-body">
                                    <h3 classs="lead">Parameters' effect on LOS</h3>
                                <hr>
                                <!-- third row; detrimental var cards: Gets the higher influencing LOS parameters. In other words, allows a quick analysis of the graphs bellow -->
                                <div class="row">
                                    <!-- Model 1 -->
                                    <div class="col-lg-6"> <!-- lg so these adjust first -->
                                        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-2 pb-1 mb-2">
                                            <div class="card w-100">
                                                <div class="card-header">
                                                    Most Detrimental Var w/ Pre-Op Vars
                                                </div>
                                                <div class="card-body text-center">
                                                    <h4 id="longest_los_1"></h4>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <!-- Model 2 -->
                                    <div class="col-lg-6">
                                        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-2 pb-1 mb-2">
                                            <div class="card w-100">
                                                <div class="card-header">
                                                    Most Detrimental Var w/ All Vars
                                                </div>
                                                <div class="card-body text-center">
                                                    <h4 id="longest_los_2"></h4>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div> <!-- end of third row-->
            
                                <!-- forth row; mean LOS for each parameter. Detailed analysis of the previos graphs -->
                                <div class="row">
                                    <div class="col-lg-6"> <!-- lg so these adjust first -->
                                        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-2 pb-1 mb-2">
                                            <div class="card w-100">
                                                <div class="card-header">
                                                    Mean LOS Per Var w/ Pre-Op Vars
                                                </div>
                                                <div class="card-body">
                                                    <canvas id="chart_parametersModel1" height="300"></canvas>
                                                </div>
                                            </div>
                                        </div> 
                                    </div>
                                    
                                    <div class="col-lg-6">
                                        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-2 pb-1 mb-2">
                                            <div class="card w-100">
                                                <div class="card-header">
                                                    Mean LOS Per Var w/ All Vars
                                                </div>
                                                <div class="card-body">
                                                    <canvas id="chart_parametersModel2" height="300"></canvas>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                </div> <!-- end third row -->
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
        <script src="./assets/js/dashboard/init_admissionsLOS.js"></script>
        <script src="./assets/js/dashboard/init_parametersModel1.js"></script>
        <script src="./assets/js/dashboard/init_parametersModel2.js"></script>
        


        <!-- global variable initialization -->
        <script type="text/javascript">
            window.grouped = 'f'; // f is for false
            window.range_active = 'f'; // f is for false
        </script>
        
        <!-- chart initializer / updater script -->
        <script src="./assets/js/dashboard/update_dashboard_cards.js"></script>
    </body>
</html>