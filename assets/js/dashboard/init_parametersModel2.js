var ctx = document.getElementById('chart_parametersModel2')

var chart_parametersModel2 = new Chart(ctx, {
    type: 'horizontalBar',
    data: {
        datasets: [{
                // admitted
                label: 'Average LOS',
                data: [],
                borderWidth:0.8,
                borderColor: 'rgba(52, 58, 64,1)',
                backgroundColor:'rgba(163, 171, 80, 0.3)',
                hoverBackgroundColor: 'rgba(52, 58, 64, 1)'
            }],
            labels: ["GCS >= 11", "GCS < 11", "ASA = 1 or 2", "ASA = 3 or 4", 
                     "Neurological Status = Complete Injury", "Neurological Status = Other",
                     "Polytrauma = Yes", "Polytrauma = No", "PRBC Transfusion = Yes",
                     "PRBC Transfusion = No", "Skin Complication = Yes", "Skin Complication = No",
                     "Discharge Facility = Rehab Center", "Discharge Facility = Other"]
    },
    options: {
        maintainAspectRatio: false,
        legend: {
            display: false},
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