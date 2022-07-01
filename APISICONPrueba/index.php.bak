<?php

// Instantiate the class responsible for implementing a micro application
$app = new \Phalcon\Mvc\Micro();

// Routes
$app->get('/say/date', 'currentDate');
$app->get('/say/hello/{name}', 'greeting');
$app->notFound('notFound');

// Handlers
function currentDate() {
  echo date('Y-m-d');
}

function greeting($name) {
  $response = array("greeting" => "Hello $name");
  echo json_encode($response);
}

function notFound() {
    // Access to the global var $app
    global $app;
    
    $app->response->setStatusCode(404, "Not Found")->sendHeaders();
    echo 'Oops, Not Found!!';
}

// Handle the request
$app->handle();

?>