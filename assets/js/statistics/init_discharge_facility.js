var ctx = document.getElementById('chart_discharge')

var chart_discharge = new Chart(ctx, {
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
        maintainAspectRatio: false,
        legend: {
            display: false},
        scales: {
            xAxes: [{
                scaleLabel: {
                    display: true,
                    labelString: 'Length of Stay (Days)',
                    fontSize: 15
                 },ticks: {
                    beginAtZero: true
                }
            }]
        },

    }
})