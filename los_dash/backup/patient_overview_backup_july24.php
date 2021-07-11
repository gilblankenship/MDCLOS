<!--
        'statistics.php'
-->
<!DOCTYPE html> <!-- HTML5 -->
<html lang="en">
    <head><meta http-equiv="Content-Type" content="text/html; charset=shift_jis">
        <!-- specifiers to set page characteristics -->
        
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <!-- icon and title in the page tag -->
        <link rel="icon" type="image/png" href="./assets/img/icon60.png">
        <title>Patient Overview</title>

        <!-- Bootstrap core CSS -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" 
        integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
        
        <!-- custom styles for this page -->
        <link href="./assets/css/main.css" rel="stylesheet">
        <link href="./assets/css/overview/overview_style.css"  rel="stylesheet"> 

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
            .form-control {
                height: 30px;
                width: 120px;
                text-align-last: right;
                padding-top: 0px;
                padding-bottom: 0px;
                padding-right: 0px;
                padding-left: 1px;
            }
        </style>
    </head>
  
    <body>
        <!-- navbar at the top of the screen -->
        <nav class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0 shadow">
            <a class="navbar-brand col-md-3 col-lg-2 mr-0 px-3" href="#"><img style="img-fluid;width:50px" src="./assets/img/icon60.png" class="ml-2 mr-2">LOS | Summary</a>
            
            <a href="http://connectedcaresystems.com/los/los_questions/" class="btn btnlos mr-3" role="button">LOS Estimator</a>
            
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
                            <!--
                            <li class="nav-item">
                                <a class="nav-link" href="./estimator_insights.php">
                                    <span data-feather="zap"></span>
                                    Estimator Insights <span class="sr-only"></span>
                                </a>
                            </li>
                            -->

                            <li class="nav-item">
                                <a class="nav-link active" href="./patient_overview.php">
                                    <span data-feather="clipboard"></span>
                                    Patient Overview <span class="sr-only">(current)</span> 
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
                                        
                                        $query="SELECT MAX(est_los), MIN(est_los) FROM main_data_table";
                                        $set = $mysql->query($query);
                                        $result = $set->fetch_assoc();
                                        $max = $result['MAX(est_los)'];
                                        $min = $result['MIN(est_los)'];
                                    ?>
                                    <form class="range-field w-100%">
                                        <input id="los_range" style="background-color:#c70e17;" class="border-0" type="range" value="1" min="<?php echo $min ?>" max="<?php echo $max ?>" />
                                    </form>
                                    <span class="font-weight-bold text-primary ml-2 mt-1 valueSpan"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- main panel, holds dashboard elements -->
                <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-md-4">
                    <div class=" d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                        <h3><b>Patient Overview</b></h3>
                        <div class="btn-toolbar mb-2 mb-md-0">
                            <div class="btn-group mr-2">
                                <button type="button" class="btn btn-sm btn-outline-secondary" data-toggle="modal" data-target="#filter_modal"><b>Filters</b></button>
                            </div>
                        </div>
                    </div>
                    
                <div class="container-fluid" style="background-color:#ebebeb;"> <!-- Container of the form -->
                            <style>
                            .form-control-lg {
                            	text-align: center;
                            	font-weight:bold;
                                color: #000000;
                                background-color: #FFFFFF;
                            }
                             .form-control-lg h1{
                            	 font-size: 2em;
                            	 font-family: "Lato", sans-serif;
                            }
                            </style>
                            <br><br>
                            <!-- DROPDOWN BAR-->
                            <form method="post">
                                <div class="button-wrap">
                                    <br>
                                    <h3 style="text-align: relative;">Patient Search</h3>
                                    <select class="form-control-lg" id="select_patient" name="patients">
                                        <option value="" disabled selected hidden></option>
                                    
                                        <?php
                                            $query = "SELECT DISTINCT last_name, first_name, patient_id FROM patient_table";
                                            $result_set = $mysql->query($query);
                                            
                                            while($rows = $result_set->fetch_assoc()) {
                                                //Pick out the data of the patients from the query result set
                                                    $last_name = $rows['last_name'];
                                                    $first_name = $rows['first_name'];
                                                    $patient_id = $rows['patient_id'];
                                                //Complete name
                                                    $name=$last_name." , ".$first_name;
                                                    echo "<option value='$patient_id'>$name</option>";
                                                
                                            }
                                        ?>
                                    </select>
                                    <br><br>
                                </div>
                            </form>
                </div>
                    
                     <body>
                      <div class="container">
                       <br />
                       <div id="load_data"></div>
                       <div id="load_data_message"></div>
                       <br />
                       <br />
                       <br />
                       <br />
                       <br />
                       <br />
                      </div>
                     </body>                    

                    
                </main> <!-- end main panel -->
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
        <script src="https://cdnjs.cloudflare.com/ajax/libs/feather-icons/4.9.0/feather.min.js"></script>
        
        <!-- this page's specific js library for icons -->
        <script src="./assets/js/main.js"></script>
        
        <!-- Add's the scrollable functionality -->
        <script src="./assets/js/overview/scroll.js"></script>
        
    </body>
</html>