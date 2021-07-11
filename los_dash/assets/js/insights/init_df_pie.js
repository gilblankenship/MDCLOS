var ctx = document.getElementById('df_pie')

var df_pie = new Chart(ctx, {
    type: 'pie',
    data: {
        labels: ['Home','Rehab','Other'],
        datasets: [{
            // normal
            data: [],
            backgroundColor: ['#515A47','#D7BE82','#7A4419'],
        },{
            // outliers
            data: [],
            backgroundColor: ['#515A47','#D7BE82','#7A4419'],
        }]
    },
    options: {
        maintainAspectRatio: false,
    }
})