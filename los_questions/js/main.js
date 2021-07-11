/******************************************************************************
 * navigation functions: brings users to specific pages                       *
 ******************************************************************************/
$(document).ready(function () {
  //your code here

    function model_1_page() { 
                window.location.href="https://connectedcaresystems.com/los/los_questions/php/model_1_questions.php"; 
    }
    
    function model_2_page() { 
                window.location.href="https://connectedcaresystems.com/los/los_questions/php/model_2_questions.php"; 
    }
    
    /******************************************************************************
     * Sends user to the model_1_questions page when the pre-op vars button       *
     ******************************************************************************/    
        $('.model_select #model_1').click(function(){ 
            $('.model_select').hide();
            model_1_page();
        });
    
    /*Sends user to the model_2_questions when the all vars button*/    
        $('.model_select #model_2').click(function(){
            $('.model_select').hide();
            model_2_page();
        });    
});