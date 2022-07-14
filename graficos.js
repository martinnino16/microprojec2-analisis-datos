



// Graficos
// colum
const chartColum = (series, title, container) => {
    return Highcharts.chart(container, {
        chart: {
            type: 'column'
        },
        title: {
            align: 'left',
            text: title
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
            data: series
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
}
// horizontal
const horizontalBarChart = (series, title, container) => {
    return Highcharts.chart(container, {
        chart: {
            type: 'bar'
        },
        title: {
            text: title
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
        series: series
    });
}
// pie
const pieChart = (series, title, container) => {
    return Highcharts.chart(container, {
        chart: {
            plotBackgroundColor: null,
            plotBorderWidth: null,
            plotShadow: false,
            type: 'pie'
        },
        title: {
            text: title
        },
        tooltip: {
            pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
        },
        accessibility: {
            point: {
                valueSuffix: '%'
            }
        },
        plotOptions: {
            pie: {
                allowPointSelect: true,
                cursor: 'pointer',
                dataLabels: {
                    enabled: true,
                    format: '<b>{point.name}</b>: {point.percentage:.1f} %'
                },
                showInLegend: true
            }
        },
        series: [{
            name: 'Brands',
            colorByPoint: true,
            data: series
        }]
    });
}





const containerGraficos = document.querySelector('.container-graficos');
const container = document.createElement('div');
container.className = 'container';
const col = document.createElement('div');



const typeData = {
    posicion: seriesbar,
    edades: edadesJugadores,
    lateralidades: lateralidad,
    razas: seriesHorizontalBar,
    escolaridad: seriesPie
}




data.forEach((array, index) => {
    if (index % 2 === 0) {
        graph.whatPlot.push(array);
    } else {
        graph.howPlot.push(array);
    }
});


grids.forEach((grid) => {
    let arraysGrid = grid.split('x');
    let row = arraysGrid[0];
    let col = arraysGrid[1];
    for (let i = 0; i < row; i++) {
        const containerRow = document.createElement('div');
        containerRow.className = 'row';
        container.append(containerRow);
        for (let j = 0; j < col; j++) {
            const containerCol = document.createElement('div');
            const card = document.createElement('div');
            const figure = document.createElement('figure');
            const containerGraph = document.createElement('div');
            card.className = 'card';
            containerCol.className = `col-${12 / col}`;
            figure.className = 'highcharts-figure';


            containerCol.append(card);
            containerRow.append(containerCol);
            card.append(figure);
            figure.append(containerGraph);


        }

    }
})

containerGraficos.append(container);


const graficPlot = (indexPlot, typechart) => {

    
    switch (indexPlot) {
        case 1:
            chartColum(series, title, container);
            break;
        case 2: 
            horizontalBarChart(series, title, container);
            break;
        case 3: 
            pieChart(series, title, container);
            break;
        default:
            break;
    }
}