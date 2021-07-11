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
  
    // Hides everything
    document.getElementById("row_1").style.opacity = 0;
    document.getElementById("row_3").style.opacity = 0;
    document.getElementById("row_4").style.opacity = 0;
    document.getElementById("supp_action").style.opacity = 0;
    document.getElementById("dis_btn").style.opacity = 0;
  
  
    // Used to populate patient info card ------------------------------
    $.ajax({
        type: 'GET',
        url: './assets/php/patient_overview/update_physician_list.php',
        data: {'center_id' : document.getElementById("select_center").value},
        success: function (result) {
            document.getElementById("select_physician").innerHTML = result;
        },
        error: function (result) {
            alert('Failure on the AJAX: Update physcian list!');
        }
    });      
});

$('#select_physician').change(function() {

  // Hides everything
  document.getElementById("row_1").style.opacity = 0;
  document.getElementById("row_3").style.opacity = 0;
  document.getElementById("row_4").style.opacity = 0;
  document.getElementById("supp_action").style.opacity = 0;
  document.getElementById("dis_btn").style.opacity = 0;    
    
    document.getElementById("select_patient").disabled = false;
    $.ajax({
        type: 'GET',
        url: './assets/php/patient_overview/update_patient_list.php',
        data: {'physician_id' : document.getElementById("select_physician").value, 'center_id' : document.getElementById("select_center").value},
        success: function (result) {
            document.getElementById("select_patient").innerHTML = result;
        },
        error: function (result) {
            alert('Failure on the AJAX: Update patient list!');
        }
    });        
});



$('#select_patient').change(function() {
    let id = $(this).val();
    
    // make all of the rows appear!
    document.getElementById("row_1").style.opacity = 100;
    document.getElementById("row_3").style.opacity = 100;
    document.getElementById("row_4").style.opacity = 100;
    
    // make the supplemental action button appear!
    document.getElementById("supp_action").style.opacity = 100;
    
    
    // populate the patient id field in both forms
    document.getElementById("patient_id").value = document.getElementById("select_patient").value;
    document.getElementById("patient_id_2").value = document.getElementById("select_patient").value;


    // Used to populate patient info card ------------------------------
    $.ajax({
        type: 'GET',
        url: './assets/php/patient_overview/update_patient_info.php',
        data: {'id': id},
        success: function (result) {
            document.getElementById("patient_info").innerHTML = result;
        },
        error: function (result) {
            alert('Failure on the AJAX: Patient Information Card!');
        }
    });
    
    // Used to populate Initial pre op card-----------------------------
    $.ajax({
        type: 'GET',
        url: './assets/php/patient_overview/update_pre_op.php',
        data: {'id': id},
        success: function (result) {
            document.getElementById("pre_op").innerHTML = result;
        },
        error: function (result) {
            alert('Failure on the AJAX: Pre op Information Card!');
        }
    });
    
    // Used to populate initial post op card--------------------------
    $.ajax({
        type: 'GET',
        url: './assets/php/patient_overview/update_post_op.php',
        data: {'id': id},
        success: function (result) {
            document.getElementById("post_op").innerHTML = result;
        },
        error: function (result) {
            alert('Failure on the AJAX: Post op Information Card!');
        }
    });

    // Used to populate the patient history card ----[------------------
    $.ajax({
        url:"./assets/php/patient_overview/update_patient_history.php",
        method:"POST",
        data:{'id': id}, 
        cache:false, 
        success:function(data) {
            document.getElementById("patient_history").innerHTML = data;
        }
    });
        
    // Used to update the discharge button -----------------------------
    $.ajax({
        url:"./assets/php/patient_overview/update_discharge_btn.php",
        method:'GET',
        data:{'id': id}, 
        cache:false, 
        success:function(data) {
            // This will set up the discharge button.
            if (data === '0') {
                 document.getElementById("dis_btn").style.opacity = 100;
            } else {
             document.getElementById("dis_btn").style.opacity = 0;
            }
        }
    }); 
    

    // grab the data var for the chart
    var data_patient_overview = chart_patient_overview.config.data;
    var annotate_overview = chart_patient_overview.config.options.annotation;
   
    $.ajax({
        type: 'GET',
        url: './assets/php/patient_overview/update_overview_chart.php',
        data: {'patient_id': id},
        success: function (result) {
            var result_array = JSON.parse(result);
            
            let chart_result = result_array[0];
            let prog_result = result_array[1];
            
            data_patient_overview.datasets[0].data = chart_result[0];
            data_patient_overview.datasets[1].data = chart_result[1];

            
            document.getElementById("prog").innerHTML = prog_result[0];
            
            
            
            // used to index annotations as they are inserted
            let ann_idx = 0;
            
            // iterate through the patient's progression and build annotations
            prog_result[1].forEach(function(prog) {
                // used as a template for later annotations to be added
                let ex_annotation = {
                    type: "line",
                    mode: "vertical",
                    scaleID: "x-axis-0",
                    value: "",
                    borderColor: "rgba(142, 156, 64, 1)",
                    label: {
                        content: "",
                        enabled: true,
                        position: "top"
                    }
                };

                // this block of if statements controls what tag will be applied
                // to the annotation
                if (prog[0] === 'physical_therapy') {
                    ex_annotation.value = prog[1];
                    ex_annotation.label.content = 'PT';
                } else if (prog[0] === 'occ_therapy') {
                    ex_annotation.value = prog[1];
                    ex_annotation.label.content = 'OT';
                } else if (prog[0] === 'sw_visit') {
                    ex_annotation.value = prog[1];
                    ex_annotation.label.content = 'SW';
                } else if (prog[0] === 'stable_dis') {
                    ex_annotation.value = prog[1];
                    ex_annotation.label.content = 'STABLE';
                } else if (prog[0] === 'discharged') {
                    ex_annotation.value = prog[1];
                    ex_annotation.label.content = 'DIS';
                }
                annotate_overview.annotations[ann_idx] = ex_annotation;
                
                ann_idx++;
            });

            chart_patient_overview.update();
        },
        error: function (result) {
            alert('Overview chart update failed.');
        }
    });
});

