<!-- Model_1_questions.php  -->
<!-- Hospital Length of Stay estimator  -->
<!-- Retrieves questions based on Steven Ludwig's model stored on our database 
using Jquery calls.-->  

<!DOCTYPE html>  
<html lang="en"><!-- English language -->
<link rel="icon" type="image/png" href="../images/tab_logo.png"> 
 <head>
    
    <meta http-equiv="Content-Type" content="text/html; charset=shift_jis">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <html lang="en"><!-- English language --> 
    <link rel="icon" type="image/png" href="../images/tab_logo.png" >
    
    <title>LOS Estimator</title>
     
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">    
    
    <!-- JavaScript -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

    <!-- CSS -->
    <link rel="stylesheet" type="text/css" href="../css/answer_button_style.css">
    <link rel="stylesheet" type="text/css" href="../css/main.css">

<!-- Php code: Connection to the LOCDB to retrieve the questions -->  
        <?php
            $HOST = 'localhost';
            $DATABASE = 'LOSDB';
            $USER = 'bfokin';
            $PASSWORD = 'obSJX=a*Oyk}';
            $mysql = mysqli_connect($HOST,$USER,$PASSWORD,$DATABASE);
            
            $num_questions = 5;
        ?>


 </head>
    <body>
        <!-- navbar at the top of the screen -->
        <nav class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0 shadow">
            <a class="navbar-brand col-md-3 col-lg-2 mr-0 px-3" href="#"><img style="img-fluid;width:50px" src="../images/icon60.png" class="ml-2 mr-2">LOS | Estimator</a>
            
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
                                <a class="nav-link" href="../../los_dash/los_statistics.php">
                                    <span data-feather="bar-chart-2"></span>
                                    LOS Statistics <span class="sr-only">(current)</span>
                                </a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link" href="../../los_dash/patient_overview.php">
                                    <span data-feather="users"></span>
                                    Patient Overview <span class="sr-only"></span> 
                                </a>
                            </li>
                            
                            <li class="nav-item">
                                <a class="nav-link" href="../../los_dash/specialist_overview.php">
                                    <span data-feather="activity"></span>
                                    Specialist Overview <span class="sr-only"></span> 
                                </a>
                            </li> 
                            
                            <li class="nav-item">
                                <a class="nav-link" href="../../los_dash/possible_procedures.php">
                                    <span data-feather="tool"></span>
                                    Procedure Analysis <span class="sr-only"></span> 
                                </a>
                            </li> 
                            
                        </ul>
                        
                        <!-- second grouping; holds LOS estimator page -->
                        <ul class="nav flex-column mt-3 mb-2">
                            <li class="nav-item">
                                <a class="nav-link active" href="https://connectedcaresystems.com/los/los_questions/">
                                    <span data-feather="sliders"></span>
                                    LOS Estimator <span class="sr-only"></span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="../../los_dash/data_new_patient.php">
                                    <span data-feather="user-plus"></span>
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
                                    <h1 class="display-4" style="font-size:40px">Preoperative Variables Only</h1>
                                </div>
                    </div>
                    <hr>

                    <!-- DROPDOWN BAR Medical Center select-->
                    <div class="row justify-content-center" >

                            <div class="jumbotron text-center pt-4 pb-4 mb-0" style="background-color:#fff">
                                    <select class="form-control-lg text-center"  id="select_center" name="select_center" style="width:300px; text-align:center; background-color:#fff">
                                        <?php include './update_mcender_list.php'; ?>
                                    </select>
                            </div> 
                    </div>         
                    
                    <!-- DROPDOWN BAR Physician select-->
                    <div class="row justify-content-center" >

                            <div class="jumbotron text-center pt-4 pb-4 mb-0" style="background-color:#fff">
                                    <select class="form-control-lg text-center"  id="select_physician" name="select_physician" style="width:300px; text-align:center; background-color:#fff">
                                        <option value= "" disabled selected hidden>Select Physician</option>
                                    </select>
                            </div> 
                        
                        <!-- patient search box -->

                            <div class="jumbotron text-center pt-4 pb-4 mb-0" style="background-color:#fff">
                                <select class="form-control-lg text-center" id="select_patient" name="select_patient" style="width:300px; text-align:center; background-color:#fff">
                                    <option value = "" selected disabled value="">Select Patient</option>
                                </select>
                            </div>
                    </div>
                    
                    <hr>
                                
                                <div class="container">
                                <!-- MODEL 1 -->
                                            <?php
                                                $query="SELECT question_id, question_body FROM model_questions_table WHERE question_id >0 And question_id < 6";
                                                $result_set = $mysql->query($query);
                                            
                                                //question 1
                                                $row = $result_set -> fetch_assoc();
                                                $ID=$row['question_id'];
                                                $question=$row['question_body'];
                                            ?> 
                                               <form class="bool_question_1" id="<?php echo "q$ID"?>" data-question="<?php echo $ID?>"> <!-- Form with ID of the form "q1, q2..." and data-question="1,2,3.." -->
                                                    <h3 style="text-align: center;"><?php echo $ID.". ".$question ?></h3> <!-- Question retrieved from the DB -->
                                                    <br><br>
                                                    <div class="button-wrap">
                                                        <input type="number" id = "text_box_1" placeholder="0" onkeypress="return is_number_key(event)" type="text" name="txtNumber" style="width:300px; text-align:center;font-size:28px; font-weight:bold"><br>
                                                    </div>
                                                    <br>
                                                </form>
                                                
                                            <?php
                                                //question 2
                                                $row = $result_set -> fetch_assoc();
                                                $ID=$row['question_id'];
                                                $question=$row['question_body'];
                                            ?> 
                                               <form class="bool_question_1" id="<?php echo "q$ID"?>" data-question="<?php echo $ID?>"> <!-- Form with ID of the form "q1, q2..." and data-question="1,2,3.." -->
                                                    <h3 style="text-align: center;"><?php echo $ID.". ".$question ?></h3> <!-- Question retrieved from the DB -->
                                                    <br><br>
                                                    <div class="button-wrap">
                                                        <input type="radio" id="radio_<?php echo "$ID"?>_1"  name="<?php echo "q$ID"?>" class="hidden radio-label" style="width:300px;"/></input><!-- Radio button, option YES. name="q1,q2..."-->
                                                        <label for="radio_<?php echo "$ID"?>_1" id="1" class="question_button"><h1 style="width:300px; text-align:center; font-size:28px; font-weight:bold">1</h1></label>
                                                        
                                                        <input type="radio"  id="radio_<?php echo "$ID"?>_2"  name="<?php echo "q$ID"?>" class="hidden radio-label" style="width:300px;"/></input> <!-- Radio button, option NO. name="q1,q2..."-->
                                                        <label for="radio_<?php echo "$ID"?>_2" id="2" class="question_button"><h1 style="width:300px; text-align:center; font-size:28px;font-weight:bold">2</h1></label>
                                                        
                                                        <input type="radio" id="radio_<?php echo "$ID"?>_3"  name="<?php echo "q$ID"?>" class="hidden radio-label" style="width:300px;"/></input><!-- Radio button, option YES. name="q1,q2..."-->
                                                        <label for="radio_<?php echo "$ID"?>_3" id="3" class="question_button"><h1 style="width:300px; text-align:center; font-size:28px; font-weight:bold">3</h1></label>
                                                        
                                                        <input type="radio"  id="radio_<?php echo "$ID"?>_4"  name="<?php echo "q$ID"?>" class="hidden radio-label" style="width:300px;"/></input> <!-- Radio button, option NO. name="q1,q2..."-->
                                                        <label for="radio_<?php echo "$ID"?>_4" id="4" class="question_button"><h1 style="width:300px; text-align:center; font-size:28px; font-weight:bold">4</h1></label>

                                                        <input type="radio"  id="radio_<?php echo "$ID"?>_5"  name="<?php echo "q$ID"?>" class="hidden radio-label" style="width:300px;"/></input> <!-- Radio button, option NO. name="q1,q2..."-->
                                                        <label for="radio_<?php echo "$ID"?>_5" id="5" class="question_button"><h1 style="width:300px; text-align:center; font-size:28px; font-weight:bold">5</h1></label>
                                                    </div>
                                                    <br>
                                                </form> 
                                                
                                            <?php
                                                //question 3
                                                $row = $result_set -> fetch_assoc();
                                                $ID=$row['question_id'];
                                                $question=$row['question_body'];
                                            ?> 
                                               <form class="bool_question_1" id="<?php echo "q$ID"?>" data-question="<?php echo $ID?>"> <!-- Form with ID of the form "q1, q2..." and data-question="1,2,3.." -->
                                                    <h3 style="text-align: center;"><?php echo $ID.". ".$question ?></h3> <!-- Question retrieved from the DB -->
                                                    <br><br>
                                                    <div class="button-wrap">
                                                        <input type="radio" id="radio_<?php echo "$ID"?>_yes"  name="<?php echo "q$ID"?>" class="hidden radio-label" style="width:300px;"/></input><!-- Radio button, option YES. name="q1,q2..."-->
                                                        <label for="radio_<?php echo "$ID"?>_yes" id="yes" class="question_button"><h1 style="width:300px; text-align:center; font-size:28px; font-weight:bold">Complete Injury</h1></label>                            
                                                        
                                                        <input type="radio"  id="radio_<?php echo "$ID"?>_no"  name="<?php echo "q$ID"?>" class="hidden radio-label" style="width:300px;"/></input> <!-- Radio button, option NO. name="q1,q2..."-->
                                                        <label for="radio_<?php echo "$ID"?>_no" id="no" class="question_button"><h1 style="width:300px; text-align:center; font-size:28px; font-weight:bold">OTHER</h1></label>
                                    
                                                    </div>
                                                    <br>
                                                </form>
                                                
                                            <?php
                                                //question 4
                                                $row = $result_set -> fetch_assoc();
                                                $ID=$row['question_id'];
                                                $question=$row['question_body'];
                                            ?> 
                                               <form class="bool_question_1" id="<?php echo "q$ID"?>" data-question="<?php echo $ID?>"> <!-- Form with ID of the form "q1, q2..." and data-question="1,2,3.." -->
                                                    <h3 style="text-align: center;"><?php echo $ID.". ".$question ?></h3> <!-- Question retrieved from the DB -->
                                                    <br><br>
                                                    <div class="button-wrap">
                                                        <input type="radio" id="radio_<?php echo "$ID"?>_yes"  name="<?php echo "q$ID"?>" class="hidden radio-label" style="width:300px;"/></input><!-- Radio button, option YES. name="q1,q2..."-->
                                                        <label for="radio_<?php echo "$ID"?>_yes" id="yes" class="question_button"><h1 style="width:300px; text-align:center; font-weight:bold">YES</h1></label>
                            
                                                        <input type="radio"  id="radio_<?php echo "$ID"?>_no"  name="<?php echo "q$ID"?>" class="hidden radio-label" style="width:300px;"/></input> <!-- Radio button, option NO. name="q1,q2..."-->
                                                        <label for="radio_<?php echo "$ID"?>_no" id="no" class="question_button"><h1 style="width:300px; text-align:center;font-weight:bold">NO</h1></label>
                                                    </div>
                                                    <br>
                                                </form>   
                                                
                                            <?php
                                                //question 5
                                                $row = $result_set -> fetch_assoc();
                                                $ID=$row['question_id'];
                                                $question=$row['question_body'];
                                            ?> 
                                                <form class="bool_question_1">
                                                   <h3 style="text-align: center;"><?php echo $ID.". ".$question ?></h3> <!-- Question retrieved from the DB -->
                                                    <br><br>
                                                    <div class="button-wrap">
                                                    <input type="number" id = "text_box_2" placeholder="0" onkeypress="return is_number_key(event)" type="text" name="txtNumber" style="width:300px; text-align:center;font-size:28px; font-weight:bold"><br>
                                                    </div>
                                                    <br>
                                                </form> 
                                                
                                        <?php     
                                            $mysql -> close(); 
                                        ?>
                                            <br>
                                                <!-- Submit button will be called for action in model_questions.js -->
                                                <form class="move_button"> <!-- Form with ID of the form "q1, q2..." and data-question="1,2,3.." -->
                                                    <div class="button-wrap">
                                                        <br><br>
                                                        <input type="radio"  id="radio_submit"  name="move"class="hidden radio-label" style="width:300px;"/></input> <!-- Radio button, option NO. name="q1,q2..."-->
                                                        <label for="radio_submit" id="submit_1" name="move" class="question_button"><h1 style="width:300px; text-align:center;font-weight:bold">Submit</h1></label>
                                                    </div>
                                                    <br>
                                                </form>
                                            <div id="final"></div>
                                            <br><br><br>
                            </div>
                    
                </main> <!-- end main panel -->
            </div>
        </div> <!-- end page elements -->

        <br><br><br><br><br>
        
<!--   Core JS Files   -->

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
        
         <!-- this page's specific js library for icons -->
        <script src="../los_dash/assets/js/main.js"></script>
        
         <!-- feather icon js pack -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/feather-icons/4.24.1/feather.min.js"></script>

        <!-- moment js (for time-stuff) & chart js library -->
        <script src="https://momentjs.com/downloads/moment.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.3/Chart.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/chartjs-plugin-annotation/0.5.7/chartjs-plugin-annotation.min.js"></script>
        
        <script src="../js/model_questions.js"></script> <!-- JS file -->
        
          <!-- this page's specific js library for icons -->
        <script src="../../los_dash/assets/js/main.js"></script>
        
    </body>
</html>