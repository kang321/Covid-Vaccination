<?php

namespace App\Models;

class Vaccinecenter
{
     private $center_id;
    private $name;
    private $address;
    private $postal_code;
    private $state;


    function getcenter_id() {
        return $this->center_id;
    }

    function getname() {
        return $this->name;
    }

    function getaddress() {
        return $this->address;
    }

    function getpostalcode() {
            return $this->postal_code;
        }

        function getstate() {
                    return $this->state;
                }
}