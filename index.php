<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
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
    require_once('validarArchivo.php');
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
                        <li class="nav-item"><a class="nav-link" href="cargarArchivo.php">Cargar Archivo</a></li>
                    </ul>
                </div>
            </nav>
        </div>
        <br><br>
        <div class="d-flex align-items-start">
            <div class="nav flex-column nav-pills me-3" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                <?php
                $k = 0;
                foreach ($tabs as $tab) {
                    if ($k == 0) {
                        echo '<button class="nav-link active" id="v-pills-' . str_replace(" ", "-", trim($tab)) . '-tab" data-bs-toggle="pill" data-bs-target="#v-pills-' . str_replace(" ", "-", trim($tab)) . '" type="button" role="tab" aria-controls="v-pills-' . str_replace(" ", "-", trim($tab)) . '" aria-selected="true">' . $tab . '</button>';
                    } else {
                        echo '<button class="nav-link" id="v-pills-' . str_replace(" ", "-", trim($tab)) . '-tab" data-bs-toggle="pill" data-bs-target="#v-pills-' . str_replace(" ", "-", trim($tab)) . '" type="button" role="tab" aria-controls="v-pills-' . str_replace(" ", "-", trim($tab)) . '" aria-selected="true">' . $tab . '</button>';
                    }
                    $k++;
                }
                ?>
            </div>
            <div class="tab-content" style="min-width: 1200px !important;" id="v-pills-tabContent">
                <?php
                $k = 0;
                foreach ($tabs as $tab) {
                    if ($k == 0) {
                        echo '<div class="tab-pane fade show active" 
                        id="v-pills-' . str_replace(" ", "-", trim($tab)) . '" 
                        role="tabpanel" aria-labelledby="v-pills-' . str_replace(" ", "-", trim($tab)) . '-tab">
                            <div class="container">';
                        foreach ($grids as $grid) {
                            $arrayGrid = explode('x', $grid);
                            $row = $arrayGrid[0];
                            $col = $arrayGrid[1];
                            for ($i = 0; $i < $row; $i++) {
                                echo '<div class="row">';
                                for ($j = 0; $j < $col; $j++) {
                                    echo '<div class="col-' . 12 / $col . '">
                                                        <figure class="highcharts-figure">
                                                            <div id="container' . $j . '"></div>
                                                        </figure>

                                                    </div>';
                                }

                                echo '</div>';
                            }
                        }

                        echo '</div>';
                        echo '</div>';
                    } else {
                        echo '<div class="tab-pane fade" id="v-pills-' . str_replace(" ", "-", trim($tab)) . '" 
                        role="tabpanel" aria-labelledby="v-pills-' . str_replace(" ", "-", trim($tab)) . '-tab">
                        Lógica Graficas Tab '.$tab.'
                        </div>';
                    }
                    $k++;
                }
                ?>
            </div>
        </div>
    </div>

    <!-- IMPORT SCRIPTS -->
    <script type="text/javascript" src="./barChart.js"></script>
    <script type="text/javascript" src="./pieChart.js"></script>

    <!-- GRÁFICA TORTA -->
    <script type="text/javascript">
        loadPieChart('container1', 'Gráfica de Torta', <?php echo $series_pie_chart ?>);
    </script>
    <script src="./pieChart.js"></script>


    <!-- GRÁFICA BARRAS -->
    <script type="text/javascript">
        loadBarChart('container0', 'Gráfica de Barras', <?php echo $series_bar_chart ?>);
    </script>

    <!-- GRÁFICA BARRAS HORIZONTAL -->
    <script type="text/javascript">
        const seriesHorizontalBar = JSON.parse('<?php echo $series_horizontal_bar_chart ?>');
    </script>


    <!-- GRÁFICA BARRAS -->
    <script type="text/javascript">
        const lateralidad = JSON.parse('<?php echo $array_lateralidad  ?>');
    </script>


    <!-- HISTOGRAMA -->
    <script type="text/javascript">
        const edadesJugadores = <?php echo $series_edades_jugadores ?>;
    </script>


    <!-- PRUEBAS -->
    <!-- <script type="text/javascript">
        //var obj = JSON.stringify(<php echo $data ?>);
        var obj2 = <php echo json_encode($graph_names) ?>
    </script> -->

    <!-- <script type="module" src="graficos.js">

    </script> -->
    <!-- <script src="./graficos.js"></script> -->
</body>

</html>