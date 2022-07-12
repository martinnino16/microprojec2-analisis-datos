<?php 
    function getWhatPlot($configs) {
        $what_plot = array();
        foreach ($configs as $config) {
            $var = explode("|", $config[0]);
            $plot = array();
            foreach ($var as $v){
                $var2 = explode(",", $v);
                array_push($plot, $var2[0]);
            }
            array_push($what_plot, $plot);
        }
        return $what_plot;
    }

    function getHowPlot($configs) {
        //print_r($configs);
        $how_plot = array();
        foreach ($configs as $config) {
            $var = explode("|", $config[0]);
            $plot = array();
            foreach ($var as $v){
                $var2 = explode(",", $v);
                array_push($plot, $var2[1]);
            }
            array_push($how_plot, $plot);
        }
        return $how_plot;
    }

    function getGraphNames($configs) {
        $graph_names = array();
        foreach ($configs as $config) {
            $var = explode("|", $config[1]);
            $titles = array();
            foreach ($var as $v){
                $var2 = explode(",", $v);
                array_push($titles, $var2[0]);
            }
            array_push($graph_names, $titles);
        }
        return $graph_names;
    }

    function getGrids($configs) {
        $grids = array();
        foreach ($configs as $config) {
            array_push($grids, $config[2]);
        }
        return $grids;
    }

    function getRoundedCorners($configs) {
        $rounded_corners = array();
        foreach ($configs as $config) {
            $var = explode("|", $config[3]);
            $corners = array();
            foreach ($var as $v){
                array_push($corners, $v);
            }
            array_push($rounded_corners, $corners);
        }
        return $rounded_corners;
    }
    
    function getGraphTable($configs) {
        $graph_table = array();
        foreach ($configs as $config) {
            $var = explode("|", $config[4]);
            $table_spaces = array();
            foreach ($var as $v){
                array_push($table_spaces, $v);
            }
            array_push($graph_table, $table_spaces);
        }
        return $graph_table;
    }

    function getDataResolution($configs) {
        $data_resolution = array();
        foreach ($configs as $config) {
            $var = explode("|", $config[5]);
            $resolution = array();
            foreach ($var as $v){
                array_push($resolution, $v);
            }
            array_push($data_resolution, $resolution);
        }
        return $data_resolution;
    }

    function getTabs($configs) {
        $tabs = array();
        foreach ($configs as $config) {
            array_push($tabs, $config[6]);
        }
        return $tabs;
    }
    
    function getPopup($configs) {
        $popup = array();
        foreach ($configs as $config) {
            array_push($popup, $config[7]);
        }
        return $popup;
    }
?>