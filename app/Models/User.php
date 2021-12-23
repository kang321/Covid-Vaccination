<?php

namespace App\Models;

abstract class User
{
    protected $phn;
    protected $name;
    protected $email;

    function getPHN() {
        return $this->phn;
    }

    function getName() {
        return $this->name;
    }

    function getEmail() {
        return $this->email;
    }
}