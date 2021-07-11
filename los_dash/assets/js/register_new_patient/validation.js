/* WARNING MESSAGES: This code displays warning if the data entered does not satisfy the requirements (e.g. Age higher than 100, CCI higher than 37 ...).
The warning will be displayed when clicking out of the box. */

$(function(){
    
    //Check if bmi satifies the required conditions
    function check_bmi(){
        //Get entered bmi value
        var value_bmi = $("#bmi").val();
        
        //Hide bmi error message before checking the conditions.
        $("#bmi_error").hide();
        
        
        /*if (value_bmi.length === 0){
            $("#bmi_error").html("Please introduce a valid BMI");
            console.log("No text in bmi");
        }*/
        
        if (value_bmi<15){
            //console.log("Lower bmi than 15");
            $("#bmi_error").html("BMI should be higher than 15");
            $("#bmi_error").show();
        }
        
        if (value_bmi>99){
            $("#bmi_error").html("BMI should be lower than 100");
            $("#bmi_error").show();
        }
    }
    
    //Check if age satifies the required conditions
    function check_age(){
        //Get entered age value 
        var value_age = $("#age").val();
        
        //console.log(value_age);
        
        //Hide age error before checking the conditions.
        $("#age_error").hide();
        
        /*if (!$("#age").val()){
            $("#age_error").html("Please introduce a valid age");
        }*/
        if(value_age % 1 !== 0 ){
            $("#age_error").html("Age should be an integer");
            $("#age_error").show();
        }
        
        if(value_age>99){
            //console.log("Higher than 99 years");
            $("#age_error").html("Age should be lower than 99 years.");
            $("#age_error").show();
        }
        
    }
    
    //Check if cci satifies the required conditions
    function check_cci(){
        //Get entered cci value
        var value_cci = $("#cci").val();
        
        //console.log(value_cci);
        
        //Hide cci error message before checking the conditions.
        $("#cci_error").hide();
        
        if(value_cci % 1 !== 0 ){
            $("#cci_error").html("CCI should be an integer");
            $("#cci_error").show();
        }
        
        if(value_cci>37){
            $("#cci_error").html("CCI should be lower than 37.");
            $("#cci_error").show();
        }
        
    }
    
    function check_blood_loss(){
        //Get entered blood_loss value
        var value_blood_loss = $("#blood_loss").val();
        
        //Hide blood_loss error message before checking the conditions.
        $("#blood_loss_error").hide();
        
        if(value_blood_loss % 1 !== 0 ){
            $("#blood_loss_error").html("Blood loss should be an integer");
            $("#blood_loss_error").show();
        }
        
        if(value_blood_loss>9999){
            $("#blood_loss_error").html("Blood loss can't be higher than 9999mL.");
            $("#blood_loss_error").show();
        }
    }
    
    function check_surgery_length(){
        //Get entered blood_loss value
        var value_surgery_length = $("#surgery_length").val();
        
        //console.log(value_surgery_length);
        
        //Hide blood_loss error before checking the conditions.
        $("#surgery_length_error").hide();
        
        if(value_surgery_length % 1 !== 0 ){
            $("#surgery_length_error").html("Surgical length should be an integer");
            $("#surgery_length_error").show();
        }
        
        if(value_surgery_length<30){
            $("#surgery_length_error").html("Surgical length must be at least 30 minutes.");
            $("#surgery_length_error").show();
        }
        
        if(value_surgery_length>1200){
            $("#surgery_length_error").html("Surgical length must be less than 20 hours.");
            $("#surgery_length_error").show();
        }
    }
    
    function erase_fields(){
        $("#surgery_length_error").hide();
        $("#blood_loss_error").hide();
        $("#cci_error").hide();
        $("#age_error").hide();
        $("#bmi_error").hide();
        //console.log("Hide all");
    }
    
    /*Check functions after entering the data*/
    //After typing the values and clicking out of the box it calls the function check_...();
    
    $(".form-group #bmi").focusout(function() {
        check_bmi();
    });
    
    $(".form-group #age").focusout(function() {
        check_age();
    });
    
    $(".form-group #cci").focusout(function() {
        check_cci();
    });
    
    $(".form-group #blood_loss").focusout(function() {
        check_blood_loss();
    });
    
    $(".form-group #surgery_length").focusout(function() {
        check_surgery_length();
    });
    
    
});