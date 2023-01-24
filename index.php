<?php

// Controller file

// Turn on error reporting
ini_set('display_errors', 1);
// Error reporting level
error_reporting(E_ALL);

// Require autoload file
require_once('vendor/autoload.php');

//Insantiate F3 Base class
$f3 = Base::instance();

// Define a default route (328/diner)
$f3->route('GET /', function(){
    // Instantiate a view
    $view = new Template();
    echo $view->render("views/diner-home.html");
});

// Define a breakfast route (328/diner/breakfast)
$f3->route('GET /breakfast', function(){
    // Instantiate a view
    $view = new Template();
    echo $view->render("views/breakfast.html");
});

// Define a lunch route (328/diner/lunch)
$f3->route('GET /lunch', function(){
    // Instantiate a view
    $view = new Template();
    echo $view->render("views/lunch.html");
});

// Run Fat Free
$f3->run();