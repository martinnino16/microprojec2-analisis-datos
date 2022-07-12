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

    $file_url = $_FILES['file_upload']['tmp_name'];
    /*$lineas = file($file_url);
        foreach($lineas as $linea){
            echo $linea;
        }*/

    //  Consumir API de jugadores
    $data = file_get_contents("http://evalua.fernandoyepesc.com/04_Modules/11_Evalua/10_WS/ws_evitems.php?&eboxid=89");
    //  Decodificar la data en formato json
    $json_data = json_decode($data, true);

    /*foreach($json_data as $object)
        {
            print_r($object['id']);
            echo '<br>';
        }*/

    $array_escolaridad = escolaridad_jugadores($json_data);
    $array_posiciones = posiciones_juego($json_data);
    $array_razas = show_razas($json_data);
    $array_lateralidad = show_lateralidad($json_data);
    $array_edades_jugadores = histogramaEdades($json_data);
    ?>

    <!-- GRÁFICA ESCOLARIDAD -->
    <script type="text/javascript">
        const escolaridad = JSON.parse('<?php echo $array_escolaridad ?>');
    </script>
    <script type="text/javascript" src="./escolaridad.js"></script>

    <!-- GRÁFICA POSICIONES DE JUEGO -->
    <script type="text/javascript">
        const positions = JSON.parse('<?php echo $array_posiciones ?>');
    </script>
    <script type="text/javascript" src="./posicionesJuego.js"></script>

    <!-- GRÁFICA RAZAS JUGADORES -->
    <script type="text/javascript">
        const razas = JSON.parse('<?php echo $array_razas ?>');
    </script>
    <script type="text/javascript" src="./razas.js"></script>

    <!-- GRÁFICA LATERALIDAD -->
    <script type="text/javascript">
        const lateralidad = JSON.parse('<?php echo $array_lateralidad  ?>');
    </script>
    <script type="text/javascript" src="./lateralidad.js"></script>

    <!-- HISTOGRAMA DE EDADES -->
    <script type="text/javascript">
        const edadesJugadores = <?php echo $array_edades_jugadores ?>;
    </script>
    <script type="text/javascript" src="./edades.js"></script>

    <!-- Pruebas -->
    <script type="text/javascript">
        var obj = JSON.stringify(<?php echo $data ?>);
    </script>
    <script type="text/javascript" src="./pruebas.js"></script>
</body>

</html>