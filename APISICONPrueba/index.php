<?php

use Phalcon\Loader;
use Phalcon\Mvc\Micro;
use Phalcon\Http\Response;
use Phalcon\Http\Request;
try
{

$loader = new Loader();
$loader->registerNamespaces(
    [
        'Store\Toys' => __DIR__ . '/models/',
        'ApiSICON' => __DIR__ . '/models/',
    ]
);
$loader->register();
$di = $di = require __DIR__ . '/config/di.php';
$app = new Micro($di);
require __DIR__ . '/config/routes.php';

function EliminarPersona($id){
  global $app;   
  
  $phql = 'DELETE FROM ApiSICON\Persona  WHERE id = :id:';
  $status = $app->modelsManager->executeQuery(
      $phql,
      [        
          'id' => $id,         
      ]
  );
  $response = new Response();
  $DataResult = "";
  if ($status->success() === true) {
     $DataResult = "Registro eliminado ok";
      $response->setStatusCode(201, 'Eliminado');
      $response->setJsonContent(['estado'=> true,'error'=> false,'data' => $DataResult,]);
  } else {
      $DataResult = "Error al eliminar registro";
      $response->setStatusCode(409, 'Conflicto');
      $errors = [];
      foreach ($status->getMessages() as $message) {
          $errors[] = $message->getMessage();
      }
      $response->setJsonContent(['estado'=> false,'error'=> true,'data' => $DataResult,]
      );
  }
  return $response;
}


function EditaPersona($id){
  global $app;   
  $persona = $app->request->getJsonRawBody();
   //echo $persona->nombres1;
  $phql = 'UPDATE  ApiSICON\Persona SET  nombres = :nombres:, apellidos = :apellidos:, sexo = :sexo:, departamento =:departamento: , municipio = :municipio:, email = :email:, contrasena = :contrasena: WHERE id = :id:';
  $status = $app->modelsManager->executeQuery(
      $phql,
      [        
          'id' => $id, 
          'nombres' => $persona->nombres1,
          'apellidos' => $persona->apellidos1,
          'sexo' => $persona->sexo1,
          'departamento' => $persona->departamento1,
          'municipio' => $persona->municipio1,
          'email' => $persona->email1,
          'contrasena' => $persona->contrasena1,
      ]
  );
  $response = new Response();

  if ($status->success() === true) {
      $response->setStatusCode(201, 'Editado');
      $response->setJsonContent(['estado'=> true,'error'=> false,'data' => $persona,]);
  } else {
      $response->setStatusCode(409, 'Conflicto');
      $errors = [];
      foreach ($status->getMessages() as $message) {
          $errors[] = $message->getMessage();
      }
      $response->setJsonContent(['estado'=> false,'error'=> true,'data' => $errors,]
      );
  }
  return $response;
}

function CreaPersona(){
  global $app;   
  $persona = $app->request->getJsonRawBody();
   //echo $persona->documento1;
  $phql = 'INSERT INTO ApiSICON\Persona (tipodocumento , documento , nombres ,apellidos ,sexo , departamento , municipio, email, contrasena ) VALUES (:tipodocumento:, :documento:, :nombres:,:apellidos:,:sexo:,:departamento:,:municipio:,:email:,:contrasena:)';

  $status = $app->modelsManager->executeQuery(
      $phql,
      [
          'tipodocumento' => $persona->tipoDocumento1,
          'documento' => $persona->documento1,
          'nombres' => $persona->nombres1,
          'apellidos' => $persona->apellidos1,
          'sexo' => $persona->sexo1,
          'departamento' => $persona->departamento1,
          'municipio' => $persona->municipio1,
          'email' => $persona->email1,
          'contrasena' => $persona->contrasena1
      ]
  );
  $response = new Response();

  if ($status->success() === true) {
      $response->setStatusCode(201, 'Creado');
      $persona->id = $status->getModel()->id;
      $response->setJsonContent(['estado'   => true,'error'   => false,'data' => $persona,]);
  } else {
      $response->setStatusCode(409, 'Conflicto');
      $errors = [];
      foreach ($status->getMessages() as $message) {
          $errors[] = $message->getMessage();
      }
      $response->setJsonContent(['estado'=> false,'error'=> true,'data' => $errors,]
      );
  }
  return $response;
}

function ConsultaPersonas ($tipodoc,$sexo,$depart,$munici) {
  global $app;   
        $sql = 'SELECT * FROM  ApiSICON\v_persona_data where id > 0 ';
        //echo $sql;
        if($tipodoc <> 0){
          $sql =$sql. ' and tipodocumento = '.$tipodoc.' ';          
        }
        if($sexo <> 0){
          $sql = $sql. ' and sexo = '.$sexo.' ' ;         
        }    
        if($depart <> 0){
          $sql = $sql. ' and departamento = '.$depart.' ' ;
        }
        if($munici <> 0){
          $sql = $sql. ' and municipio = '.$munici.' ' ;
        }        
        $phql = $sql;
        $personas = $app->modelsManager->executeQuery($phql);
        $returnData = [];
        foreach ($personas as $persona) {
            $returnData[] = [
                'id'   => $persona->id,
                'nombres' => $persona->nombres,
                'apellidos' => $persona->apellidos,
                'sexo' => $persona->des_sexo,
                'departamento' => $persona->des_depart,
                'municipio' => $persona->des_munici,
            ];
        }
        $app->response->setStatusCode(200, 'OK');
        $app->response->setJsonContent(["estado" => true, "error" => false, "data" => $returnData ]);
        $app->response->send();  
}

function Login($email,$contrasena) {
  global $app;       
        $phql = 'SELECT * FROM  ApiSICON\Persona where email = :email: and contrasena = :contrasena:';       
        $usuario = $app->modelsManager->executeQuery($phql,
        [
            'email' => $email,
            'contrasena' => $contrasena,
        ]
    )->getFirst();     
        $returnData = "";
        if ($usuario === false) {
          $returnData = "Usuario o contrasena incorrectos";
          $app->response->setStatusCode(401, 'OK');
          $app->response->setJsonContent(["estado" => false, "error" => true, "data" => $returnData ]);
          $app->response->send();
      } else {
        $returnData = "Usuario logueado ok";
          $app->response->setStatusCode(200, 'OK');
          $app->response->setJsonContent(["estado" => true, "error" => false, "data" => $returnData ]);
          $app->response->send();
      }                
}

function ConsultaSexo() {
  global $app;   
  $phql = 'SELECT * FROM  ApiSICON\sexo  ORDER BY id_sexo';
  $sexos = $app->modelsManager->executeQuery($phql);
  $returnData = [];
  foreach ($sexos as $sexo) {
      $returnData[] = [
          'id_sexo'   => $sexo->id_sexo,
          'descripcion' => $sexo->descripcion,
      ];
  }
  $app->response->setStatusCode(200, 'OK');
  $app->response->setJsonContent(["estado" => true, "error" => false, "data" => $returnData ]);
  $app->response->send();
}

function ConsultaTipoDocumento() {
  global $app;   
  $phql = 'SELECT * FROM  ApiSICON\tipodocumento  ORDER BY id_tipo_doc';
  $departamentos = $app->modelsManager->executeQuery($phql);
  $returnData = [];
  foreach ($departamentos as $departamento) {
      $returnData[] = [
          'id_tipo_doc'   => $departamento->id_tipo_doc,
          'descripcion' => $departamento->descripcion,
      ];
  }
  $app->response->setStatusCode(200, 'OK');
  $app->response->setJsonContent(["estado" => true, "error" => false, "data" => $returnData ]);
  $app->response->send();
}

function ConsultaDepartamento() {
  global $app;   
  $phql = 'SELECT * FROM  ApiSICON\Departamento  ORDER BY descripcion';
  $departamentos = $app->modelsManager->executeQuery($phql);
  $returnData = [];
  foreach ($departamentos as $departamento) {
      $returnData[] = [
          'id_depart'   => $departamento->id_depart,
          'descripcion_depart' => $departamento->descripcion,
      ];
  }
  $app->response->setStatusCode(200, 'OK');
  $app->response->setJsonContent(["estado" => true, "error" => false, "data" => $returnData ]);
  $app->response->send();
}

function ConsultaMunicipioPorIdDepart($iddepart) {
  global $app;   
  $phql = 'SELECT * FROM  ApiSICON\Municipio where id_depart = '.$iddepart.' order by id_munici';
  $Municipios = $app->modelsManager->executeQuery($phql); 
  $returnData = [];
  foreach ($Municipios as $municipio) {
      $returnData[] = [
          'id_muni'   => $municipio->id_munici,
          'descripcion_muni' => $municipio->descripcion,
      ];
  }
  $app->response->setStatusCode(200, 'OK');
  $app->response->setJsonContent(["estado" => true, "error" => false, "data" => $returnData ]);
  $app->response->send();
}

function notFound() {
    global $app;
    
    $app->response->setStatusCode(404, "Not Found")->sendHeaders();
    echo 'Oops, Not Found!!';
}

$app->handle();
} 
catch (Exception $e){
  echo $e;
}
?>