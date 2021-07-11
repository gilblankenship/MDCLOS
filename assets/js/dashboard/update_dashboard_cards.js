function update_dashboard_cards() {
   
    // Update mean Length-of-Stay card
    $.ajax({
        type: 'GET',
        url: './assets/php/dashboard/update_mean_los.php',
        data: {},
        success: function (result) {
            document.getElementById("averageLOS").innerHTML = result.concat(" days");
        },
        error: function (result) {
            alert('Failure on the AJAX of update avg. LOS!');
        }
    });
    
    
    // Update current admitted patients at the hospital
    $.ajax({
        type: 'GET',
        url: './assets/php/dashboard/update_current_admissions.php',
        data: {},
        success: function (result) {
            document.getElementById("admittedpatients").innerHTML = result;
        },
        error: function (result) {
            alert('Failure on the AJAX of count more 5 days!');
        }
    });
    
    
  
    // Mixing the cards "Analysed admssions" and "Admissions higher_than_LOS"
    if(window.selectedMinLOS==1){ //If the selected min LOS is '1', show the Analysed admission card
            $('#admissions_higher_than_1_day').hide(); //Hide card "Admissions higher than __ los"
            $('#admissions_analysed').show(); //Show card "Analysed admissions"
    }else{ //If the selected min LOS is >1, show admissions higher than LOS
        $('#admissions_analysed').hide(); //Show card "Analysed admissions"
        $('#admissions_higher_than_1_day').show(); //Show card "Admissions higher than __ los"
    }
    
    //Update card Analysed Data count
    $.ajax({
                type: 'GET',
                url: './assets/php/dashboard/update_admissions_analyzed.php',
                data: {},
                success: function (result) {
                    document.getElementById("count_data").innerHTML = result;
                },
                error: function (result) {
                    alert('Failure on the AJAX of analysed data!');
                }
            });
            
    //Update card studied cases with LOS higher than ___ LOS
        $.ajax({
            type: 'GET',
            url: './assets/php/dashboard/update_admissions_los_over.php',
            data: {'los': window.selectedMinLOS},
            success: function (result) {
                document.getElementById("countMore5").innerHTML = result;
            },
            error: function (result) {
                alert('Failure on the AJAX of count more 5 days!');
            }
        });
        
    // Update card "Count of current readmissions" [NOT BEING USED RN]
    /*$.ajax({
        type: 'GET',
        url: 'assets/./assets/php/dashboard/update_readmissions.php',
        data: {},
        success: function (result) {
            document.getElementById("unschedulledreadmissions").innerHTML = result;
        },
        error: function (result) {
            alert('Failure on the AJAX of count more 5 days!');
        }
    });*/
    
    //Update card "Parameters contributing to the longest LOS in Model 1"
    $.ajax({
        type: 'GET',
        url: './assets/php/dashboard/update_logest_los_1.php',
        data: {'los': window.selectedMinLOS},
        success: function (result) {
            document.getElementById("longest_los_1").innerHTML = result;
        },
        error: function (result) {
            alert('Failure on the AJAX of "Parameters contributing to the longest LOS in Model 1"!');
        }
    });
    
    //Update card "Parameters contributing to the longest LOS in Model 2"
    $.ajax({
        type: 'GET',
        url: './assets/php/dashboard/update_logest_los_2.php',
        data: {'los': window.selectedMinLOS},
        success: function (result) {
            document.getElementById("longest_los_2").innerHTML = result;
        },
        error: function (result) {
            alert('Failure on the AJAX of "Parameters contributing to the longest LOS in Model 2"!');
        }
    });
    
    
    // update the 'Distribution of LOS for Hospital Admissions' chart card
    var data_patientsVSlos = chart_patientsVSlos.config.data;
    $.ajax({
        type: 'GET',
        url: './assets/php/dashboard/update_distribution_among_admissions.php',
        data: {},
        success: function(result) {
            let result_array = JSON.parse(result);
            
            data_patientsVSlos.datasets[0].data = result_array[1];
            data_patientsVSlos.labels = result_array[0];
            
            chart_patientsVSlos.update();
        },
        error: function(data) {
            alert('Failure on the AJAX of the doughnut chart for reject reasons!');
        }
    });
    
    //update PARAMETERS MODEL 1 vs LOS  
    var data_parametersVSlos_1 = chart_parametersModel1.config.data;
    $.ajax({
        type: 'GET',
        url: './assets/php/dashboard/update_parameters_effect_1.php',
        data: {'los': window.selectedMinLOS},
        success: function(result) {
            var result_array = JSON.parse(result);
            
            // standardize the values for each variable, to make sorting simpler
            let gcs_max_val = result_array[0][0] > result_array[1][0] ? result_array[0][0] : result_array[1][0];
            let gcs_max_label = result_array[0][0] > result_array[1][0] ? "GCS >= 11" : "GCS < 11";
            let gcs_min_val = result_array[0][0] <= result_array[1][0] ? result_array[0][0] : result_array[1][0];
            let gcs_min_label = result_array[0][0] <= result_array[1][0] ? "GCS >= 11" : "GCS < 11";
            
            let asa_max_val = result_array[0][1] > result_array[1][1] ? result_array[0][1] : result_array[1][1];
            let asa_max_label = result_array[0][1] > result_array[1][1] ? "ASA = 1 or 2" : "ASA = 3 or 4";
            let asa_min_val = result_array[0][1] <= result_array[1][1] ? result_array[0][1] : result_array[1][1];
            let asa_min_label = result_array[0][1] <= result_array[1][1] ? "ASA = 1 or 2" : "ASA = 3 or 4";
            
            let ns_max_val = result_array[0][2] > result_array[1][2] ? result_array[0][2] : result_array[1][2];
            let ns_max_label = result_array[0][2] > result_array[1][2] ? "Neurological Status = Complete Injury" : "Neurological Status = Other";
            let ns_min_val = result_array[0][2] <= result_array[1][2] ? result_array[0][2] : result_array[1][2];
            let ns_min_label = result_array[0][2] <= result_array[1][2] ? "Neurological Status = Complete Injury" : "Neurological Status = Other";
            
            let pt_max_val = result_array[0][3] > result_array[1][3] ? result_array[0][3] : result_array[1][3];
            let pt_max_label = result_array[0][3] > result_array[1][3] ? "Polytrauma = Yes" : "Polytrauma = No";
            let pt_min_val = result_array[0][3] <= result_array[1][3] ? result_array[0][3] : result_array[1][3];
            let pt_min_label = result_array[0][3] <= result_array[1][3] ? "Polytrauma = Yes" : "Polytrauma = No";
            
            // place the previous values into an array, then sort by the maximum values for each
            let to_be_sorted = [[gcs_max_val, gcs_max_label, gcs_min_val, gcs_min_label],
                                [asa_max_val, asa_max_label, asa_min_val, asa_min_label],
                                [ns_max_val, ns_max_label, ns_min_val, ns_min_label],
                                [pt_max_val, pt_max_label, pt_min_val, pt_min_label]];

            let result_data = [];
            let result_labels = [];

            // sort this mapped array to get items in descending LOS order
            to_be_sorted.sort( function(a, b) {
                return b[0] - a[0];
            });
            
            // place each item from the sorted list into the result arrays
            to_be_sorted.forEach(function(item, index) {
                result_data.push(item[0]);
                result_data.push(item[2]);
                
                result_labels.push(item[1]);
                result_labels.push(item[3]);
            });
            
            // update the data!
            data_parametersVSlos_1.datasets[0].data = result_data;
            data_parametersVSlos_1.labels = result_labels;
            
            chart_parametersModel1.update();
            
        },
        error: function(data) {
            alert('Failure on the AJAX of the doughnut chart for reject reasons!');
        }
    });
    
    //update PARAMETERS MODEL 2 vs LOS  
    var data_parametersVSlos_2 = chart_parametersModel2.config.data;
    $.ajax({
        type: 'GET',
        url: './assets/php/dashboard/update_parameters_effect_2.php',
        data: {'los': window.selectedMinLOS},
        success: function(result) {
            var result_array = JSON.parse(result);
            
            // standardize the values for each variable, to make sorting simpler
            let gcs_max_val = result_array[0][0] > result_array[1][0] ? result_array[0][0] : result_array[1][0];
            let gcs_max_label = result_array[0][0] > result_array[1][0] ? "GCS >= 11" : "GCS < 11";
            let gcs_min_val = result_array[0][0] <= result_array[1][0] ? result_array[0][0] : result_array[1][0];
            let gcs_min_label = result_array[0][0] <= result_array[1][0] ? "GCS >= 11" : "GCS < 11";
            
            let asa_max_val = result_array[0][1] > result_array[1][1] ? result_array[0][1] : result_array[1][1];
            let asa_max_label = result_array[0][1] > result_array[1][1] ? "ASA = 1 or 2" : "ASA = 3 or 4";
            let asa_min_val = result_array[0][1] <= result_array[1][1] ? result_array[0][1] : result_array[1][1];
            let asa_min_label = result_array[0][1] <= result_array[1][1] ? "ASA = 1 or 2" : "ASA = 3 or 4";
            
            let ns_max_val = result_array[0][2] > result_array[1][2] ? result_array[0][2] : result_array[1][2];
            let ns_max_label = result_array[0][2] > result_array[1][2] ? "Neurological Status = Complete Injury" : "Neurological Status = Other";
            let ns_min_val = result_array[0][2] <= result_array[1][2] ? result_array[0][2] : result_array[1][2];
            let ns_min_label = result_array[0][2] <= result_array[1][2] ? "Neurological Status = Complete Injury" : "Neurological Status = Other";
            
            let pt_max_val = result_array[0][3] > result_array[1][3] ? result_array[0][3] : result_array[1][3];
            let pt_max_label = result_array[0][3] > result_array[1][3] ? "Polytrauma = Yes" : "Polytrauma = No";
            let pt_min_val = result_array[0][3] <= result_array[1][3] ? result_array[0][3] : result_array[1][3];
            let pt_min_label = result_array[0][3] <= result_array[1][3] ? "Polytrauma = Yes" : "Polytrauma = No";
            
            let prbc_max_val = result_array[0][4] > result_array[1][4] ? result_array[0][4] : result_array[1][4];
            let prbc_max_label = result_array[0][4] > result_array[1][4] ? "PRBC Transfusion = Yes" : "PRBC Transfusion = No";
            let prbc_min_val = result_array[0][4] <= result_array[1][4] ? result_array[0][4] : result_array[1][4];
            let prbc_min_label = result_array[0][4] <= result_array[1][4] ? "PRBC Transfusion = Yes" : "PRBC Transfusion = No";
            
            let sc_max_val = result_array[0][5] > result_array[1][5] ? result_array[0][5] : result_array[1][5];
            let sc_max_label = result_array[0][5] > result_array[1][5] ? "Skin Complication = No" : "Skin Complication = Yes";
            let sc_min_val = result_array[0][5] <= result_array[1][5] ? result_array[0][5] : result_array[1][5];
            let sc_min_label = result_array[0][5] <= result_array[1][5] ? "Skin Complication = No" : "Skin Complication = Yes";
            
            let df_max_val = result_array[0][6] > result_array[1][6] ? result_array[0][6] : result_array[1][6];
            let df_max_label = result_array[0][6] > result_array[1][6] ? "Discharge Facility = Other" : "Discharge Facility = Rehab Center";
            let df_min_val = result_array[0][6] <= result_array[1][6] ? result_array[0][6] : result_array[1][6];
            let df_min_label = result_array[0][6] <= result_array[1][6] ? "Discharge Facility = Other" : "Discharge Facility = Rehab Center";
            
            // place the previous values into an array, then sort by the maximum values for each
            let to_be_sorted = [[gcs_max_val, gcs_max_label, gcs_min_val, gcs_min_label],
                                [asa_max_val, asa_max_label, asa_min_val, asa_min_label],
                                [ns_max_val, ns_max_label, ns_min_val, ns_min_label],
                                [pt_max_val, pt_max_label, pt_min_val, pt_min_label],
                                [prbc_max_val, prbc_max_label, prbc_min_val, prbc_min_label],
                                [sc_max_val, sc_max_label, sc_min_val, sc_min_label],
                                [df_max_val, df_max_label, df_min_val, df_min_label]];
                                
            let result_data = [];
            let result_labels = [];

            to_be_sorted.sort( function(a, b) {
                return b[0] - a[0];
            });
            
            // place each item from the sorted list into the result arrays
            to_be_sorted.forEach(function(item, index) {
                result_data.push(item[0]);
                result_data.push(item[2]);
                
                result_labels.push(item[1]);
                result_labels.push(item[3]);
            });
            
            // update the data!
            data_parametersVSlos_2.datasets[0].data = result_data;
            data_parametersVSlos_2.labels = result_labels;
            
            chart_parametersModel2.update();
            
        },
        error: function(data) {
            alert('Failure on the AJAX of the doughnut chart for reject reasons!');
        }
    });
    
    //Tables explaining the Models and the diferent parameters
    /*$.ajax({
        type: 'GET',
        url: './assets/php/dashboard/update_legendTable1.php',
        data: {},
        success: function (result) {
            document.getElementById("legend_1").innerHTML = result;
        },
        error: function (result) {
            alert('Failure model 1 legend');
        }
    });   
    
    $.ajax({
        type: 'GET',
        url: './assets/php/dashboard/update_legendTable2.php',
        data: {},
        success: function (result) {
            document.getElementById("legend_2").innerHTML = result;
        },
        error: function (result) {
            alert('Failure model 2 legend');
        }
    });*/
}

