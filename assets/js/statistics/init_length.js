var ctx = document.getElementById('chart_surgery_length')

var chart_surgery_length = new Chart(ctx, {
    type: 'horizontalBar',
    data: {
        datasets: [{
                label: 'Mean LOS',
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
                    labelString: 'Length of Stay (Days)',
                    fontSize: 15
                 },ticks: {
                    beginAtZero: true
                }
            }]
        },

    }
})