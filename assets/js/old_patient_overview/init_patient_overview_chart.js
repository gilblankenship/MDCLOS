var ctx = document.getElementById('chart_patient_overview')
var timeFormat = 'MM/DD/YYYY';

var chart_patient_overview = new Chart(ctx, {
    type: 'line',
    data: {
        datasets: [
            
            {
                label: "Progress LOS",
                data: [],
                fill: false,
                borderColor: 'rgba(142, 156, 64, 1)',
                tension: 0
            },{
                label: "Original Estimate",
                data: [],
                fill: true,
                borderColor: 'rgba(247,78,78,1)',
                backgroundColor: 'rgba(247,78,78,0.2)',
                tension: 0,
                borderDash: [10,10]
            },
        ]
    },
    options: {
        
        maintainAspectRatio: false,
        legend: {
            display: true},
        scales: {
            xAxes: [{
                offset: true,
                type: 'time',
                time: {
                    format: timeFormat,
                    tooltipFormat: 'll',
                    unit: 'day'
                },
                distribution: 'linear',
                scaleLabel: {
                    display: false,
                    fontSize: 15
                 }
            }],
            yAxes: [{
                scaleLabel: {
                    display: true,
                    labelString: 'Days Remaining',
                    fontSize: 15
                 }
            }]
        },
        annotation: {
            annotations: [
                {
                    type: "line",
                    mode: "vertical",
                    scaleID: "x-axis-0",
                    value: "09/10/2020",
                    borderColor: "black",
                    label: {
                        content: "TODAY",
                        enabled: true,
                        position: "top"
                    }
                }
            ]
        }
    }
})

// labels: ['2020-07-14', '2020-08-05'],
//         datasets: [{
//                 // admitted
//                 label: 'Initial',
//                 data: [23, 1],
//                 backgroundColor: '#FF2D00',
//                 borderColor: '#FF2D00',
//                 lineTension: 0,
//                 fill: false
//             }]

// var ctx = document.getElementById('chart_patient_overview')

// var chart_patient_overview = new Chart(ctx, {
//     type: 'line',
//     data: {
//         labels: ['2020-07-14','2020-07-20','2020-08-01','2020-08-05'],
//         datasets: [{
//                 // admitted
//                 label: 'Initial',
//                 data: [23, 0, 0, 1],
//                 backgroundColor: '#FF2D00',
//                 lineTension: 0
//             },{
//                 // admitted
//                 label: 'Physical Therapy',
//                 data: [0, 17, 1, 0],
//                 backgroundColor: '#FFDC00'
//             },{
//                 // admitted
//                 label: 'Social Worker',
//                 data: [0, 0, 0, 0],
//                 backgroundColor: '#00FF78'
//             }]
//     },
//     options: {
//         maintainAspectRatio: false,
//         legend: {
//             display: true},
//         scales: {
//             xAxes: [{
//                 offset: true,
//                 type: 'time',
//                 time: {
//                     unit: 'day'
//                 },
//                 distribution: 'linear',
//                 scaleLabel: {
//                     display: false,
//                     fontSize: 15
//                  }
//             }],
//             yAxes: [{
//                 scaleLabel: {
//                     display: true,
//                     labelString: 'Days Remaining',
//                     fontSize: 15
//                  }
//             }]
//         },
//     }
// })