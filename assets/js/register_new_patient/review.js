//NOT IN USE: Gave me an error. Check the file subit.js first
//Get value from the form and store it in a variable

$("#select_center").change(function(){
    window.medicalCenter = document.getElementById("select_center").value;
    console.log(window.medicalCenter);
});

$("#select_physician").change(function(){
    window.physician = document.getElementById("select_physician").value;
    console.log(window.physician);
});

$("#age").change(function(){
    window.age = document.getElementById("age").value;
    console.log(window.age);
});

$("#gender").change(function(){
    window.gender = document.getElementById("gender").value;
    console.log(window.gender);
});

$("#bmi").change(function(){
    window.bmi = document.getElementById("bmi").value;
    console.log(window.bmi);
});

$("#cci").change(function(){
    window.cci = document.getElementById("cci").value;
    console.log(window.cci);
});

$("#admin_date").change(function(){
    window.admin_date = document.getElementById("admin_date").value;
    console.log(window.admin_date);
});

$("#admin_time").change(function(){
    window.admin_time = document.getElementById("admin_time").value;
    console.log(window.admin_time);
});

$("#surgery_date").change(function(){
    window.surgery_date = document.getElementById("surgery_date").value;
    console.log(window.surgery_date);
});

$("#surgery_time").change(function(){
    window.surgery_time = document.getElementById("surgery_time").value;
    console.log(window.surgery_time);
});

$("#transfer").change(function(){
    window.transfer = document.getElementById("transfer").value;
    console.log(window.transfer);
});

$("#insurance").change(function(){
    window.insurance = document.getElementById("insurance").value;
    console.log(window.insurance);
});

$("#moi").change(function(){
    window.moi = document.getElementById("moi").value;
    console.log(window.moi);
});

$("#fract_level").change(function(){
    window.fract_level = document.getElementById("fract_level").value;
    console.log(window.fract_level);
});

$("#fract_morph").change(function(){
    window.fract_morph = document.getElementById("fract_morph").value;
    console.log(window.fract_morph);
});

$("#levels_fused").change(function(){
    window.levels_fused = document.getElementById("levels_fused").value;
    console.log(window.levels_fused);
});

$("#blood_loss").change(function(){
    window.blood_loss = document.getElementById("blood_loss").value;
    console.log(window.blood_loss);
});

$("#surgery_length").change(function(){
    window.surgery_length = document.getElementById("surgery_length").value;
    console.log(window.surgery_length);
});

$("#surg_technique").change(function(){
    window.surg_technique = document.getElementById("surg_technique").value;
    console.log(window.surg_technique);
});

$("#surg_approach").change(function(){
    window.surg_approach = document.getElementById("surg_approach").value;
    console.log(window.surg_approach);
});

$("#disch_location").change(function(){
    window.disch_location = document.getElementById("disch_location").value;
    console.log(window.disch_location);
});

$("#surg_technique").change(function(){
    window.surg_technique = document.getElementById("surg_technique").value;
    console.log(window.surg_technique);
});

$("#readmission").change(function(){
    window.readmission = document.getElementById("readmission").value;
    console.log(window.readmission);
});

$("#reoperation").change(function(){
    window.reoperation = document.getElementById("reoperation").value;
    console.log(window.reoperation);
});

$("#review").click(function() {
    console.log("filled");
    //AJAX CALL: Send all the entered values to php file in order to extract them in html
    $.ajax({
            type: 'GET',
            url: './assets/php/register_new_patient/summary.php',
            data: {'medical_center': window.medicalCenter, 'physician':window.physician, 'age':window.age, 'gender':window.gender, 'bmi':window.bmi, 'cci':window.cci,  'admin_date':window.admin_date},
            success: function (result) {
                alert('Works');
            },
            error: function (result) {
                alert('Failure on the AJAX: Update physcian list!');
            }
    });
});
