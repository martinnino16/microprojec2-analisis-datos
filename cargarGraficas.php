<?
function load_pie_chart($idContainer,$title,$series){
    echo '<script type="text/javascript" src="./pieChart.js"></script>';
    echo '<script type="text/javascript">load_pie_chart('.$idContainer.','.$title.','.$series.')</script>';
}