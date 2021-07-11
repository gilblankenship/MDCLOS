var ctx = document.getElementById('gcs_pie')

var gcs_pie = new Chart(ctx, {
    type: 'pie',
    data: {
        labels: ['>= 11','< 11'],
        datasets: [{
            // normal
            data: [],
            backgroundColor: ['#420039','#932F6D'],
        },{
            // outliers
            data: [],
            backgroundColor: ['#420039','#932F6D'],
        }]
    },
    options: {
        maintainAspectRatio: false,
    }
})