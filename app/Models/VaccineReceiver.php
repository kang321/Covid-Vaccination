<?php

namespace App\Models;

class VaccineReceiver extends User
{
    private $phone_number;
    private $date_of_birth;
    private $postal_code;

    function getPhoneNumber() {
        return $this->phone_number;
    }

    function getDateOfBirth() {
        return $this->date_of_birth;
    }

    function getPostalCode() {
        return $this->postal_code;
    }
}