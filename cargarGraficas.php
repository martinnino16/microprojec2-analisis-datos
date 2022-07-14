<?
function load_chart($type){


}

function load_pie_chart($idContainer,$title,$series){
    echo '<script type="text/javascript" src="./pieChart.js"></script>';
    echo '<script type="text/javascript">loadPieChart('.$idContainer.','.$title.','.$series.')</script>';
}

function load_bar_chart($idContainer,$title,$series){
    echo '<script type="text/javascript" src="./barChart.js"></script>';
    echo '<script type="text/javascript">loadBarChart('.$idContainer.','.$title.','.$series.')</script>';
}