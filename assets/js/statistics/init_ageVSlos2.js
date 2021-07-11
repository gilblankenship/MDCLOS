var ctx = document.getElementById('chart_ageVSlos2')

var chart_ageVSlos2 = new Chart(ctx, {
    type: 'horizontalBar',
    data: {
        datasets: [
            {
                // admitted
                label: 'Length-Of-Stay',
                data: [],
                backgroundColor: 'rgba(52, 58, 64, 0.8)',
                hoverBackgroundColor: 'rgba(52, 58, 64, 1)'
            }],
            labels: ['<10','10-20','20-30','30-40','40-50','50-60','60-70','70-80','>80']
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
                 }
            }]
        },

    }
})