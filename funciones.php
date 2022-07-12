<?php
    ## Algoritmo para obtener grado de escolaridad de los jugadores
    function pie_chart($json_data, $index) {
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

    ## Construir algoritmo para la gráfica de posiciones de juego
    function bar_chart($json_data, $index) {
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

    // Grafica de las razas
    function horizontal_bar_chart($json_data, $index) {
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
            array_push($array_valor,round($value / $totalJugadores * 100, 2, PHP_ROUND_HALF_UP));
            $series[$cont]['data'] = $array_valor;
            $cont++;
        }

        return $series = json_encode($series);
    }

    // Histograma Edades
    function histogram($json_data, $data, $titles) {
        $array_edades_jugadores[0][] = 'Nombre';
        $array_edades_jugadores[0][] = 'Edad';
        
        for ($x = 0; $x < count($data); $x++){
            $array_edades_jugadores[$x+1][] = $titles[$x];
            $array_edades_jugadores[$x+1][] = intval($data[$x]);
        }

        return $array_edades_jugadores = json_encode($array_edades_jugadores);
    }

?>