// if the discharge radio buttons are pressed, disable / enable the location field
$('input:radio[name="dis_type"]').change(
    function() {
        if (this.checked && this.value == 'stable') {
            document.getElementById('dis_loc').value = 'N / A';
            document.getElementById('dis_loc').disabled = true;
        } else {
            document.getElementById('dis_loc').disabled = false;
        }
});

// based on the supplemental action, enable hours and estimate
$('#action_taken').change(
    function() {
        if (this.value == 'physical_therapy' || this.value == 'occ_therapy') {
            // let us see the minutes and estimate fields for these choices!
            document.getElementById('min').disabled = false;
            document.getElementById('new_est').disabled = false;
        } else {
            // social work occurs in units, we don't need minutes / the estimate!
            document.getElementById('min').disabled = true;
            document.getElementById('min').value = '';
            
            document.getElementById('new_est').disabled = true;
            document.getElementById('new_est').value = '';
        }
});

// update the patient's estimate based on the # hours of support they receive
$('input:text[name="min"]').change( function() {
    // retrieve some values for the AJAX call
    let patient_id = document.getElementById('patient_id').value;
    let action_date = document.getElementById('action_date').value;
    let min = document.getElementById('min').value;
    let supp_action = document.getElementById('action_taken').value;
     
    // calculate a new estimate LOS based upon the patient's time spent in PT / OT
    $.ajax({
        url:"./assets/php/patient_overview/fetch_new_estimate.php",
        method:'GET',
        data:{'patient_id': patient_id,
              'action_date': action_date,
              'min': min,
              'supp_action': supp_action
        }, 
        cache:false, 
        success:function(result) {
            document.getElementById('new_est').value = result;
        }
    });
    
    // if the action was not administered, auto-fill the comment
    if (min === "0") {
        document.getElementById('comment').value = 'Session scheduled but not administered due to: ';
    }
});