<?php
if (!function_exists('open_connection')) { 

    function open_connection(){
        $connect = mysqli_connect('localhost', 'root','', 'netflix');
        if (!$connect){
            die("Database Connection Failed". mysqli_connect_error());
        }
        else {
            return $connect;
        }
    }
}
?>