<?php

namespace ApiSICON;

use Phalcon\Mvc\Model;
use Phalcon\Mvc\Model\Message;
use Phalcon\Validation;
use Phalcon\Validation\Validator\Uniqueness;
use Phalcon\Validation\Validator\InclusionIn;


class v_persona_data extends Model
{
    public $id;
    
    public $tipoDocumento;

    public $documento;

    public $nombres;

    public $apellidos;

    public $sexo;

    public $departamento;

    public $municipio;

    public $email;

    public $contrasena;
 

}