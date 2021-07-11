$(document).ready(function(){  
    document.getElementById("select_patient").disabled = true;
    document.getElementById("select_physician").disabled = true;
    $('#button_select_treat_duration').hide();
    window.duration=15;
    console.log(window.duration);
});


//Medical center selection
$('#select_center').change(function() {
  window.center_id = document.getElementById("select_center").value;
  document.getElementById("select_patient").disabled = true;
  document.getElementById("select_physician").disabled = false;
  
  document.getElementById("select_patient").innerHTML = '<option value= "" disabled selected hidden>Select Patient</option>';
  
  // Hides everything
  $("[id=row_1]").hide();
 
  //document.getElementById("[id = row_1").hide();
  //document.getElementById("row_2").style.opacity = 0;
  //document.getElementById("row_4").style.opacity = 0;
  //document.getElementById("supp_action").style.opacity = 0;
  //document.getElementById("dis_btn").style.opacity = 0;
  
  
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

//Physician selector
$('#select_physician').change(function() {
    document.getElementById("select_patient").disabled = false;
    $("[id=row_1]").hide();
    
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


//Function to initialize the 'Statistical analysis of procedures'
function update_efficiency_dashboard() {
    $("[id=row_1]").hide();

    var data_analysis_methods = chart_analysis.config.data;
    $.ajax({
        type: 'GET',
        url: './assets/php/possible_procedures/update_analysis_savings.php',
        data: {},
        success: function(result) {
            var result_array = JSON.parse(result);
            data_analysis_methods.datasets[0].data = result_array;
            chart_analysis.update();
        },
        error: function(data) {
            alert('Failure on the AJAX of the insurance vs LOS!');
        }
    });
    
    
    var data_analysis_methods_days = chart_analysis_days.config.data;
    $.ajax({
        type: 'GET',
        url: './assets/php/possible_procedures/update_analysis_los_reduction.php',
        data: {},
        success: function(result) {
            var result_array = JSON.parse(result);
            data_analysis_methods_days.datasets[0].data = result_array;
            chart_analysis_days.update();
        },
        error: function(data) {
            alert('Failure on the AJAX of the insurance vs LOS!');
        }
    });
    
}

 update_efficiency_dashboard();
  

 $('#select_patient').change(function() {
     $('#button_select_treat_duration').show();
     $("[id=row_1]").show();
    
    var data_efficiency = chart_efficiency.config.data;
    $.ajax({
        type: 'POST',
        url: './assets/php/possible_procedures/efficiency_method.php',
        data: {},
        success: function(result) {
            result_array = JSON.parse(result);
            data_efficiency.datasets[0].data = result_array[0];
            data_efficiency.datasets[1].data = result_array[1];
            chart_efficiency.update();
        },
        error: function(data) {
            alert('Failure on the AJAX of update efficiency per mehod!');
        }
    });
    
    $.ajax({
            type: 'GET',
            url: './assets/php/possible_procedures/update_table_procedures.php',
            data: {'treat_duration': window.duration},
            success: function (result) {
                document.getElementById("table_procedures").innerHTML = result;
            },
            error: function (result) {
                alert('Failure on the AJAX: Update procedures table!');
            }
        }); 
        
    $.ajax({
            type: 'GET',
            url: './assets/php/possible_procedures/method_maximum_reduction.php',
            data: {'treat_duration': window.duration},
            success: function (result) {
                result_array = JSON.parse(result);
                document.getElementById("maximum_reduction_days").innerHTML = result_array[0];
                document.getElementById("maximum_reduction_cost").innerHTML = result_array[1];
            },
            error: function (result) {
                alert('Failure on the AJAX: Update procedures table!');
            }
        }); 
 });
 
 $("#select_duration").click(function() {
        //Get the inputs min and max los
        var treatment = document.getElementById("treat_duration");
        
        //Store them in global variables
        window.duration = treatment.value;
        //Print them in the console
        console.log(window.duration);
        
        $.ajax({
            type: 'GET',
            url: './assets/php/possible_procedures/update_table_procedures.php',
            data: {'treat_duration': window.duration},
            success: function (result) {
                document.getElementById("table_procedures").innerHTML = result;
            },
            error: function (result) {
                alert('Failure on the AJAX: Update procedures table!');
            }
        }); 
        
        $.ajax({
            type: 'GET',
            url: './assets/php/possible_procedures/method_maximum_reduction.php',
            data: {'treat_duration': window.duration},
            success: function (result) {
                result_array = JSON.parse(result);
                document.getElementById("maximum_reduction_days").innerHTML = result_array[0];
                document.getElementById("maximum_reduction_cost").innerHTML = result_array[1];
            },
            error: function (result) {
                alert('Failure on the AJAX: Update procedures table!');
            }
        }); 
    });
