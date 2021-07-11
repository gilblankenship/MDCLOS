var ctx = document.getElementById('asa_pie')

var asa_pie = new Chart(ctx, {
    type: 'pie',
    data: {
        labels: ['1 or 2','3 or 4'],
        datasets: [{
            // normal
            data: [],
            backgroundColor: ['#F6D8AE','#2E4057'],
        },{
            // outliers
            data: [],
            backgroundColor: ['#F6D8AE','#2E4057'],
        }]
    },
    options: {
        maintainAspectRatio: false,
    }
})