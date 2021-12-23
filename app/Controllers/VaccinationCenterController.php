<?php

namespace App\Controllers;

use App\Models\VaccinationAppointment;
use App\Models\VaccinationRecord;
use App\Models\VaccinationCenter;
use mysqli_sql_exception;

class VaccinationCenterController extends BaseController
{

    public function info($centerId)
    {
        $db = db_connect();

        $data = [
            'centerId' => $centerId,
        ];

        try {
            $query = $db->query("SELECT * FROM VaccinationCenter WHERE center_id = {$centerId}");
            if ($query->getNumRows() === 0) {
                $data['error'] = "Vaccination Center not found";
            }
            $vaccinationCenter = $query->getRow(0, VaccinationCenter::class);
            $data['vaccinationCenter'] = $vaccinationCenter;

            $inventoriesQuery = $db->query("SELECT * FROM VaccinationCenterInventoriesVaccine WHERE center_id = {$centerId}");
            if ($inventoriesQuery->getNumRows() > 0) {
                $inventories = $inventoriesQuery->getResult();
                $data['inventories'] = $inventories;
            }

            $ordersQuery = $db->query("SELECT * FROM VaccineOrder WHERE center_id = {$centerId}");
            if ($ordersQuery->getNumRows() > 0) {
                $orders = $ordersQuery->getResult();
                $data['orders'] = $orders;
            }

            $appointmentQuery = $db->query("SELECT * FROM VaccinationAppointment WHERE center_id = {$centerId}");
            if ($appointmentQuery->getNumRows() > 0) {
                $appointments = $appointmentQuery->getResult();
                $data['appointments'] = $appointments;
            }
        } catch (mysqli_sql_exception $e) {
            $data['error'] = $e->getMessage();
        }

        return view('VaccinationCenter/infoView', $data);
    }



    public function appointmentInfo($centerId, $appointmentId)
    {
        $db = db_connect();

        $data = [
            'centerId' => $centerId,
            'appointmentId' => $appointmentId,
        ];

        try {
            $query = $db->query("SELECT * FROM VaccinationAppointment WHERE center_id = {$centerId} AND appointment_id = {$appointmentId}");
            if ($query->getNumRows() === 0) {
                $data['error'] = "Appointment not found";
            }
            $vaccinationAppointment = $query->getRow(0, VaccinationAppointment::class);
            $data['vaccinationAppointment'] = $vaccinationAppointment;

            $centerQuery = $db->query("SELECT * FROM VaccinationCenter WHERE center_id = {$centerId}");
            $center = $centerQuery->getRow(0, VaccinationCenter::class);
            $data['centerName'] = $center->getName();
            $data['centerAddress'] = $center->getFullAddress();

            $vaccinationQuery = $db->query("SELECT * FROM VaccineRecieverGetsShotVaccine WHERE center_id = {$centerId} AND appointment_id = {$appointmentId}");
            if ($vaccinationQuery->getNumRows() > 0) {
                $vaccinationRecord = $vaccinationQuery->getRow(0, VaccinationRecord::class);
                $data['vaccineName'] = $vaccinationRecord->getVaccineName();
                $data['vaccineShotTime'] = $vaccinationRecord->getShotTime();
                $data['vaccineHealthWorkerPHN'] = $vaccinationRecord->getHealthWorkerPHN();
            }
        } catch (mysqli_sql_exception $e) {
            $data['error'] = $e->getMessage();
        }

        return view('VaccinationCenter/appointmentInfoView', $data);
    }

    public function schedule($centerId)
    {
        $data = [
            'centerId' => $centerId,
            'error' => session()->get("error")
        ];

        return view('VaccinationCenter/scheduleView', $data);
    }

