/******************************************************************************                                                       *
 * File is used to go through model 1 and produce a result of the LOC model   *
 * created by Dr. Ludwig                                                      *
 ******************************************************************************/
  
/****************************************************************************** 
 * Variables                                                                  * 
 ******************************************************************************/
var answers = [];
var values = []; 
var result = 0;
var i = 0; 
var text_value = 0; 

/******************************************************************************
 * Functions                                                                  *
 ******************************************************************************/

/******************************************************************************
 *  Functions that are used to relocate the user to another page              *
 ******************************************************************************/
function main_page() { 
            window.location.href="http://connectedcaresystems.com/los/los_questions"; 
}

/******************************************************************************
 *  Functions used to prevent text input from being anything but numbers      *
 ******************************************************************************/
function is_number_key(evt) {
    var charCode = (evt.which) ? evt.which : evt.keyCode;
	if (charCode != 46 && charCode > 31 && (charCode < 48 || charCode > 57))
	    return false;
	return true;
} 

/******************************************************************************
 * Function used to give "precision" number of decimal places of a given value*
 ******************************************************************************/
function round(value, precision) {
    var multiplier = Math.pow(10, precision || 0);
    return Math.round(value * multiplier) / multiplier;
}

/******************************************************************************
 * Function used to send data and navigate to the results page                *
 ******************************************************************************/
//MODEL 1
function finalize_input_1 (paramJSOM){
    //AJAX call to send the results into the DB
    $.ajax({
                type: 'POST',
                url: 'DB_model_1.php',
                data: {'losEstimation':window.los, answers:paramJSOM}, // Variables are send like '___':___ | Arrays are send like ____:____
                success: function() {
                    //alert('Works');
                    $('.custom-select').hide();
                    $('.form-control-lg').hide();
                    $('.move_button').hide();
                    $('.bool_question_1').hide();
                    $('#final').html('<h3 style="text-align:center;font-weight:bold;">Estimated Length-of-Stay: '+window.los+ ' days</h3> \
                                      <h3 style="text-align:center;font-weight:bold;">Time Left: <p id="countdown"></p></h3> \
                                      <script> \
                                        var d = new Date(); \
                                        d.setDate(d.getDate() + '+window.los+'); \
                                        var countDownDate = new Date(d).getTime(); \
                                        \
                                        var x = setInterval(function() { \
                                            \
                                            var now = new Date().getTime(); \
                                            \
                                            var distance = countDownDate - now; \
                                            \
                                            var days = Math.floor(distance / (1000 * 60 * 60 * 24)); \
                                            var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60)); \
                                            var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60)); \
                                            var seconds = Math.floor((distance % (1000 * 60)) / 1000); \
                                            document.getElementById("countdown").innerHTML = days + "d " + hours + "h " \
                                            + minutes + "m " + seconds + "s "; \
                                            \
                                            if (distance < 0) { \
                                                clearInterval(x); \
                                                document.getElementById("countdown").innerHTML = "EXPIRED"; \
                                            } \
                                        }, 1000); \
                                      </script> \
                                      <hr> \
                                      ');
        
                },
                error: function() {
                    //alert('Failure');
                }
    });
}

//MODEL 2
function finalize_input_2 (paramJSOM){
    //AJAX call to send the results into the DB
    $.ajax({
                type: 'POST',
                url: 'DB_model_2.php',
                data: {'losEstimation':window.los, answers:paramJSOM}, // Variables are send like '___':___ | Arrays are send like ____:____
                success: function() {
                    //alert('Works');
                    $('.custom-select').hide();
                    $('.form-control-lg').hide();
                    $('.move_button').hide();
                    $('.bool_question_2').hide();
                    $('#final').html('<h3 style="text-align:center;font-weight:bold;">Estimated Length-of-Stay: '+window.los+ ' days</h3> \
                                      <h3 style="text-align:center;font-weight:bold;">Time Left: <p id="countdown"></p></h3> \
                                      <script> \
                                        var d = new Date(); \
                                        d.setDate(d.getDate() + '+window.los+'); \
                                        var countDownDate = new Date(d).getTime(); \
                                        \
                                        var x = setInterval(function() { \
                                            \
                                            var now = new Date().getTime(); \
                                            \
                                            var distance = countDownDate - now; \
                                            \
                                            var days = Math.floor(distance / (1000 * 60 * 60 * 24)); \
                                            var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60)); \
                                            var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60)); \
                                            var seconds = Math.floor((distance % (1000 * 60)) / 1000); \
                                            document.getElementById("countdown").innerHTML = days + "d " + hours + "h " \
                                            + minutes + "m " + seconds + "s "; \
                                            \
                                            if (distance < 0) { \
                                                clearInterval(x); \
                                                document.getElementById("countdown").innerHTML = "EXPIRED"; \
                                            } \
                                        }, 1000); \
                                      </script> \
                                      ');
        
                },
                error: function() {
                    //alert('Failure');
                }
    });
}
/******************************************************************************
 * Main runner of the js file                                                 *
 ******************************************************************************/
