function update_insights_cards() {
    // get all of the configuration objects for our charts
    var asa_pie_data = asa_pie.config.data;
    var df_pie_data = df_pie.config.data;
    var gcs_pie_data = gcs_pie.config.data;
    var ns_pie_data = ns_pie.config.data;
    var prbc_pie_data = prbc_pie.config.data;
    var pt_pie_data = pt_pie.config.data;
    var sc_pie_data = sc_pie.config.data;
    
    $.ajax({
        type: 'GET',
        url: './assets/php/insights/fetch_outlier_factors.php',
        data: {},
        success: function(result) {
            var result_array = JSON.parse(result);
            
            asa_pie_data.datasets[0].data = [result_array[0][2], result_array[0][3]];
            asa_pie_data.datasets[1].data = [result_array[1][2], result_array[1][3]];
            
            df_pie_data.datasets[0].data = [result_array[0][12], result_array[0][13], result_array[0][14]];
            df_pie_data.datasets[1].data = [result_array[1][12], result_array[1][13], result_array[1][14]];
            
            gcs_pie_data.datasets[0].data = [result_array[0][0], result_array[0][1]];
            gcs_pie_data.datasets[1].data = [result_array[1][0], result_array[1][1]];
            
            ns_pie_data.datasets[0].data = [result_array[0][4], result_array[0][5]];
            ns_pie_data.datasets[1].data = [result_array[1][4], result_array[1][5]];
            
            prbc_pie_data.datasets[0].data = [result_array[0][8], result_array[0][9]];
            prbc_pie_data.datasets[1].data = [result_array[1][8], result_array[1][9]];
            
            pt_pie_data.datasets[0].data = [result_array[0][6], result_array[0][7]];
            pt_pie_data.datasets[1].data = [result_array[1][6], result_array[1][7]];
            
            sc_pie_data.datasets[0].data = [result_array[0][10], result_array[0][11]];
            sc_pie_data.datasets[1].data = [result_array[1][10], result_array[1][11]];
            
            // update all graphs with their data
            asa_pie.update();
            df_pie.update();
            gcs_pie.update();
            ns_pie.update();
            prbc_pie.update();
            pt_pie.update();
            sc_pie.update();
        },
        error: function(data) {
            alert('Failure on the AJAX of the insurance vs LOS!');
        }
    });
}

update_insights_cards();