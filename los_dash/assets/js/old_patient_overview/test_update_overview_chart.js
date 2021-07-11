function update_cards() {
    
    var patient_id = document.getElementById("select_patient").value.toString();
    
    console.log(patient_id);
    
    // grab the data var for the chart
    var data_patient_overview = chart_patient_overview.config.data;
   
    // This is just a test, so we pass a predefined patient id
    $.ajax({
        type: 'GET',
        url: './assets/php/old_patient_overview/update_overview_chart.php',
        data: {'patient_id': patient_id},
        success: function (result) {
            var result_array = JSON.parse(result);
            
            data_patient_overview.datasets[0].data = result_array[0];
            data_patient_overview.datasets[1].data = result_array[1];
            
            chart_patient_overview.update();
        },
        error: function (result) {
            alert('Failure on the AJAX of update avg. LOS!');
        }
    });
    
    // This is just a test, so we pass a predefined patient id
    $.ajax({
        type: 'GET',
        url: './assets/php/old_patient_overview/update_overview_prog.php',
        data: {'patient_id': patient_id},
        success: function (result) {
            document.getElementById("prog").innerHTML = result;

        },
        error: function (result) {
            alert('Failure on the AJAX of update avg. LOS!');
        }
    });
    
}

update_cards();