$(document).ready(function(){  
    document.getElementById("select_patient").disabled = true;
    document.getElementById("select_physician").disabled = true;
    
});

   $('#select_center').change(function() {
      window.center_id = document.getElementById("select_center").value;
      document.getElementById("select_patient").disabled = true;
      document.getElementById("select_physician").disabled = false;
      
      document.getElementById("select_patient").innerHTML = '<option value= "" disabled selected hidden>Select Patient</option>';
      
        // Used to populate patient info card ------------------------------
        $.ajax({
            type: 'GET',
            url: '../php/update_physician_list.php',
            data: {'center_id' : window.center_id},
            success: function (result) {
                document.getElementById("select_physician").innerHTML = result;
            },
            error: function (result) {
                alert('Failure on the AJAX: Update physcian list!');
            }
        });      
   });
   
   $('#select_physician').change(function() {
      window.physician_id = document.getElementById("select_physician").value;
      document.getElementById("select_patient").disabled = false;
      
        // Used to populate patient info card ------------------------------
        $.ajax({
            type: 'GET',
            url: '../php/update_patient_list.php',
            data: {'physician_id' : document.getElementById("select_physician").value, 'center_id' : document.getElementById("select_center").value},
            success: function (result) {
                document.getElementById("select_patient").innerHTML = result;
            },
            error: function (result) {
                alert('Failure on the AJAX: Update patient list!');
            }
        });      
   });
/******************************************************************************
 * Model_1, stores info into the answers array on button click                *
 * For no buttons                                                             *
 * There are 2 questions with answer YES/NO in model 1. First one, is either  *
 * Other or complete injury, and the other just yes or no                     *
 ******************************************************************************/    
    $('.bool_question_1 #no').click(function(){ 
        
        //Get data attributes
        current = $(this).parents('form:first').data('question'); //Get the number ID of the current question
        if (current == 3) {
            answers[current - 1] = -0.14;
            values[2] = 'Other';
        }
        else {
            answers[current - 1] = -0.12;
            values[3] = 0;
        }
    });
    
/******************************************************************************
 * Model_1, stores info into the answers array on button click                *
 * For yes buttons                                                            *
 ******************************************************************************/    
    $('.bool_question_1 #yes').click(function(){

        //Get data attributes
        current = $(this).parents('form:first').data('question'); //Get the number ID of the current question
        if (current == 3) {
            answers[current - 1] = 0.14;
            values[2] = 'Complete Injury';
        }
        else {
            answers[current - 1] = 0.12;
            values[3] = 1;
        }
    });

/******************************************************************************
 * Model_2, stores info into the answers array on button click                *
 * For no buttons                                                             *
 ******************************************************************************/    
    $('.bool_question_2 #no').click(function(){ 
        
        //Get data attributes
        current = $(this).parents('form:first').data('question'); //Get the number ID of the current question
        
        if (current == 3) {
            answers[current - 1] = -0.12;
            values[2] = 'Other';
        }
        
        else if (current == 4) {
            answers[current - 1] = -0.16;
            values[3] = 0;
        }
        
        else if (current == 6) {
            answers[current - 1] = -0.085;
            values[4] = 0;
        }
        else if (current == 7) {
            answers[current - 1] = -0.20;
            values[5] = 0;
        }
        else if (current == 8) {
            answers[current -1] = -0.11;
            values[6] = 'Other';
        }
    });

/******************************************************************************
 * Model_2, stores info into the answers array on button click                *
 * For yes buttons                                                            *
 ******************************************************************************/    
    $('.bool_question_2 #yes').click(function(){
        
        //Get data attributes
        current = $(this).parents('form:first').data('question'); //Get the number ID of the current question
        
        if (current == 3) {
            answers[current - 1] = 0.12;
            values[2] = 'Complete Injury';
        }
        
        else if (current == 4) {
            answers[current - 1] = 0.16;
            values[3] = 1;
        }
        
        else if (current == 6) {
            answers[current - 1] = 0.085;
            values[4] = 1;
        }
        else if (current == 7) {
            answers[current - 1] = 0.20;
            values[5] = 1;
        }
        else if (current == 8) {
            answers[current -1] = 0.11;
            values[6] = 'Rehab facility';
        }
        
    });
    
