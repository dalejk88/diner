<?php
// 328/diner/index.php
// This is my controller

// Turn on error reporting
ini_set('display_errors', 1);
error_reporting(E_ALL);

// Require the autoload file
require_once ('vendor/autoload.php');

// Instantiate the F3 Base class
$f3 = Base::instance();

// Define a default route
$f3->route('GET /', function() {
    // Render a view page
    $view = new Template();
    echo $view->render('views/home.html');
});

// Define a breakfast-menu route
$f3->route('GET /menus/breakfast', function() {
    // Render a view page
    $view = new Template();
    echo $view->render('views/breakfast-menu.html');
});

// Define a lunch-menu route
$f3->route('GET /menus/lunch', function() {
    // Render a view page
    $view = new Template();
    echo $view->render('views/lunch-menu.html');
});

// Define a dinner-menu route
$f3->route('GET /menus/dinner', function() {
    // Render a view page
    $view = new Template();
    echo $view->render('views/dinner-menu.html');
});

// Run Fat-Free
$f3->run();