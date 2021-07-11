/*$("#button_modal").click(function(){
    console.log("Button clicked");
    $("#exampleModalCenter").modal();
});*/
  
function call_modal(){
     
    /*Structure:
    1. Store in the variable the id value
    2. Print the text value associated with the index in the html of the modal */
    
    window.med_center_drop = document.getElementById("select_center");
    document.getElementById("modal_med_center").innerHTML = window.med_center_drop.options[window.med_center_drop.selectedIndex].text;
    
    window.phys_drop = document.getElementById("select_physician");
    document.getElementById("modal_adm_phys").innerHTML = window.phys_drop.options[window.phys_drop.selectedIndex].text;
    
    window.age = document.getElementById("age");
    document.getElementById("modal_age").innerHTML = window.age.value;
    
    window.gender = document.getElementById("gender");
    document.getElementById("modal_gender").innerHTML = window.gender.value;
    
    window.bmi = document.getElementById("bmi");
    document.getElementById("modal_bmi").innerHTML = window.bmi.value;
    
    window.cci = document.getElementById("cci");
    document.getElementById("modal_cci").innerHTML = window.cci.value;
    
    window.admin_date = document.getElementById("admin_date");
    document.getElementById("modal_admin_date").innerHTML = window.admin_date.value;
    
    window.admin_time = document.getElementById("admin_time");
    document.getElementById("modal_admin_time").innerHTML = window.admin_time.value;

    window.surg_time = document.getElementById("surgery_time");
    document.getElementById("modal_surg_time").innerHTML = window.surg_time.value;
    
    window.surg_date = document.getElementById("surgery_date");
    document.getElementById("modal_surg_date").innerHTML = window.surg_date.value;
    
    window.trans = document.getElementById("transfer");
    document.getElementById("modal_trans").innerHTML = window.trans.options[window.trans.selectedIndex].text;
    
    window.insur = document.getElementById("insurance");
    document.getElementById("modal_insur").innerHTML = window.insur.options[window.insur.selectedIndex].text;
    
    window.moi = document.getElementById("moi");
    document.getElementById("modal_moi").innerHTML = window.moi.options[window.moi.selectedIndex].text;
    
    window.frac_lvl = document.getElementById("fract_level");
    document.getElementById("modal_frac_lvl").innerHTML = window.frac_lvl.options[window.frac_lvl.selectedIndex].text;

    window.frac_morph = document.getElementById("fract_morph");
    document.getElementById("modal_frac_morph").innerHTML = window.frac_morph.options[window.frac_morph.selectedIndex].text;

    window.levels_fused = document.getElementById("levels_fused");
    document.getElementById("modal_lvl_fused").innerHTML = window.levels_fused.options[window.levels_fused.selectedIndex].text;
    
    window.blood_loss = document.getElementById("blood_loss");
    document.getElementById("modal_blood_loss").innerHTML = window.blood_loss.value;
    
    window.surg_leng = document.getElementById("surgery_length");
    document.getElementById("modal_surg_len").innerHTML = window.surg_leng.value;

    window.surg_tech = document.getElementById("surg_technique");
    document.getElementById("modal_surg_tech").innerHTML = window.surg_tech.options[window.surg_tech.selectedIndex].text;
    
    window.surg_appr = document.getElementById("surg_approach");
    document.getElementById("modal_surg_app").innerHTML = window.surg_appr.options[window.surg_appr.selectedIndex].text;
    
    /*window.disch_loc = document.getElementById("disch_location");
    document.getElementById("modal_dis_loc").innerHTML = window.disch_loc.options[window.disch_loc.selectedIndex].text;*/
    
    window.readmin = document.getElementById("readmission");
    document.getElementById("modal_readmission").innerHTML = window.readmin.options[window.readmin.selectedIndex].text;
    
    window.reoper = document.getElementById("reoperation");
    document.getElementById("modal_reoperation").innerHTML = window.reoper.options[window.reoper.selectedIndex].text;
    
    
    //Check Validity of the form before opening the modal
    if((window.med_center_drop).checkValidity()&&(window.phys_drop).checkValidity()&&(window.age).checkValidity()&&(window.gender).checkValidity()&&(window.bmi).checkValidity()&&(window.cci).checkValidity()&&(window.admin_date).checkValidity()&&(window.admin_time).checkValidity()&&(window.surg_time).checkValidity()&&(window.surg_date).checkValidity()&&(window.trans).checkValidity()&&(window.insur).checkValidity()&&(window.moi).checkValidity()&&(window.frac_lvl).checkValidity()&&(window.frac_morph).checkValidity()&&(window.levels_fused).checkValidity()&&(window.blood_loss).checkValidity()&&(window.surg_leng).checkValidity()&&(window.surg_tech).checkValidity()&&(window.surg_appr).checkValidity()&&(window.readmin).checkValidity()&&(window.reoper).checkValidity()){
        $("#exampleModalCenter").modal();
    }
    
}

function send_to_php(){
    $.ajax({
             type: 'GET',
             url: './assets/php/register_new_patient/summary.php',
             data: {'medical_center': window.med_center_drop.value, 'physician': window.phys_drop.value, 'age':window.age.value, 'gender':window.gender.value, 'bmi':window.bmi.value, 'cci':window.cci.value,'admin_date':window.admin_date.value, 'admin_time':window.admin_time.value, 'surg_time':window.surg_time.value ,'surgery_date':window.surg_date.value, 'transfer':window.trans.value, 'insurance':window.insur.value, 'moi':window.moi.value, 'fracture_level':window.frac_lvl.value, 'fracture_morphology':window.frac_morph.value, 'levels_fused': window.levels_fused.value, 'blood_loss':window.blood_loss.value, 'surgery_length':window.surg_leng.value, 'surgical_technique':window.surg_tech.value, 'surgical_approach':window.surg_appr.value, 'readmission':window.readmin.value, 'reoperation':window.reoper.value},
             success: function (result) {
             },
             error: function (result) {
                 alert('Failure on the AJAX: Update physcian list!');
             }
    });
}

