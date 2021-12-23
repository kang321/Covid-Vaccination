<?php

namespace App\Controllers;

use App\Models\VaccineManufacturer;
use mysqli_sql_exception;

class VaccineManufacturerController extends BaseController
{

    public function info($manufacturerName) {
        $db = db_connect();

        $data = [
            'manufacturerName' => $manufacturerName,
            'error' => session()->get("error")
        ];

        try {
            $query = $db->query("SELECT * FROM VaccineManufacturer WHERE manufacturer_name = '{$manufacturerName}'");
            if ($query->getNumRows() === 0) {
                $data['error'] = "Vaccine Manufacturer not found";
            }
            $vaccineManufacturer = $query->getRow(0, VaccineManufacturer::class);
            $data['vaccineManufacturer'] = $vaccineManufacturer;

            $vaccinesQuery = $db->query("SELECT * FROM Vaccine WHERE manufacturer_name = '{$manufacturerName}'");
            if ($vaccinesQuery->getNumRows() > 0) {
                $vaccines = $vaccinesQuery->getResultArray();
                $data['vaccines'] = $vaccines;
            }

            $ordersQuery = $db->query("SELECT * FROM VaccineOrder WHERE manufacturer_name = '{$manufacturerName}'");
            if ($ordersQuery->getNumRows() > 0) {
                $orders = $ordersQuery->getResult();
                $data['orders'] = $orders;
            }
        } catch (mysqli_sql_exception $e) {
            $data['error'] = $e->getMessage();
        }

        return view('VaccineManufacturer/infoView', $data);
    }

    public function addVaccine($manufacturerName)
    {
        $data = [
            'manufacturerName' => $manufacturerName,
            'error' => session()->get("error")
        ];

        return view('VaccineManufacturer/addVaccineView', $data);
    }

    public function addVaccineSubmit()
    {
        if (empty($_POST['manufacturerName'])) {
            return redirect()->back()->with('error', 'Manufacturer name is required')->withInput();
        }

        if (empty($_POST['vaccineName'])) {
            return redirect()->back()->with('error', 'Vaccine name is required')->withInput();
        }

        if (empty($_POST['vaccineType'])) {
            return redirect()->back()->with('error', 'Vaccine type is required')->withInput();
        }

        if (empty($_POST['numberOfShots'])) {
            return redirect()->back()->with('error', 'Number of shots is required')->withInput();
        }

        if (empty($_POST['cooldownDays'])) {
            return redirect()->back()->with('error', 'Cooldown days is required')->withInput();
        }

        $data = [
            'manufacturerName' => $_POST['manufacturerName'],
            'vaccineName' => $_POST['vaccineName'],
            'vaccineType' => $_POST['vaccineType'],
            'numberOfShots' => $_POST['numberOfShots'],
            'cooldownDays' => $_POST['cooldownDays'],
        ];

        $db = db_connect();
        try {
            $db->query("INSERT INTO Vaccine(name, vaccine_type, number_of_shots, cooldown_days, manufacturer_name) 
            VALUES ('{$data["vaccineName"]}', '{$data["vaccineType"]}', {$data["numberOfShots"]}, {$data["cooldownDays"]}, '{$data["manufacturerName"]}')");
        } catch (mysqli_sql_exception $e) {
            return redirect()->back()->with('error', $e->getMessage())->withInput();
        }

        return redirect()->to("/Vaccine/{$_POST['vaccineName']}");
    }

    public function add()
    {
        $data = [
            'error' => session()->get("error")
        ];

        return view('VaccineManufacturer/addView', $data);
    }

    public function addSubmit()
    {
        if (empty($_POST['manufacturerName'])) {
            return redirect()->back()->with('error', 'Manufacturer name is required')->withInput();
        }

        if (empty($_POST['productionVolume'])) {
            return redirect()->back()->with('error', 'Production Volume is required')->withInput();
        }

        if (empty($_POST['productionRate'])) {
            return redirect()->back()->with('error', 'Production Rate is required')->withInput();
        }

        $data = [
            'manufacturerName' => $_POST['manufacturerName'],
            'productionVolume' => $_POST['productionVolume'],
            'productionRate' => $_POST['productionRate'],
        ];

        $db = db_connect();
        try {
            $db->query("INSERT INTO VaccineManufacturer (manufacturer_name, production_volume, production_rate)
            VALUES ('{$data["manufacturerName"]}', {$data["productionVolume"]}, {$data["productionRate"]})");
        } catch (mysqli_sql_exception $e) {
            return redirect()->back()->with('error', $e->getMessage())->withInput();
        }

        
        return redirect()->to("/VaccineManufacturer/{$data["manufacturerName"]}");        
    }

    public function edit($manufacturerName)
    {
        $db = db_connect();

        $data = [];

        try {
            $query = $db->query("SELECT * FROM VaccineManufacturer WHERE manufacturer_name = '{$manufacturerName}'");
            $vaccineManufacturer = $query->getRow(0, VaccineManufacturer::class);
            $data['vaccineManufacturer'] = $vaccineManufacturer;
            $data['error'] = session()->get("error");
        } catch (mysqli_sql_exception $e) {
            $data['error'] = $e->getMessage();
        }

        return view('VaccineManufacturer/editView', $data);
    }

    public function editSubmit()
    {
        if (empty($_POST['manufacturerName'])) {
            return redirect()->back()->with('error', 'Manufacturer Name is required')->withInput();
        }

        if (empty($_POST['productionVolume'])) {
            return redirect()->back()->with('error', 'Production Volume is required')->withInput();
        }

        if (empty($_POST['productionRate'])) {
            return redirect()->back()->with('error', 'Production Rate is required')->withInput();
        }

        $data = [
            'manufacturerName' => $_POST['manufacturerName'],
            'productionVolume' => $_POST['productionVolume'],
            'productionRate' => $_POST['productionRate'],
        ];

        $db = db_connect();
        try {
            $db->query("UPDATE VaccineManufacturer SET 
            manufacturer_name = '{$data["manufacturerName"]}', 
            production_volume = {$data["productionVolume"]}, 
            production_rate = {$data["productionRate"]} 
            WHERE manufacturer_name = '{$data["manufacturerName"]}'");
        } catch (mysqli_sql_exception $e) {
            return redirect()->back()->with('error', $e->getMessage())->withInput();
        }

        return redirect()->to("/VaccineManufacturer/{$data['manufacturerName']}");
    }

    public function delete() {
        if (empty($_POST['manufacturerName'])) {
            return redirect()->back()->with('error', 'Manufacturer Name is required')->withInput();
        }

        $data = [
            'manufacturerName' => $_POST['manufacturerName'],
        ];

        $db = db_connect();
        try {
            $db->query("DELETE FROM VaccineManufacturer WHERE manufacturer_name = '{$data["manufacturerName"]}'");
        } catch (mysqli_sql_exception $e) {
            return redirect()->back()->with('error', $e->getMessage())->withInput();
        }

        return redirect()->to("/");
    }
}
