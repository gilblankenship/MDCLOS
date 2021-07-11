// this chart will display a timeline for users in order to help them visualize
// how a patient is progressing throughout their stay
var ctx = document.getElementById('chart_patient_overview');
var timeFormat = 'MM/DD/YYYY';

var chart_patient_overview = new Chart(ctx, {
    type: 'line',
    data: {
        // two datasets, one holding only the initial LOS estimate, and the
        // other holding the supplemental estimates that are made during 
        // treatment
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
        // ensures that the chart canvas can scale to other screen sizes
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
        // annotations allow us to add extra lines on top of our graph,
        // in this context we use annotations in order to display supplemental
        // action events on the timeline, along with the current date
        annotation: {
            annotations: []
        }
    }
})