<?php
// 328/diner/index.php
// This is my controller

// Turn on error reporting
ini_set('display_errors', 1);
error_reporting(E_ALL);

// Require the necessary files
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
    $food = "";
    $meal = "";

    if ($_SERVER['REQUEST_METHOD'] == "POST") {
        echo "<p>you got here using POST</p>";

        // Get the data from the POST array
        if (Validate::validFood($_POST['food'])){
            $food = $_POST['food'];
        } else {
            $f3->set('errors["food"]', 'Please enter a food');
        }
        if (isset($_POST['meal']) and Validate::validMeal($_POST['meal'])){
            $meal = $_POST['meal'];
        } else {
            $meal = "Lunch";
        }

        $meal = isset($_POST['meal']) ? $_POST["meal"] : "";

        // Add the data to the session array
        $order = new Order($food, $meal);
        $f3->set('SESSION.order', $order);

        // If there are no errors, send the user to the next form
        if (empty($f3->get('errors'))) {
            $f3->reroute("order2");
        }
    }

    $meals = DataLayer::getMeals();
    $f3->set('meals', $meals);

    $view = new Template();
    echo $view->render('views/order1.html');
});

// Order form part 2
$f3->route('GET|POST /order2', function($f3) {
    if ($_SERVER['REQUEST_METHOD'] == "POST") {
        if (isset($_POST["conds"])) {
            $condiments = implode($_POST["conds"]);
        }
        if (true) {
            $f3->get('SESSION.order')->setCondiments($condiments);

            // Send the user to the next page
            $f3->reroute("order-summary");
        }
    } else {

    }
    $condiments = DataLayer::getCondiments();
    $f3->set('condiments', $condiments);
    
    // Render a view page
    $view = new Template();
    echo $view->render('views/order2.html');
});

// Define an order-summary route
$f3->route('GET /order-summary', function($f3) {
    // Render a view page
    $view = new Template();
    echo $view->render('views/order-summary.html');
    session_destroy();
});


// Run Fat-Free
$f3->run();