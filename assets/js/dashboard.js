var options = {
    chart: {
        type: 'donut',
        height: 400
    },
    dataLabels: {
        enabled: false,
    },
    labels: ['Ouvert', 'Non ouvert', 'Délivré', 'Ajout/Mise à jour des données'],
    plotOptions: {
        pie: {
            size: 85,
            donut: {
                size: '85%'
            }
        }
    },
    legend: {
        show: true,
        showForSingleSeries: false,
        showForNullSeries: true,
        showForZeroSeries: true,
        position: 'bottom',
        horizontalAlign: 'left',
        offsetY: 30,
        itemMargin: {
            horizontal: 0,
            vertical: 20
        },
        labels: {
            colors: ['#B3B3B3']
        },
    },
    series: [69, 55, 41, 10],
    responsive: [{
        breakpoint: 480,
        options: {
            chart: {
                width: 200
            },
            legend: {
                position: 'bottom'
            }
        }
    }]
}

var chart = new ApexCharts(
    document.querySelector("#chart"),
    options
);

chart.render();


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
