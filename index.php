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

// Order form part 1
$f3->route('GET|POST /order1', function($f3) {
    if ($_SERVER['REQUEST_METHOD'] == "POST") {
        echo "<p>you got here using POST</p>";

        // Get the data from the POST array
        $food = $_POST['food'];
        $meal = $_POST['meal'];


        // If the data is valid
        if (true) {
            $f3->set('SESSION.food', $food);
            $f3->set('SESSION.meal', $meal);
        }
    } else {
        echo "<p>you got here using GET</p>";
    }
    $view = new Template();
    echo $view->render('views/order1.html');
});

// Order form part 2
$f3->route('GET|POST /order2', function() {
    // Render a view page
    $view = new Template();
    echo $view->render('views/order2.html');
});

// Run Fat-Free
$f3->run();