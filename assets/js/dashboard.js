// Set new default font family and font color to mimic Bootstrap's default styling
Chart.defaults.global.defaultFontFamily = 'Nunito', '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
Chart.defaults.global.defaultFontColor = '#858796';

// Pie Chart Example
var ctx = document.getElementById("myPieChart");
var myPieChart = new Chart(ctx, {
    type: 'doughnut',
    data: {
        labels: ["Ouvert", "Non ouvert", "Non délivré", "Ajout/mise à jour des données"],
        datasets: [{
            data: [30, 30, 15, 35],
            backgroundColor: ['#3a5cff', '#fcb414', '#ea110d','#17cc20'],
            hoverBackgroundColor: ['#2c4fb9', '#c48e14', '#a4110d','#17991f'],
            hoverBorderColor: "rgba(234, 236, 244, 1)",
            pointStyle: 'rect',
        }],
    },
    options: {
        maintainAspectRatio: false,
        tooltips: {
            backgroundColor: "rgb(255,255,255)",
            bodyFontColor: "#858796",
            borderColor: '#dddfeb',
            borderWidth: 10,
            xPadding: 15,
            yPadding: 15,
            displayColors: true,
            caretPadding: 10,
        },
        legend: {
            display: true,
            position: "bottom",
            fontStyle: "normal",
            labels: {
                usePointStyle: true
            },
        },
        rotation: 2,
        cutoutPercentage: 85,
    },
});

// Set new default font family and font color to mimic Bootstrap's default styling
Chart.defaults.global.defaultFontFamily = '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
Chart.defaults.global.defaultFontColor = '#292b2c';


// Chart Component Dashboard
var options = {
    chart: {
        height: 350,
        type: 'line',
        shadow: {
            enabled: true,
            color: '#000',
            top: 18,
            left: 7,
            blur: 10,
            opacity: 1
        },
        toolbar: {
            show: false
        }
    },
    colors: ['#77B6EA', '#545454'],
    dataLabels: {
        enabled: true,
    },
    series: [{
        name: "Opérations",
        data: [28, 29, 33, 36, 32, 32, 33]
    },
        {
            //Pour avoir le point en haut a droite
            name: "",
            data: []
        }
    ],
    grid: {
        borderColor: '#e7e7e7',
        row: {
            colors: ['#f3f3f3', 'transparent'], // takes an array which will be repeated on columns
            opacity: 0.5
        },
    },
    markers: {

        size: 6
    },
    xaxis: {
        categories: ['Jan', 'Fev', 'Mar', 'Avr', 'Mai', 'Jui', 'Juil']
    },
    legend: {
        position: 'top',
        horizontalAlign: 'right',
        floating: true,
        offsetY: -25,
        offsetX: -5
    }
}

var chart = new ApexCharts(
    document.querySelector("#line-operation-chart"),
    options
);
chart.render();

var options = {
    chart: {
        height: 230,
        type: 'radialBar',
    },

    series: [44],
    labels: ["Indice de qualité CRM"],
    colors: ["#ffa200"],
    plotOptions: {
        radialBar: {
            startAngle: -90,
            endAngle: 90,
            hollow: {
                margin: 15,
                size: "70%"
            },

            dataLabels: {
                showOn: "always",
                name: {
                    offsetY: 20,
                    show: true,
                    color: "#999999",
                    fontSize: "12px",
                    fontWeight: "bold"
                },
                value: {
                    offsetY: -22,
                    color: "#999999",
                    fontSize: "28px",
                    show: true
                }
            }
        }
    },

    stroke: {
        lineCap: "round",
    },
}

var chart = new ApexCharts(
    document.querySelector("#chart-circle"),
    options
);

chart.render();
