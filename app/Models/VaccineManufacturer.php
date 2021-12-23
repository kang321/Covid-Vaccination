<?php

namespace App\Models;

class VaccineManufacturer
{

    private $manufacturer_name;
    private $production_volume;
    private $production_rate;

    function getManufacturerName() {
        return $this->manufacturer_name;
    }
    
    function getProductionVolume() {
        return $this->production_volume;
    }

    function getProductionRate() {
        return $this->production_rate;
    }
}