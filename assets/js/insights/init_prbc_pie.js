var ctx = document.getElementById('prbc_pie')

var prbc_pie = new Chart(ctx, {
    type: 'pie',
    data: {
        labels: ['Yes','No'],
        datasets: [{
            // normal
            data: [],
            backgroundColor: ['#FFBC42','#D81159'],
        },{
            // outliers
            data: [],
            backgroundColor: ['#FFBC42','#D81159'],
        }]
    },
    options: {
        maintainAspectRatio: false,
    }
})