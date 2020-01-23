<?php

    function open_connection() {
        $link = mysqli_connect("127.0.0.1", "root", "");
        if($link === false){
            echo("ERROR: Could not connect. " . mysqli_connect_error());
        }
        return $link;
    }

    function close_connection($link) {
        mysqli_close($link);
    }
?>