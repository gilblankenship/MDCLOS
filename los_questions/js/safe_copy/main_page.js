/******************************************************************************
 * navigation functions: brings users to specific pages                       *
 ******************************************************************************/
function model_1_page() { 
            window.location.href="http://connectedcaresystems.com/los/los_questions/php/model_1_questions.php"; 
}

function model_2_page() { 
            window.location.href="http://connectedcaresystems.com/los/los_questions/php/model_2_questions.php"; 
}

function register_page() { 
            window.location.href="http://connectedcaresystems.com/los/los_questions/php/register.php"; 
}

$( document ).ready(function() {
    $('.model_select').hide(); 
    $('.return').hide();

    //make the supplemental action button appear!
    document.getElementById("supp_action").style.opacity = 100;
/******************************************************************************
 * Either send the user to the register page or asks the user for a model     *
 ******************************************************************************/    
    $('.patient_type #new').click(function(){ 
        $('.return').hide();
        register_page();
    });
    
    $('.patient_type #old').click(function(){
        $('.return').show();
        $('.patient_type').hide();
        $('.model_select').show(); 
    });
    
/******************************************************************************
 * Shows the user the option of new or existing user                          *
 ******************************************************************************/    
    $('.return #return').click(function(){
        $('.return').hide();
        $('.model_select').hide();
        $('.patient_type').show();
    });

/******************************************************************************
 * Sends user to the model_1_questions page when the pre-op vars button       *
 ******************************************************************************/    
    $('.model_select #model_1').click(function(){ 
        $('.model_select').hide();
        model_1_page();
    });
    
    $('.model_select #model_2').click(function(){
        $('.model_select').hide();
        model_2_page();
    });    

});