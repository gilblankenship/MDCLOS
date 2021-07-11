var ctx = document.getElementById('chart_MOIVSlos')

var chart_MOIVSlos = new Chart(ctx, {
    type: 'horizontalBar',
    data: {
        datasets: [{
                // admitted
                label: 'Length-Of-Stay',
                data: [],
                borderWidth:0.8,
                borderColor: 'rgba(52, 58, 64,1)',
                backgroundColor:'rgba(163, 171, 80, 0.3)',
                hoverBackgroundColor: 'rgba(163, 171, 80, 1)'
            }]
    },
    options: {
        maintainAspectRatio: false,
        legend: {
            display: false
        },
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