var ctx = document.getElementById('chart_insuranceVSlos')

var chart_insuranceVSlos = new Chart(ctx, {
    type: 'horizontalBar',
    data: {
        datasets: [{
                label: 'Recorded LOS',
                data: [],
                borderWidth:0.8,
                borderColor: 'rgba(52, 58, 64,1)',
                backgroundColor:'rgba(163, 171, 80, 0.3)',
                hoverBackgroundColor: 'rgba(163, 171, 80,, 1)'
            },
            {
                label: 'Estimated LOS',
                data: [],
                backgroundColor: 'rgba(52, 58, 64, 0.8)',
                hoverBackgroundColor: 'rgba(52, 58, 64, 1)'
            }]
    },
    options: {
        maintainAspectRatio: false,
        legend: {
            display: true},
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
        }
    }
})