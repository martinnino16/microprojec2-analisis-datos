<?php

function load_chart($howPlot, $idContainer, $title, $series)
{
    switch ($howPlot) {
        case 1:
            load_pie_chart($idContainer, $title, $series);
            break;
        case 2:
            load_bar_chart($idContainer, $title, $series);
            break;
        case 3:
            load_horizontal_bar_chart($idContainer, $title, $series);
            break;
        default:
    }
}

function load_pie_chart($idContainer, $title, $series)
{
    echo '<script type="text/javascript" src="./pieChart.js"></script>';
    echo '<script type="text/javascript">
                loadPieChart("' . $idContainer . '", "' . $title . '",' . $series . ');
          </script>';
}

function load_bar_chart($idContainer, $title, $series)
{
    echo '<script type="text/javascript" src="./barChart.js"></script>';
    echo '<script type="text/javascript">
                loadBarChart("' . $idContainer . '", "' . $title . '",' . $series . ');
          </script>';
}

function load_horizontal_bar_chart($idContainer, $title, $series)
{
    echo '<script type="text/javascript" src="./horizontalBarChart.js"></script>';
    echo '<script type="text/javascript">
                loadHorizontalBarChart("' . $idContainer . '", "' . $title . '",' . $series . ');
          </script>';
}
