<?php

namespace App\Models;

class VaccinationAppointment
{
    private $center_id;
    private $appointment_id;
    private $date;
    private $current;
    private $receiver_phn;

    function getCenterId() {
        return $this->center_id;
    }

    function getAppointmentId() {
        return $this->appointment_id;
    }

    function getDate() {
        return $this->date;
    }

    function getCurrent() {
        return $this->current;
    }

    function getReceiverPhn() {
        return $this->receiver_phn;
    }
}