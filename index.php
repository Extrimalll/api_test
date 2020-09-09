<?php
include("header.php");

$route = $_GET['route'] ?? '';
$isRouteFound = false;
if (!empty($route == 'contacts')) {
        $isRouteFound = true;
}

if (!$isRouteFound) {
    echo '<div class="alert alert-danger mt-2 ml-2 mr-2">
                    Страница не найдена!
                </div>';
    return;
}

if(!empty($_GET['phone']))
    include_once 'actions/read.php';
else
    include_once 'actions/create.php';


include_once 'main.php';
