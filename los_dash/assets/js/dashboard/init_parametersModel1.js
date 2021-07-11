var ctx = document.getElementById('chart_parametersModel1')

var chart_parametersModel1 = new Chart(ctx, {
    type: 'horizontalBar',
    data: {
        datasets: [{
                // admitted 0
                label: 'Average LOS',
                data: [],
                borderWidth:0.8,
                borderColor: 'rgba(52, 58, 64,1)',
                backgroundColor:'rgba(163, 171, 80, 0.3)',
                hoverBackgroundColor: 'rgba(52, 58, 64, 1)'
            }],
            labels: ["GCS >= 11", "GCS < 11", "ASA = 1 or 2", "ASA = 3 or 4", 
                     "Neurological Status = Complete Injury", "Neurological Status = Other",
                     "Polytrauma = Yes", "Polytrauma = No"]
    },
    options: {
        maintainAspectRatio: false,
        legend: {
            display: false},
        plugins: {
            datalabels: {
                display: function(context) {
                    return context.dataset.data[context.dataIndex] > 1;
                }
            }
        },
        scales: {
            xAxes: [{
                scaleLabel: {
                    display: true,
                    labelString: 'Length of Stay (Days)',
                    fontSize: 15
                 }
            }],
            // yAxes: [{
            //     scaleLabel: {
            //         display: true,
            //         labelString: 'Parameters',
            //         fontSize: 15
            //      }
            // }]
        },

    }
})