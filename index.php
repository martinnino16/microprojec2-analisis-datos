<!DOCTYPE html>
<html>

<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.highcharts.com/highcharts.js"></script>
    <script src="https://code.highcharts.com/modules/exporting.js"></script>
    <script src="https://code.highcharts.com/modules/export-data.js"></script>
    <script src="https://code.highcharts.com/modules/accessibility.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js"></script>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

    <link rel="stylesheet" href="mystyles.css">
</head>

<body>
    <?php
    require_once('funciones.php');
    require_once('leerConfiguracion.php');
  
    echo '<br><br>';
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

    $what_plot = json_encode($what_plot);
    $how_plot = json_encode($how_plot);
    $grids = json_encode($grids);
    $graph_names = json_encode($graph_names);
    $rounded_corners = json_encode($rounded_corners);
    $graph_table = json_encode($graph_table);
    $data_resolution = json_encode($data_resolution);
    $popup = json_encode($popup);

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
    ?>

    <div id="wrapper">
        <div class="container">
            <nav class="navbar navbar-expand-lg navbar-light bg-light">
                <a class="navbar-brand" href="#">MicroProject2</a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav mr-auto">
                        <?php
                        $j = 0;
                        foreach ($tabs as $tab) {
                            echo '<li class="nav-item"><a class="nav-link" href="#">' . $tab . '</a></li>';
                            $j++;
                        }
                        ?>
                        <li class="nav-item"><a class="nav-link" href="cargarArchivo.php">Cargar Archivo</a></li>
                    </ul>
                </div>
            </nav>
        </div>


        <div class="container-graficos my-5">

        </div>
    </div>

    <script type="text/javascript">
        const what_plot = <?php echo $what_plot ?>;
        const how_plot = <?php echo $how_plot ?>;
        const grids = <?php echo $grids ?>;
        const graph_names = <?php echo $graph_names ?>;
        const rounded_corners = <?php echo $rounded_corners ?>;
        const graph_table = <?php echo $graph_table ?>;
        const data_resolution = <?php echo $data_resolution ?>;
        const popup = <?php echo $popup ?>;
    </script>

    <script src="./graficos.js"></script>

   

    <!-- GRÁFICA ESCOLARIDAD -->
    <script type="text/javascript">
        const seriesPie = JSON.parse('<?php echo $series_pie_chart ?>');
    </script>
    <script type="text/javascript" src="./pieChart.js"></script>

    <!-- GRÁFICA POSICIONES DE JUEGO -->
    <script type="text/javascript">
        const seriesbar = JSON.parse('<?php echo $series_bar_chart ?>');
    </script>
    <script type="text/javascript" src="./barChart.js"></script>

    <!-- GRÁFICA RAZAS JUGADORES -->
    <script type="text/javascript">
        const seriesHorizontalBar = JSON.parse('<?php echo $series_horizontal_bar_chart ?>');
    </script>
    <script type="text/javascript" src="./horizontalBarChart.js"></script>

    <!-- GRÁFICA LATERALIDAD -->
    <script type="text/javascript">
        const lateralidad = JSON.parse('<?php echo $array_lateralidad  ?>');
    </script>
    <script type="text/javascript" src="./pieChart.js"></script>

    <!-- HISTOGRAMA DE EDADES -->
    <script type="text/javascript">
        const edadesJugadores = <?php echo $series_edades_jugadores ?>;
    </script>
    <script type="text/javascript" src="./histogramChart.js"></script>

    <!-- PRUEBAS -->
    <script type="text/javascript">
        var obj = JSON.stringify(<?php echo $data ?>);
    </script>
    <script type="text/javascript" src="./pruebas.js"></script>
</body>

</html>