/******************************************************************************
 * Model_1/2, stores info into the answers 1,2,3, or 4 for asa                *
 ******************************************************************************/    
    $('.bool_question_1 #1').click(function(){ 
        answers[1] = -0.17;
        values[1] = 1;
    });
    $('.bool_question_1 #2').click(function(){
        answers[1] = -0.17;
        values[1] = 2;
    });
    $('.bool_question_1 #3').click(function(){ 
        answers[1] = 0.17;
        values[1] = 3;        
    });
    $('.bool_question_1 #4').click(function(){
        answers[1] = 0.17;
        values[1] = 4;
    });
    $('.bool_question_1 #5').click(function(){
        answers[1] = 0.17;
        values[1] = 5;
    });
    $('.bool_question_2 #1').click(function(){ 
        answers[1] = -0.096;
        values[1] = 1;
    });
    $('.bool_question_2 #2').click(function(){
        answers[1] = -0.096;
        values[1] = 2; 
    });
    $('.bool_question_2 #3').click(function(){ 
        answers[1] = 0.096;
        values[1] = 3;         
    });
    $('.bool_question_2 #4').click(function(){
        answers[1] = 0.096;
        values[1] = 4; 
    });
    $('.bool_question_2 #5').click(function(){
        answers[1] = 0.096;
        values[1] = 5;
    });    
    
/******************************************************************************
 * Handles the press of the submit button from model 1                        *
 ******************************************************************************/     
    //TODO NEED TO COLLECT THE INFO FROM QUESTION 5 "ISS" 
    $('.move_button #submit_1').click(function(){
        gcs = document.getElementById("text_box_1").value.toString();
        text_value = document.getElementById("text_box_2").value.toString();
        id = document.getElementById("select_patient").value.toString();
        

        if(gcs === "") {
            gcs = "0";
        }
        
        if(text_value === "") {
            text_value = "0";
        }
        
        if (document.getElementById("select_center").value == "") {
          alert('Please select a Medical center.');  
        }  
        
        else if (document.getElementById("select_physician").value == "") {
          alert('Please select a Physician.');  
        }  

        else if (document.getElementById("select_patient").value.toString() == "") {
          alert('Please select a Patient.');  
        }         
        
        else {

            if ((gcs.match(/^[0-9]+(.[0-9]+)?$/g) != null) && (text_value.match(/^[0-9]+(.[0-9]+)?$/g) != null)) {
                
                values[0] = Number(gcs);
                answers[4] = 0.012 * text_value; // need to extract the text from this question
                answers[5] = id; 
                
                if (gcs >= 11){
                    answers[0] = -0.52;
                }
                else {
                    answers[0] = 0.52;
                }
                
                if ((!answers.includes()) && (id !== "")) {
                    result = 2.30;//Intercept
                    /*Sum to the intercept the values in the array*/
                    for (i = 0; i < 5; i++) {
                      result += answers[i];
                    }
                    result = Math.exp(result);
                    result = round(result, 0);
                    //Assign a global variable to los
                    answers[6] = values[0];
                    answers[7] = values[1];
                    answers[8] = values[2];
                    answers[9] = values[3];
                    answers[10] = Number(text_value);
                    window.los = result;
                    var paramJSON = JSON.stringify(answers);
                    finalize_input_1(paramJSON); //Final result with the estimated LOS
                    
                }
                else {
                    alert('One or more questions were unanswered!');
                    }            
                }
        }
     });

/****************************************************************************** 
 * Handles the press of the submit button from model 2                        *
 ******************************************************************************/    
    //TODO NEED TO COLLECT THE INFO FROM QUESTION 6 "NUMBER OF UNIQUE COMPLICATIONS"
    $('.move_button #submit_2').click(function(){
        gcs2 = (document.getElementById("text_box_1").value).toString();
        text_value = (document.getElementById("text_box_2").value).toString();
        id = document.getElementById("select_patient").value;

        if(gcs2 === "") {
            gcs2 = "0";
        }
        
        if(text_value === "") {
            text_value = "0";
        }
        if (document.getElementById("select_center").value == "") {
          alert('Please select a Medical center.');  
        }  
        
        else if(document.getElementById("select_physician").value == "") {
          alert('Please select a Physician.');  
        }
        
        else if (document.getElementById("select_patient").value.toString() == "") {
          alert('Please select a Patient.');  
        } 
        
        else {
  
            if ((gcs2.match(/^[0-9]+(.[0-9]+)?$/g) != null) && (text_value.match(/^[0-9]+(.[0-9]+)?$/g) != null)) {
            
                values[0] = Number(gcs2);
                answers[4] = 0.093 * Number(text_value); // need to extract the text from this question
                answers[8] = id;
                
                if (gcs2 >= 11){
                    answers[0] = -0.31;
                }
                else {
                    answers[0] = 0.31;
                }
        
                if ((!answers.includes())) {
                    result = 2.27;
            
                    for (i = 0; i < 8; i++) {
                      result += answers[i];
                    }
                    result = Math.exp(result);
                    result = round(result, 0);
                    //Assign a global variable to los
                    window.los = result;
                    answers[9] = values[0];
                    answers[10] = values[1];
                    answers[11] = values[2];
                    answers[12] = values[3];
                    answers[13] = values[4];
                    answers[14] = values[5];
                    answers[15] = values[6];
                    answers[16] = Number(text_value);
                    
                    var paramJSON = JSON.stringify(answers);
                    finalize_input_2(paramJSON); //Final result with the estimated LOS
                    
                }
                else {
                    alert('One or more questions were unanswered!');
                }   
            }

        }
     });

