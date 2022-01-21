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

if (!function_exists('e404')) {
function e404() {
    echo "Error 404";
}
}

if (!function_exists('dd')) {
function dd(...$vars) {
    foreach($vars as $var) {
        echo '<pre>';
        var_dump($var);
        echo '</pre>';
    }
}
}

if (!function_exists('h')) {
function h(?string $value): string {
    if ($value === null) {
        return '';
    }
    return htmlentities($value);
}
}
?>