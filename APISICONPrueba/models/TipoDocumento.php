<?php

namespace ApiSICON;

use Phalcon\Mvc\Model;
use Phalcon\Mvc\Model\Message;
use Phalcon\Validation;
use Phalcon\Validation\Validator\Uniqueness;
use Phalcon\Validation\Validator\InclusionIn;


class tipodocumento extends Model
{
    public $id;
    
    public $descripcion;

}