$("#singles").click(function() {
    temp = 'f';
    
    // update the 'Distribution of LOS for Hospital Admissions' chart card
    var data_patientsVSlos = chart_patientsVSlos.config.data;
    $.ajax({
        type: 'GET',
        url: './assets/php/dashboard/update_distribution_among_admissions.php',
        data: {'grouped': temp},
        success: function(result) {
            let result_array = JSON.parse(result);
            
            data_patientsVSlos.datasets[0].data = result_array[1];
            data_patientsVSlos.labels = result_array[0];
            
            chart_patientsVSlos.update();
        },
        error: function(data) {
            alert('Failure on the AJAX of the doughnut chart for reject reasons!');
        }
    });
    
})

$("#toggle_single").click(function() {
    // first toggle the global grouped value
    temp = 'f';
    
    // update the 'Distribution of LOS for Hospital Admissions' chart card
    var data_patientsVSlos = chart_patientsVSlos.config.data;
    $.ajax({
        type: 'GET',
        url: './assets/php/dashboard/update_distribution_among_admissions.php',
        data: {'grouped': temp},
        success: function(result) {
            let result_array = JSON.parse(result);
            
            data_patientsVSlos.datasets[0].data = result_array[1];
            data_patientsVSlos.labels = result_array[0];
            
            chart_patientsVSlos.update();
        },
        error: function(data) {
            alert('Failure on the AJAX of the doughnut chart for reject reasons!');
        }
    });
})

