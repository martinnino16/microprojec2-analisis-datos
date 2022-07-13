



const containerGraficos = document.querySelector('.container-graficos');
const container = document.createElement('div');
container.className = 'container';
const col = document.createElement('div');

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
            containerCol.className = `col-${12/col}`;
            figure.className = 'highcharts-figure';
            containerGraph.id = 'positions-container';
            containerCol.append(card);
            containerRow.append(containerCol);
            card.append(figure);
            figure.append(containerGraph);
        }

    }
})

containerGraficos.append(container)