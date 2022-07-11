<?php
    ## Algoritmo para obtener grado de escolaridad de los jugadores
    function escolaridad_jugadores($json_data) {
        $escolaridad = array();
        foreach ($json_data as $jugador) {
            if (!empty($jugador['valores'][5]['value'])) {
                array_push($escolaridad, rtrim(strtoupper($jugador['valores'][5]['value'])));
            }
        }

        $escolaridad = array_count_values($escolaridad);

        $cont = 0;
        foreach ($escolaridad as $k => $v) {
            $array_escolaridad[$cont]['name'] = $k;
            $array_escolaridad[$cont]['y'] = $v;
            $cont++;
        }

        return $array_escolaridad = json_encode($array_escolaridad);
    }

    ## Construir algoritmo para la gráfica de posiciones de juego
    function posiciones_juego($json_data) {
        $posiciones = array();
        $totalJugadores = 0;
        foreach ($json_data as $jugador) {
            if (!empty($jugador['valores'][4]['value'])) {
                array_push($posiciones, rtrim(strtoupper($jugador['valores'][4]['value'])));
                $totalJugadores++;
            }
        }

        $posiciones = array_count_values($posiciones);

        $cont = 0;
        foreach ($posiciones as $k => $v) {
            $array_posiciones[$cont]['name'] = $k;
            $array_posiciones[$cont]['y'] = round($v / $totalJugadores * 100, 2, PHP_ROUND_HALF_UP);
            $array_posiciones[$cont]['drilldown'] = $k;
            $cont++;
        }

        return $array_posiciones = json_encode($array_posiciones);
    }

    // Grafica de las razas
    function show_razas($json_data) {
        $razas = array();
        $totalJugadores = 0;
        foreach ($json_data as $jugador) {
            if (!empty($jugador['valores'][6]['value'])) {
                array_push($razas, rtrim(strtoupper($jugador['valores'][6]['value'])));
                $totalJugadores++;
            }
        }

        $razas = array_count_values($razas);
        $cont = 0;
        foreach ($razas as $key => $value) {
            $array_razas[$cont]['name'] = $key;
            $array_razas[$cont]['data'] = round($value / $totalJugadores * 100, 2, PHP_ROUND_HALF_UP);
            $cont++;
        }

        return $array_razas = json_encode($array_razas);
    }

    // Grafica lateralidad
    function show_lateralidad($json_data) {
        $lateralidad = array();

        foreach ($json_data as $jugador) {
            if (!empty($jugador['valores'][6]['value'])) {
                array_push($lateralidad, rtrim(strtoupper($jugador['valores'][3]['value'])));
            }
        }

        $lateralidad = array_count_values($lateralidad);

        $cont = 0;
        foreach ($lateralidad as $key => $value) {
            if($key == 'DERECHA') {
                $array_lateralidad[$cont]['name']['DERECHA'] = $value;
            } else {
                $array_lateralidad[$cont]['name'] = $key;
                $array_lateralidad[$cont]['y'] = $value;
            }
            $cont++;
        }

        return $array_lateralidad = json_encode($array_lateralidad);
    }

    // Histograma Edades
    function histogramaEdades($json_data) {
        $edades = array();
        $nombresJugadores = array();

        foreach ($json_data as $jugador) {
            if (!empty($jugador['valores'][2]['value'])) {

                $fechaNacimiento = explode(" ", $jugador['valores'][2]['value']);
                
                $edad = substr($fechaNacimiento[1], 1);

                array_push($edades, $edad);

                $nombreCompleto = $jugador['valores'][0]['value'] . " " . $jugador['valores'][1]['value'];

                array_push($nombresJugadores, $nombreCompleto);
            }
        }

        $array_edades_jugadores[0][] = 'Nombre';
        $array_edades_jugadores[0][] = 'Edad';
        
        for ($x = 0; $x < count($edades); $x++){
            $array_edades_jugadores[$x+1][] = $nombresJugadores[$x];
            $array_edades_jugadores[$x+1][] = intval($edades[$x]);
        }

        return $array_edades_jugadores = json_encode($array_edades_jugadores);
    }

?>