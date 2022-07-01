<?php

namespace ApiSICON;

use Phalcon\Mvc\Model;
use Phalcon\Mvc\Model\Message;
use Phalcon\Validation;
use Phalcon\Validation\Validator\Uniqueness;
use Phalcon\Validation\Validator\InclusionIn;


class Municipio extends Model
{
    public $id;

    public $id_depart;
    
    public $descripcion;

}