<?php
    $host = "localhost";
    $user = "root";
    $password = "dede1006";
    $database = "data_user";

    $koneksi = new mysqli($host, $user, $password, $database);

    if ($koneksi->connect_error){
        die("Koneksi Gagal: ".$koneksi->connect_error);
    }
?>
