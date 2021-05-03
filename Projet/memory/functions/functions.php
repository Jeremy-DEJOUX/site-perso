<?php
    function prp($input, ?string $name = null) {
        echo '<pre>';
        echo '|==========  ';
        // echo isset($name) ? $name . ':<br>' : null . '<br>' . "\n";
        echo isset($name) ? $name : null;
        echo '  ==========|';
        echo '<br>' . "\n";
        print_r($input);
        echo '</pre>', "\n";
    }

    function vdp($input, ?string $name = null) {
        echo '<pre>';
        echo '|==========  ';
        // echo isset($name) ? $name . ':<br>' : null . '<br>' . "\n";
        echo isset($name) ? $name : null;
        echo '  ==========|';
        echo '<br>' . "\n";
        var_dump($input);
        echo '</pre>', "\n";
    }