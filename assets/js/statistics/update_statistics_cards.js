function update_statistics_cards() {
    
    //pulls from real_data
    var datainsuranceVSlos = chart_insuranceVSlos.config.data;
    $.ajax({
        type: 'GET',
        url: './assets/php/statistics/update_insurance.php',
        data: {'los': window.selectedMinLOS},
        success: function(result) {
            var result_array = JSON.parse(result);
            datainsuranceVSlos.datasets[0].data = result_array[0];
            datainsuranceVSlos.datasets[1].data = result_array[1];
            datainsuranceVSlos.labels = [result_array[2],result_array[3],result_array[4],result_array[5],result_array[6]];
            chart_insuranceVSlos.update();
        },
        error: function(data) {
            alert('Failure on the AJAX of the insurance vs LOS!');
        }
    });
        
    //pulls from real_data           
    var dataMOIVSlos = chart_MOIVSlos.config.data;
    $.ajax({
        type: 'GET',
        url: './assets/php/statistics/update_moi.php',
        data: {'los': window.selectedMinLOS},
        success: function(result) {
            var result_array = JSON.parse(result);
            dataMOIVSlos.datasets[0].data = result_array[0];
            dataMOIVSlos.labels = [result_array[1],result_array[2],result_array[3],result_array[4],result_array[5],result_array[6],result_array[7]];
            chart_MOIVSlos.update();
        },
        error: function(data) {
            alert('Failure on the AJAX of the MOI vs LOS!');
        }
    });
                
    //pulls from real_data_table
    var dataapproachVSlos = chart_approachVSlos.config.data;
    $.ajax({
        type: 'GET',
        url: './assets/php/statistics/update_surgery_approach.php',
        data: {'los': window.selectedMinLOS},
        success: function(result) {
            var result_array = JSON.parse(result);
            dataapproachVSlos.datasets[0].data = result_array[0];
            dataapproachVSlos.labels = [result_array[1],result_array[2],result_array[3]];
            chart_approachVSlos.update();
        },
        error: function(data) {
            alert('Failure on the AJAX of the approach vs LOS!');
        }
    });
    
    var data_dischargef = chart_discharge.config.data;
    $.ajax({
        type: 'GET',
        url: './assets/php/statistics/update_discharge_location.php',
        data: {'los': window.selectedMinLOS},
        success: function(result) {
            var result_array = JSON.parse(result);
            data_dischargef.datasets[0].data = result_array[0];
            data_dischargef.labels = [result_array[1],result_array[2],result_array[3]];
            chart_discharge.update();
    
        },
        error: function(data) {
            alert('Failure on the AJAX of the approach vs LOS!');
        }
    });
                
    var data_techniqueVSlos = chart_technique.config.data;
        $.ajax({
            type: 'GET',
            url: './assets/php/statistics/update_technique.php',
            data: {'los': window.selectedMinLOS},
            success: function(result) {
                var result_array = JSON.parse(result);
                data_techniqueVSlos.datasets[0].data = result_array[0];
                data_techniqueVSlos.labels = [result_array[1], result_array[2]];
                chart_technique.update();
            },
            error: function(data) {
                alert('Failure on the AJAX of surgical technique vs LOS!');
            }
        });
   
    var dataAgeVSlos2 = chart_ageVSlos2.config.data;
    $.ajax({
        type: 'GET',
        url: './assets/php/statistics/update_age_statistics.php',
        data: {'los': window.selectedMinLOS},
        success: function(result) {
            var result_array = JSON.parse(result);
            dataAgeVSlos2.datasets[0].data = result_array[0]; //los
            dataAgeVSlos2.labels = [result_array[1],result_array[2],result_array[3],result_array[4],result_array[5],result_array[6]]; //los
            chart_ageVSlos2.update();
        },
        error: function(data) {
            alert('Failure on the AJAX of the age vs LOS!');
        }
    });
            
    //pulls from real_data      
    var dataFracture = chart_fracturelevel.config.data;
    $.ajax({
        type: 'GET',
        url: './assets/php/statistics/update_fracture_level.php',
        data: {'los': window.selectedMinLOS},
        success: function(result) {
            var result_array = JSON.parse(result);
            dataFracture.datasets[0].data = result_array[0];
            dataFracture.labels = [result_array[1],result_array[2],result_array[3]];
            chart_fracturelevel.update();
        },
        error: function(data) {
            alert('Failure on the AJAX of the fracture level vs LOS!');
        }
    });
    
    //pulls from real_data_table        
    var dataMorphology = chart_fracturemorphology.config.data;
    $.ajax({
        type: 'GET',
        url: './assets/php/statistics/update_morphology.php',
        data: {'los': window.selectedMinLOS},
        success: function(result) {
            var result_array = JSON.parse(result);
            dataMorphology.datasets[0].data = result_array[0];
            dataMorphology.labels = [result_array[1],result_array[2],result_array[3],result_array[4],result_array[5]];
            chart_fracturemorphology.update();
        },
        error: function(data) {
            alert('Failure on the AJAX of the fracture morphology vs LOS!');
        }
    });
    
    var dataLevelsFused = chart_fused_levels.config.data;
    $.ajax({
        type: 'GET',
        url: './assets/php/statistics/update_levels_fused.php',
        data: {'los': window.selectedMinLOS},
        success: function(result) {
            var result_array = JSON.parse(result);
            dataLevelsFused.datasets[0].data = result_array[0];
            dataLevelsFused.labels = [result_array[1],result_array[2],result_array[3],result_array[4]];
            chart_fused_levels.update();
        },
        error: function(data) {
            alert('Failure on the AJAX of fused levels vs LOS!');
        }
    });
    
    //pulls from real_data_table        
    var dataBloodLoss = chart_bloodloss.config.data;
    $.ajax({
        type: 'GET',
        url: './assets/php/statistics/update_blood_loss.php',
        data: {'los': window.selectedMinLOS},
        success: function(result) {
            var result_array = JSON.parse(result);
            dataBloodLoss.datasets[0].data = result_array[0];
            dataBloodLoss.labels = [result_array[1],result_array[2],result_array[3],result_array[4],result_array[5],result_array[6],result_array[7],result_array[8],result_array[9],result_array[10]];
            chart_bloodloss.update();
        },
        error: function(data) {
            alert('Failure on the AJAX of the blood loss vs LOS!');
        }
    });
                
    var data_length = chart_surgery_length.config.data;
    $.ajax({
        type: 'GET',
        url: './assets/php/statistics/update_surgery_length.php',
        data: {'los': window.selectedMinLOS},
        success: function(result) {
            var result_array = JSON.parse(result);
            data_length.datasets[0].data = result_array[0];
            data_length.labels = [result_array[1],result_array[2],result_array[3],result_array[4],result_array[5],result_array[6],result_array[7],result_array[8],result_array[9],result_array[10]];
            chart_surgery_length.update();
        },
        error: function(data) {
            alert('Failure on the AJAX of the surgical length vs LOS!');
        }
    });
            
    // update the 'Average Deviation' chart card
    // var data_deviation = chart_deviation.config.data;
    // $.ajax({
    //     type: 'GET',
    //     url: './assets/php/statistics/update_deviation.php',
    //     data: {'grouped': window.grouped},
    //     success: function(result) {
    //         var result_array = JSON.parse(result);
            
    //         data_deviation.datasets[0].data = result_array[0];
    //         data_deviation.labels = result_array[1];
            
    //         chart_deviation.update();
    //     },
    //     error: function(data) {
    //         alert('Failure on the AJAX of the chart for average deviation!');
    //     }
    // });
}

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
    
    update_statistics_cards();
});

update_statistics_cards();