$("#toggle_group").click(function() {
    // first toggle the global grouped value
    temp = 't';
    
    // update the 'Distribution of LOS for Hospital Admissions' chart card
    var data_patientsVSlos = chart_patientsVSlos.config.data;
    $.ajax({
        type: 'GET',
        url: './assets/php/dashboard/update_distribution_among_admissions.php',
        data: {'grouped': temp},
        success: function(result) {
            let result_array = JSON.parse(result);
            
            data_patientsVSlos.datasets[0].data = result_array[1];
            data_patientsVSlos.labels = result_array[0];
            
            chart_patientsVSlos.update();
        },
        error: function(data) {
            alert('Failure on the AJAX of the doughnut chart for reject reasons!');
        }
    });
})

const $valueSpan = $('.valueSpan');
const $value = $('#los_range');
$valueSpan.html($value.val());

$('#los_range').mouseup(function() {
    // update this when ready to consolidate cards
    // if ($('#los_range').val() == 1) {
    //     $('#adm_analyzed').html('Admissions Analyzed');
    // } else {
    //     $('#adm_analyzed').html('Patients With LOS > days');
    // }
    
    $valueSpan.html($('#los_range').val());
    window.selectedMinLOS = $('#los_range').val();
    update_dashboard_cards();
});

update_dashboard_cards();
