<?php

namespace App\Models;

class VaccinationRecord
{

    private $receiver_phn;
    private $vaccine_name;
    private $shot_time;
    private $healthWorker_phn;
    private $appointment_id;
    private $center_id;

    function getReceiverPHN() {
        return $this->receiver_phn;
    }

    function getVaccineName() {
        return $this->vaccine_name;
    }

    function getShotTime() {
        return $this->shot_time;
    }

    function getHealthWorkerPHN() {
        return $this->healthWorker_phn;
    }

    function getAppointmentId() {
        return $this->appointment_id;
    }

    function getCenterId() {
        return $this->center_id;
    }
}