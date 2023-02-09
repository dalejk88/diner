<?php

// Controller file

// Turn on error reporting
ini_set('display_errors', 1);
// Error reporting level
error_reporting(E_ALL);

// Start a session
session_start();

// Require autoload file
require_once('vendor/autoload.php');
require_once('model/data-layer.php');
//var_dump(getMeals());

//Instantiate F3 Base class
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

// Define a order1 route (328/diner/order1)
$f3->route('GET /order1', function($f3){
    // If the form has been submitted
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        // Uncomment while testing
            // var_dump($_POST);

        // Move data from POST array to SESSION array
        $_SESSION['food'] = $_POST['food'];
        $_SESSION['meal'] = $_POST['meal'];

        // Redirect to summary page
        $f3->reroute('order2');
    }

    //Add meals to F3 hive
    $f3->set('meals', getmeals());

    // Instantiate a view
    $view = new Template();
    echo $view->render("views/order-form1.html");
});

// Define a order1 route (328/diner/order2)
$f3->route('GET|POST /order2', function($f3){
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $_SESSION['condiments']=implode(", ", $_POST['condiments']);
        $f3->reroute('summary');
    }

    //Add meals to F3 hive
    $f3->set('condiments', getcondiments());

    // Instantiate a view
    $view = new Template();
    echo $view->render("views/order-form2.html");
});

// Run Fat Free
$f3->run();