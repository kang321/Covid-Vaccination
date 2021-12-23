<?php

namespace App\Models;

class VaccinationCenter
{
    private $center_id;
    private $name;
    private $address;
    private $postal_code;
    private $state;

    function getCenterId() {
        return $this->center_id;
    }

    function getName() {
        return $this->name;
    }

    function getAddress() {
        return $this->address;
    }

    function getPostalCode() {
        return $this->postal_code;
    }

    function getState() {
        return $this->state;
    }

    function getFullAddress() {
        return $this->address . ", " . $this->postal_code . ", " . $this->state;
    }
}