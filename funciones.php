<?php
## 
function get_chart_series($howPlot, $json_data, $whatPlot)
{
    switch ($howPlot) {
        case 1:
            return get_pie_chart_series($json_data, $whatPlot);
            break;
        case 2:
            return get_bar_chart_series($json_data, $whatPlot);
            break;
        case 3:
            return get_horizontal_bar_chart_series($json_data, $whatPlot);
            break;
        default:
    }
}

## Algoritmo para formatear los datos para la gráfica torta
function get_pie_chart_series($json_data, $index)
{
    $data = array();
    foreach ($json_data as $jugador) {
        if (!empty($jugador['valores'][$index]['value'])) {
            array_push($data, rtrim(strtoupper($jugador['valores'][$index]['value'])));
        }
    }

    $data = array_count_values($data);

    $series = array();
    $cont = 0;
    foreach ($data as $k => $v) {
        $series[$cont]['name'] = $k;
        $series[$cont]['y'] = $v;
        $cont++;
    }

    return $series = json_encode($series);
}

## Algoritmo para formatear los datos para la gráfica de barras
function get_bar_chart_series($json_data, $index)
{
    $data = array();
    $totalJugadores = 0;
    foreach ($json_data as $jugador) {
        if (!empty($jugador['valores'][$index]['value'])) {
            array_push($data, rtrim(strtoupper($jugador['valores'][$index]['value'])));
            $totalJugadores++;
        }
    }

    $data = array_count_values($data);

    $series = array();
    $cont = 0;
    foreach ($data as $k => $v) {
        $series[$cont]['name'] = $k;
        $series[$cont]['y'] = round($v / $totalJugadores * 100, 2, PHP_ROUND_HALF_UP);
        $series[$cont]['drilldown'] = $k;
        $cont++;
    }

    return $series = json_encode($series);
}

## Algoritmo para formatear los datos para la gráfica de barras horizontal
function get_horizontal_bar_chart_series($json_data, $index)
{
    $data = array();
    $totalJugadores = 0;
    foreach ($json_data as $jugador) {
        if (!empty($jugador['valores'][$index]['value'])) {
            array_push($data, rtrim(strtoupper($jugador['valores'][$index]['value'])));
            $totalJugadores++;
        }
    }

    $data = array_count_values($data);

    $series = array();
    $cont = 0;
    foreach ($data as $key => $value) {
        $series[$cont]['name'] = $key;
        $array_valor = array();
        array_push($array_valor, round($value / $totalJugadores * 100, 2, PHP_ROUND_HALF_UP));
        $series[$cont]['data'] = $array_valor;
        $cont++;
    }

    return $series = json_encode($series);
}

## Algoritmo para formatear los datos para la gráfica de histograma
function get_histogram_series($json_data, $data, $titles)
{
    $array_edades_jugadores[0][] = 'Nombre';
    $array_edades_jugadores[0][] = 'Edad';

    for ($x = 0; $x < count($data); $x++) {
        $array_edades_jugadores[$x + 1][] = $titles[$x];
        $array_edades_jugadores[$x + 1][] = intval($data[$x]);
    }

    return $array_edades_jugadores = json_encode($array_edades_jugadores);
}

## Método que lee el archivo de configuración desde la raiz del proyecto
function readFromCsvFile($afile)
{
    $row = 0;
    if (($fp = fopen($afile, "r")) !== FALSE) {
        //print_r($data2);
        while (($data = fgetcsv($fp, 3000, "#")) !== FALSE) {
            //print_r($data);
            $mmat[$row++] = $data[0];
        }
        fclose($fp);
    } else {
        echo "The file can not be found";
    }
    //print_r($mmat);
    return $mmat;
}

## Obtener el tipo de gráfica que se va a utilizar
function getWhatPlot($arrayWhatPlot, $numConfig, $index)
{
    return $arrayWhatPlot[$numConfig][$index];
}

## Obtener el tipo de gráfica que se va a utilizar
function getHowPlot($arrayHowPlot, $numConfig, $index)
{
    return $arrayHowPlot[$numConfig][$index];
}

## Obtener el tipo de gráfica que se va a utilizar
function getGraphName($arrayGraphNames, $numConfig, $index)
{
    try {
        $graphName = $arrayGraphNames[$numConfig][$index];
        return $graphName;
    } catch (Exception $e) {
        print_r($arrayGraphNames);
        return "Gráfica Generica";
    }
}
