<?php
    // $bdd = new PDO('mysql:host=localhost;dbname=reservationsalles;charset=utf8', 'root', '');
if (!function_exists('get_pdo')) {
    function get_pdo(): PDO {
        return new PDO('mysql:host=localhost;dbname=reservationsalles;charset=utf8', 'root', '', [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
        ]);
    }
}
?>