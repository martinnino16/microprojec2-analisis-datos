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

    <!-- IMPORT SCRIPTS -->
    <script type="text/javascript" src="./barChart.js"></script>
    <script type="text/javascript" src="./pieChart.js"></script>

    <?php
    require_once('funciones.php');
    require_once('leerConfiguracion.php');
    require_once('validarArchivo.php');
    require_once('cargarGraficas.php');
    ?>

    <div id="wrapper">
        <div class="container">
            <nav class="navbar navbar-expand-lg navbar-light bg-light">
                <a class="navbar-brand" href="#">MicroProject2 G302-2</a>
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
                $indexTab = 0;
                foreach ($tabs as $tab) {
                    if ($indexTab == 0) {
                        echo '<button class="nav-link active" 
                        id="v-pills-' . str_replace(" ", "-", trim($tab)) . '-tab" 
                        data-bs-toggle="pill" data-bs-target="#v-pills-' . str_replace(" ", "-", trim($tab)) . '" 
                        type="button" role="tab" aria-controls="v-pills-' . str_replace(" ", "-", trim($tab)) . '" 
                        aria-selected="true">' . $tab . '</button>';
                    } else {
                        echo '<button class="nav-link" 
                        id="v-pills-' . str_replace(" ", "-", trim($tab)) . '-tab" 
                        data-bs-toggle="pill" data-bs-target="#v-pills-' . str_replace(" ", "-", trim($tab)) . '" 
                        type="button" role="tab" aria-controls="v-pills-' . str_replace(" ", "-", trim($tab)) . '" 
                        aria-selected="true">' . $tab . '</button>';
                    }
                    $indexTab++;
                }
                ?>
            </div>
            <div class="tab-content" style="min-width: 1200px !important;" id="v-pills-tabContent">
                <?php
                $indexTab = 0;
                $contDiv = 1;
                foreach ($tabs as $tab) {
                    if ($indexTab == 0) {
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
                                                <div id="container' . $contDiv . '"></div>
                                            </figure>
                                        </div>';
                                    echo load_chart(
                                        getHowPlot($how_plot, $indexTab, $contDiv - 1),
                                        "container$contDiv",
                                        getGraphName($graph_names, $indexTab, $contDiv - 1),
                                        get_chart_series(getHowPlot($how_plot, $indexTab, $contDiv - 1), $json_data, getWhatPlot($what_plot, $indexTab, $contDiv - 1))
                                    );
                                    $contDiv++;
                                }
                                echo '</div>';
                            }
                            break;
                        }
                        echo '</div>';
                        echo '</div>';
                    } else {
                        echo '<div class="tab-pane fade" id="v-pills-' . str_replace(" ", "-", trim($tab)) . '" 
                        role="tabpanel" aria-labelledby="v-pills-' . str_replace(" ", "-", trim($tab)) . '-tab">
                            <div class="container">';
                        $gridCero = 0;
                        $indexHowWhatPlot = 0;
                        foreach ($grids as $grid) {
                            if ($gridCero != 0) {
                                $arrayGrid = explode('x', $grid);
                                $row = $arrayGrid[0];
                                $col = $arrayGrid[1];
                                for ($i = 0; $i < $row; $i++) {
                                    echo '<div class="row">';
                                    for ($j = 0; $j < $col; $j++) {
                                        echo '<div class="col-' . 12 / $col . '">
                                                <figure class="highcharts-figure">
                                                    <div id="container' . $contDiv . '"></div>
                                                </figure>
                                            </div>';
                                        echo load_chart(
                                            getHowPlot($how_plot, $indexTab, $indexHowWhatPlot),
                                            "container$contDiv",
                                            getGraphName($graph_names, $indexTab, $indexHowWhatPlot),
                                            get_chart_series(getHowPlot($how_plot, $indexTab, $indexHowWhatPlot), $json_data, getWhatPlot($what_plot, $indexTab, $indexHowWhatPlot))
                                        );
                                        $indexHowWhatPlot++;
                                        $contDiv++;
                                    }
                                    echo '</div>';
                                }
                            }
                            $gridCero++;
                        }
                        echo '</div>';
                        echo '</div>';
                    }
                    $indexTab++;
                }
                ?>
            </div>
        </div>
    </div>
</body>

</html>