var ctx = document.getElementById('chart_analysis')

var chart_analysis = new Chart(ctx, {
    type: 'horizontalBar',
    data: {
        labels: ['Occupational Therapy ', 'Physical Therapy'],
        datasets: [
            {
                label: 'Reduction in treatment cost',
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
            display: true},
        scales: {
            xAxes: [{
                scaleLabel: {
                    display: true,
                    labelString: 'Net Savings ($)',
                    fontSize: 15
                 },
                ticks: {
                    beginAtZero: true
                }
            }]
        },

    }
})