var ctx = document.getElementById('chart_patientsVSlos')

var chart_patientsVSlos = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: [],
        datasets: [{
                // admitted
                label: 'PATIENTS',
                data: [],
                backgroundColor: 'rgba(52, 58, 64, 0.8)',
                hoverBackgroundColor: 'rgba(52, 58, 64, 1)'
            }]
    },
    options: {
        maintainAspectRatio: false,
        legend: {
            display: false},
        scales: {
            xAxes: [{
                scaleLabel: {
                    display: true,
                    labelString: 'Length-of-Stay (days)',
                    fontSize: 15
                 }
            }],
            yAxes: [{
                scaleLabel: {
                    display: true,
                    labelString: 'Count (patients)',
                    fontSize: 15
                 }
            }]
        },

    }
})