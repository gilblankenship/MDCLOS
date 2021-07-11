var ctx = document.getElementById('chart_type_procedure')

var chart_type_procedure = new Chart(ctx, {
    type: 'horizontalBar',
    data: {
        datasets: [{
                data: [],
                borderWidth:0.8,
                borderColor: 'rgba(52, 58, 64,1)',
                backgroundColor:'rgba(163, 171, 80, 0.3)',
                hoverBackgroundColor: 'rgba(52, 58, 64, 1)'
            }]
    },
    options: {
        maintainAspectRatio: true,
        legend: {
            display: false},
        scales: {
            yAxes:[{
                scaleLabel: {
                    display: true,
                    labelString: 'Type of procedure',
                    fontSize: 15
                 },ticks: {
                    beginAtZero: true
                }
            }],
            xAxes: [{
                scaleLabel: {
                    display: true,
                    labelString: 'Reduction in days',
                    fontSize: 15
                 },ticks: {
                    beginAtZero: true
                }
            }]
        },

    }
})