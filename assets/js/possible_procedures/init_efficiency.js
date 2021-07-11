var ctx = document.getElementById('chart_efficiency')

var chart_efficiency = new Chart(ctx, {
    type: 'horizontalBar',
    data: {
        labels: ["Occupational therapy","Physical Therapy"],
        datasets: [
            {
                label: 'Patient',
                data: [],
                fill: true,
                borderWidth:3,
                borderColor: 'rgba(247,78,78,1)',
                backgroundColor: 'rgba(247,78,78,0.7)'
            },
            
            {
                label: 'All patients',
                data: [],
                
                fill: false,
                borderWidth:3,
                borderColor: 'rgba(142, 156, 64, 1)'
            }]
    },
    options: {
        maintainAspectRatio: false,
        legend: {
            display: true},
        scales: {
            yAxes: [{
                ticks: {
                    beginAtZero: true
                }
            }],
            xAxes: [{
            ticks: {
                beginAtZero: true
            },
            scaleLabel: {
                display: true,
                labelString: 'Savings per $ of treatment',
                fontSize: 15
            }
        }]
        },

    }
})

