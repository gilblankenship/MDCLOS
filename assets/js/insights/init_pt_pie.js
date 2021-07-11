var ctx = document.getElementById('pt_pie')

var pt_pie = new Chart(ctx, {
    type: 'pie',
    data: {
        labels: ['Yes','No'],
        datasets: [{
            // normal
            data: [],
            backgroundColor: ['#30BCED','#303036'],
        },{
            // outliers
            data: [],
            backgroundColor: ['#30BCED','#303036'],
        }]
    },
    options: {
        maintainAspectRatio: false,
    }
})