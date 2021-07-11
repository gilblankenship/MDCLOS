var ctx = document.getElementById('ns_pie')

var ns_pie = new Chart(ctx, {
    type: 'pie',
    data: {
        labels: ['Complete Injury','Other'],
        datasets: [{
            // normal
            data: [],
            backgroundColor: ['#F06543','#E8E9EB'],
        },{
            // outliers
            data: [],
            backgroundColor: ['#F06543','#E8E9EB'],
        }]
    },
    options: {
        maintainAspectRatio: false,
    }
})