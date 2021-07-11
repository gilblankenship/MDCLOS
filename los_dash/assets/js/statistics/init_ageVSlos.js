var ctx = document.getElementById('chart_ageVSlos')

var chart_ageVSlos = new Chart(ctx, {
    type: 'doughnut',
    data: {
        labels: ['<10','10-20','20-30','30-40','40-50','50-60','60-70','70-80','>80'],
        datasets: [{
            data: [],
            backgroundColor: ['rgba(10, 50, 0, 0.8)', 'rgba(213, 58, 74, 0.8)', 'rgba(190, 120, 57, 0.8)', 'rgba(167, 181, 40, 0.8)', 'rgba(109, 175, 99, 0.8)', 'rgba(80, 172, 129, 0.8)', 'rgba(50, 168, 158, 0.8)', 'rgba(57, 124, 126, 0.8)', 'rgba(63, 80, 94, 0.8)'],
            hoverBackgroundColor: ['rgba(10, 50, 0, 1)', 'rgba(213, 58, 74, 1)', 'rgba(190, 120, 57, 1)', 'rgba(167, 181, 40, 1)', 'rgba(109, 175, 99, 1)', 'rgba(80, 172, 129, 1)', 'rgba(50, 168, 158, 1)', 'rgba(57, 124, 126, 1)', 'rgba(63, 80, 94, 1)']
        }]
    },
    options: {
        maintainAspectRatio: false,
    }
})