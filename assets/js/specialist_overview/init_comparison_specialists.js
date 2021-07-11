var ctx = document.getElementById('specialist_comparison')

var specialist_comparison = new Chart(ctx, {
    type: 'bar',
    data: {
        labels:[],
        datasets: [{
                data: [],
                fill: false,
                borderWidth:3,
                borderColor: 'rgba(142, 156, 64, 1)',
                hoverBackgroundColor: 'rgba(52, 58, 64, 1)'
            }]
    },
    options: {
        maintainAspectRatio: true,
        legend: {
            display: false},
        scales: {
            xAxes: [{
                scaleLabel: {
                    display: true,
                    labelString: 'Specialists',
                    fontSize: 15
                 }
            }],
            yAxes: [{
                ticks: {
                    beginAtZero: true
                },
                scaleLabel: {
                    display: true,
                    labelString: 'Reduction Factor',
                    fontSize: 15
                 }
            }]
        },
    }
})