    public function scheduleSubmit()
    {
        if (empty($_POST['centerId'])) {
            return redirect()->back()->with('error', 'Center ID is required')->withInput();
        }

        if (empty($_POST['phn'])) {
            return redirect()->back()->with('error', 'PHN is required')->withInput();
        }

        if (empty($_POST['date'])) {
            return redirect()->back()->with('error', 'Date is required')->withInput();
        }

        $data = [
            'centerId' => $_POST['centerId'],
            'phn' => $_POST['phn'],
            'date' => $_POST['date'],
        ];

        $db = db_connect();
        try {
            $currentAppointmentQuery = $db->query("SELECT * FROM VaccinationAppointment WHERE (receiver_phn = {$data["phn"]} AND current = 1)");
            if ($currentAppointmentQuery->getNumRows()) {
                $currentAppointmentDate = $currentAppointmentQuery->getRow(0)->date;
                if (strtotime($currentAppointmentDate) > strtotime('now')) {
                    return redirect()->back()->with('error', 'You already have an appointment')->withInput();
                }

                $db->query("UPDATE VaccinationAppointment SET current = 0 WHERE receiver_phn = {$data["phn"]}");
            }

            $idQuery = $db->query("SELECT max(appointment_id) as maxId FROM VaccinationAppointment WHERE center_id = {$data["centerId"]}");
            $data['appointmentId'] = $idQuery->getRow(0)->maxId + 1;

            $db->query("INSERT INTO VaccinationAppointment(appointment_id, center_id, date, current, receiver_phn)
            VALUES ({$data["appointmentId"]}, {$data["centerId"]}, '{$data["date"]}', 1, {$data["phn"]})");
        } catch (mysqli_sql_exception $e) {
            return redirect()->back()->with('error', $e->getMessage())->withInput();
        }

        return redirect()->to("/VaccinationCenter/{$data["centerId"]}/appointment/{$data["appointmentId"]}");
    }

    public function record($centerId, $appointmentId)
    {
        $data = [
            'centerId' => $centerId,
            'appointmentId' => $appointmentId,
            'error' => session()->get("error")
        ];

        return view('VaccinationCenter/recordView', $data);
    }

    public function recordSubmit()
    {
        if (empty($_POST['centerId'])) {
            return redirect()->back()->with('error', 'Center ID is required')->withInput();
        }

        if (empty($_POST['appointmentId'])) {
            return redirect()->back()->with('error', 'Appointment ID is required')->withInput();
        }

        if (empty($_POST['healthWorkerPHN'])) {
            return redirect()->back()->with('error', 'Health Worker PHN is required')->withInput();
        }

        if (empty($_POST['vaccineName'])) {
            return redirect()->back()->with('error', 'Vaccine Name is required')->withInput();
        }

        if (empty($_POST['shotTime'])) {
            return redirect()->back()->with('error', 'Shot time is required')->withInput();
        }

        $data = [
            'centerId' => $_POST['centerId'],
            'appointmentId' => $_POST['appointmentId'],
            'healthWorkerPHN' => $_POST['healthWorkerPHN'],
            'vaccineName' => $_POST['vaccineName'],
            'shotTime' => $_POST['shotTime'],
        ];

        $db = db_connect();
        try {
            $appointmentQuery = $db->query("SELECT receiver_phn as receiverPhn, current FROM VaccinationAppointment WHERE (appointment_id = {$data["appointmentId"]} AND center_id = {$data['centerId']})");
            if ($appointmentQuery->getNumRows() == 0) {
                return redirect()->back()->with('error', 'Appointment not found')->withInput();
            }

            $appointmentVaccReceiverPhn = $appointmentQuery->getRow(0)->receiverPhn;

            if (!$appointmentQuery->getRow(0)->current) {
                return redirect()->back()->with('error', 'Illegal appointment, the appointment is not current')->withInput();
            }

            $inventoryQuery = $db->query("SELECT * FROM VaccinationCenterInventoriesVaccine WHERE center_id = {$data['centerId']} AND vaccine_name = '{$data['vaccineName']}'");
            if ($inventoryQuery->getNumRows() === 0 || $inventoryQuery->getRow(0)->amount < 1) {
                return redirect()->back()->with('error', 'Vaccine is not in the inventory')->withInput();
            }

            $db->query("INSERT INTO VaccineRecieverGetsShotVaccine(receiver_phn, vaccine_name, shot_time, healthWorker_phn, appointment_id, center_id)
            VALUES ({$appointmentVaccReceiverPhn}, '{$data['vaccineName']}', '{$data['shotTime']}', {$data['healthWorkerPHN']}, {$data['appointmentId']}, {$data['centerId']})");

            $db->query("UPDATE VaccinationAppointment SET current = 0 WHERE (appointment_id = {$data["appointmentId"]} AND center_id = {$data['centerId']})");

            $db->query("UPDATE VaccinationCenterInventoriesVaccine SET amount = amount - 1 WHERE center_id = {$data['centerId']} AND vaccine_name = '{$data['vaccineName']}'");
        } catch (mysqli_sql_exception $e) {
            return redirect()->back()->with('error', $e->getMessage())->withInput();
        }

        return redirect()->to("/VaccinationCenter/{$data["centerId"]}/appointment/{$data["appointmentId"]}");
    }

    public function add()
    {
        $data = [
            'error' => session()->get("error")
        ];

        return view('VaccinationCenter/addView', $data);
    }

    public function addSubmit()
    {
        if (empty($_POST['centerId'])) {
            return redirect()->back()->with('error', 'Center Id is required')->withInput();
        }

        if (empty($_POST['centerName'])) {
            return redirect()->back()->with('error', 'Center Name is required')->withInput();
        }

        if (empty($_POST['centerAddress'])) {
            return redirect()->back()->with('error', 'Center Address is required')->withInput();
        }

        if (empty($_POST['postalCode'])) {
            return redirect()->back()->with('error', 'Postal Code is required')->withInput();
        }

        if (empty($_POST['centerState'])) {
            return redirect()->back()->with('error', 'Center State is required')->withInput();
        }

        $data = [
            'centerId' => $_POST['centerId'],
            'centerName' => $_POST['centerName'],
            'centerAddress' => $_POST['centerAddress'],
            'postalCode' => $_POST['postalCode'],
            'centerState' => $_POST['centerState'],
        ];

        $db = db_connect();
        try {
            $db->query("INSERT INTO VaccinationCenter (center_id, name, address, postal_code, state)
            VALUES ({$data["centerId"]}, '{$data["centerName"]}', '{$data["centerAddress"]}', '{$data["postalCode"]}', '{$data["centerState"]}')");
        } catch (mysqli_sql_exception $e) {
            return redirect()->back()->with('error', $e->getMessage())->withInput();
        }


        return redirect()->to("/VaccinationCenter/{$data['centerId']}");
    }

    public function edit($centerId)
    {
        $db = db_connect();

        $data = [];

        try {
            $query = $db->query("SELECT * FROM VaccinationCenter WHERE center_id = {$centerId}");
            $vaccinationCenter = $query->getRow(0, VaccinationCenter::class);
            $data['vaccinationCenter'] = $vaccinationCenter;
            $data['error'] = session()->get("error");
        } catch (mysqli_sql_exception $e) {
            $data['error'] = $e->getMessage();
        }

    return view('VaccinationCenter/editView', $data);
    }

    public function editSubmit()
    {
        if (empty($_POST['centerId'])) {
            return redirect()->back()->with('error', 'Center Id is required')->withInput();
        }

        if (empty($_POST['centerName'])) {
            return redirect()->back()->with('error', 'Center Name is required')->withInput();
        }

        if (empty($_POST['centerAddress'])) {
            return redirect()->back()->with('error', 'Center Address is required')->withInput();
        }

        if (empty($_POST['postalCode'])) {
            return redirect()->back()->with('error', 'Postal Code is required')->withInput();
        }

        if (empty($_POST['centerState'])) {
            return redirect()->back()->with('error', 'Center State is required')->withInput();
        }

        $data = [
            'centerId' => $_POST['centerId'],
            'centerName' => $_POST['centerName'],
            'centerAddress' => $_POST['centerAddress'],
            'postalCode' => $_POST['postalCode'],
            'centerState' => $_POST['centerState'],
        ];

        $db = db_connect();
        try {
            $db->query("UPDATE VaccinationCenter SET 
            name = '{$data["centerName"]}', 
            address = '{$data["centerAddress"]}', 
            postal_code = '{$data["postalCode"]}', 
            state = '{$data["centerState"]}' 
            WHERE center_id = '{$data["centerId"]}'");
        } catch (mysqli_sql_exception $e) {
            return redirect()->back()->with('error', $e->getMessage())->withInput();
        }

        return redirect()->to("/VaccinationCenter/{$data['centerId']}");
    }

    public function cancel($centerId, $appointmentId)
    {
        $db = db_connect();

        $data = [
            'centerId' => $centerId,
            'appointmentId' => $appointmentId,
            'error' => session()->get("error")
        ];

        try {
            $query = $db->query("SELECT * FROM VaccinationAppointment WHERE center_id = {$data["centerId"]} AND appointment_id = {$data["appointmentId"]}");
            if ($query->getNumRows() === 0) {
                $data['error'] = "Appointment not found";
            }
            $vaccinationAppointment = $query->getRow(0, VaccinationAppointment::class);
            $data['vaccinationAppointment'] = $vaccinationAppointment;

            $data['error'] = session()->get("error");
        } catch (mysqli_sql_exception $e) {
            $data['error'] = $e->getMessage();
        }

        return view('VaccinationCenter/cancelView', $data);
    }

    public function cancelSubmit()
    {
        if (empty($_POST['centerId'])) {
            return redirect()->back()->with('error', 'Center Id is required')->withInput();
        }

        if (empty($_POST['appointmentId'])) {
            return redirect()->back()->with('error', 'Appointment Id is required')->withInput();
        }

        if (empty($_POST['date'])) {
            return redirect()->back()->with('error', 'Appointment Date is required')->withInput();
        }

        if (empty($_POST['phn'])) {
            return redirect()->back()->with('error', 'Personal Health Number is required')->withInput();
        }

        $data = [
            'centerId' => $_POST['centerId'],
            'appointmentId' => $_POST['appointmentId'],
            'date' => $_POST['date'],
            'phn' => $_POST['phn']
        ];

        $db = db_connect();
        try {
            $query = $db->query("SELECT COUNT(*) as count FROM VaccineRecieverGetsShotVaccine WHERE (appointment_id = {$data['appointmentId']} AND center_id = {$data['centerId']})");
            $isVaccinated = $query->getRowArray(0)['count'];
            if (!!!$isVaccinated) {
                $db->query("DELETE FROM VaccinationAppointment WHERE center_id = {$data["centerId"]} AND appointment_id = {$data["appointmentId"]}");
            } else {
                throw new mysqli_sql_exception("Can't cancel an appointment that already took place");
            }
        } catch (mysqli_sql_exception $e) {
            return redirect()->back()->with('error', $e->getMessage())->withInput();
        }

        return view('VaccinationCenter/cancelInfoView', $data);
    }
    
}
