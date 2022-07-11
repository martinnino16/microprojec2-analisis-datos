
// Chart razas
Highcharts.chart('container-razas', {
    chart: {
        type: 'bar'
    },
    title: {
        text: 'Razas'
    },
    xAxis: {
        title: {
            text: null
        }
    },
    tooltip: {
        headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
        pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.y:.2f}%</b> of total<br/>'
    },
    plotOptions: {
        bar: {
            dataLabels: {
                enabled: true,
                format: '<b>{point.name}</b>: {point.y:.2f} %'
            },
        }
    },
    legend: {
        layout: 'vertical',
        align: 'right',
        verticalAlign: 'top',
        x: -40,
        y: 80,
        floating: true,
        borderWidth: 1,
        backgroundColor: Highcharts.defaultOptions.legend.backgroundColor || '#FFFFFF',
        shadow: true
    },
    credits: {
        enabled: false
    },
    series: [{
        name: razas[0].name,
        data: [razas[0].data]
    },{
        name: razas[1].name,
        data: [razas[1].data]
    },{
        name: razas[2].name,
        data: [razas[2].data]
    },{
        name: razas[3].name,
        data: [razas[3].data]
    },{
        name: razas[4].name,
        data: [razas[4].data]
    }]
});