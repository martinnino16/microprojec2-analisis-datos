
// Create the chart for positions
Highcharts.chart('positions-container', {
    chart: {
        type: 'column'
    },
    title: {
        align: 'left',
        text: 'Posiciones de Juego'
    },
    subtitle: {
        align: 'left',
        text: 'Click the columns to view versions. Source: <a href="http://statcounter.com" target="_blank">statcounter.com</a>'
    },
    accessibility: {
        announceNewData: {
            enabled: true
        }
    },
    xAxis: {
        type: 'category'
    },
    yAxis: {
        title: {
            text: 'Total percent game position'
        }
    },
    legend: {
        enabled: false
    },
    plotOptions: {
        series: {
            borderWidth: 0,
            dataLabels: {
                enabled: true,
                format: '{point.y:.1f}%'
            }
        }
    },

    tooltip: {
        headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
        pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.y:.2f}%</b> of total<br/>'
    },

    series: [{
        name: "Positions",
        colorByPoint: true,
        data: seriesbar
    }],
    drilldown: {
        breadcrumbs: {
            position: {
                align: 'right'
            }
        },
        series: []
    }
});