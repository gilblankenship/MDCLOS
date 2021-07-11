var ctx = document.getElementById('sc_pie')

var sc_pie = new Chart(ctx, {
    type: 'pie',
    data: {
        labels: ['Yes','No'],
        datasets: [{
            // normal
            data: [],
            backgroundColor: ['#58355E','#E03616'],
        },{
            // outliers
            data: [],
            backgroundColor: ['#58355E','#E03616'],
        }]
    },
    options: {
        maintainAspectRatio: false,
    }
})