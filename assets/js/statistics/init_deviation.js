var ctx = document.getElementById('chart_deviation')

var chart_deviation = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: [],
        datasets: [{
                // admitted
                label: 'DEVIATION ',
                data: [],
                backgroundColor:'rgba(213,58,74,0.7)',
            
                /*borderWidth: 2,
                borderColor: '#E0E0E0',
                hoverBorderWidth: 3,*/
            
                
                hoverBackgroundColor: '#3f505e',
                hoverBorderWidth: 5,
                hoverBorderColor: '#3f505e'
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
                    labelString: 'ID',
                    fontSize: 15
                 }
            }],
            yAxes: [{
                scaleLabel: {
                    display: true,
                    labelString: '|Estimated - Recorded LOS|',
                    fontSize: 15
                 },
                 ticks: {
                    beginAtZero: true
                }
            }]
        },

    }
})