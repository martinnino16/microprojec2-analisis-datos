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
    <div class="container my-5">
        <div class="col-12">
            <form action="" method="POST" enctype="multipart/form-data">
                <div>
                    <div class="flex-center">Cargar Archivo de Configuración</div>
                    <div class="flex-center">
                        <input type="file" name="file_upload" />
                    </div>
                </div>
                <div class="div-btn-upl">
                    <button class="button">Cargar</button>
                </div>
            </form>
        </div>
    </div>
    <div class="container my-5">
        <div class="row text-center">
            <h1>Grupo 302-2</h1>
            <div class="col-6" id="graph1">

                <figure class="highcharts-figure">
                    <div id="container"></div>
                    <p class="highcharts-description">
                        Esta gráfica de torta muestra el porcentaje de los jugadores
                        agrupados según su grado de escolaridad.
                    </p>
                </figure>
            </div>
            <div class="col-6" id="graph2">
                <figure class="highcharts-figure">
                    <div id="positions-container"></div>
                    <p class="highcharts-description">
                        La gráfica muestra el porcentaje de jugadores que juegan en una
                        posición específica de acuerdo al total de jugadores de la
                        plantilla.
                    </p>
                </figure>
            </div>
        </div>

        <div class="row">
            <div class="col-6" id="graph3">
                <figure class="highcharts-figure">
                    <div id="container-razas"></div>
                    <p class="highcharts-description">
                        Esta gráfica de barras muestra La cantidad de jugadores según su raza.
                    </p>
                </figure>
            </div>
            <div class="col-6" id="graph4">
                <figure class="highcharts-figure">
                    <div id="container-lateral"></div>
                    <p class="highcharts-description">
                        Esta gráfica de barras muestra el % de diestros y zurdos de la población.
                    </p>
                </figure>
            </div>
        </div>

        <div class="row">
            <div class="col-6" id="graph5">
                <div id="chart_div" style="width: 546px; height: 500px;"></div>
            </div>
        </div>

    </div>
    

    <?php
    require_once('funciones.php');
    require_once('leerConfiguracion.php');
    //Almacenar archivo cargado
    $file_url = $_FILES['file_upload']['tmp_name'];

    //Leer archivo
    $lineas = file($file_url);
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
            print_r($popup);

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
    ?>

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
    <script type="text/javascript" src="./edades.js"></script>

    <!-- Pruebas -->
    <script type="text/javascript" src="./histogramChart.js"></script>

    <!-- PRUEBAS -->
    <script type="text/javascript">
        var obj = JSON.stringify(<?php echo $data ?>);
    </script>
    <script type="text/javascript" src="./pruebas.js"></script>
</body>

</html>