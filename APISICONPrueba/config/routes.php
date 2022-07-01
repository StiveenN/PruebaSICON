<?php 

use Phalcon\Mvc\Router;

$router = $di->getRouter();

$app->post('/api/CreaPersona', 'CreaPersona');
$app->put('/api/EditaPersona/{id:[0-9]+}', 'EditaPersona');
$app->delete('/api/EliminarPersona/{id:[0-9]+}', 'EliminarPersona');
$app->get('/api/Login/{email}/{contrasena}', 'Login');
$app->get('/api/ConsultaPersonas/{tipodoc:[0-9]+}/{sexo:[0-9]+}/{depart:[0-9]+}/{munici:[0-9]+}','ConsultaPersonas');
$app->get('/api/ConsultaTipoDocumento','ConsultaTipoDocumento');
$app->get('/api/ConsultaSexo','ConsultaSexo');
$app->get('/api/ConsultaDepartamento','ConsultaDepartamento');
$app->get('/api/ConsultaMunicipioPorIdDepart/{idDepart}','ConsultaMunicipioPorIdDepart');
$app->notFound('notFound');

$router->handle();
