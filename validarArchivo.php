<?php
//Almacenar archivo cargado
$lineas = readFromCsvFile("config-file.csv");

$graph_names = '';


//Validar contenido archivo
if (!empty($lineas) & count($lineas) > 1) {
    $i = 0;
    $cabecera;
    $configs = array();
    foreach ($lineas as $linea) {

        if ($i == 0) {
            $cabecera = explode(";", $linea);
        } else {
            array_push($configs, explode(";", $linea));
        }
        $i++;
    }
    // Validar que sí haya configuraciones parametrizadas
    if (!empty($configs)) {

        // Get what and how to plot
        $what_plot = getWhatPlot($configs);
        $how_plot = getHowPlot($configs);

        // Get graph names
        $graph_names = getGraphNames($configs);

        // Get grids
        $grids = getGrids($configs);

        // Get rounded corners
        $rounded_corners = getRoundedCorners($configs);

        // Get graph and table space
        $graph_table = getGraphTable($configs);

        // Get data resolution
        $data_resolution = getDataResolution($configs);

        // Get TABS
        $tabs = getTabs($configs);

        // Get PopUp
        $popup = getPopup($configs);
    }
}

//  Consumir API de jugadores
$data = file_get_contents("http://evalua.fernandoyepesc.com/04_Modules/11_Evalua/10_WS/ws_evitems.php?&eboxid=89");
//  Decodificar la data que viene en formato json
$json_data = json_decode($data, true);

// Dar forma a los datos de acuerdo a la estructura de cada tipo de chart
$series_pie_chart = pie_chart($json_data, 5);
$series_bar_chart = bar_chart($json_data, 4);
$series_horizontal_bar_chart = horizontal_bar_chart($json_data, 6);
$array_lateralidad = bar_chart($json_data, 3);

// Obtener nombres completos de los jugadores
$histogram_data = array();
$nombresJugadores = array();

foreach ($json_data as $jugador) {
    if (!empty($jugador['valores'][2]['value'])) {

        $fechaNacimiento = explode(" ", $jugador['valores'][2]['value']);

        $edad = substr($fechaNacimiento[1], 1);

        array_push($histogram_data, $edad);

        $nombreCompleto = $jugador['valores'][0]['value'] . " " . $jugador['valores'][1]['value'];

        array_push($nombresJugadores, $nombreCompleto);
    }
}

// Formatear la data para el histograma
$series_edades_jugadores = histogram($json_data, $histogram_data, $nombresJugadores);
