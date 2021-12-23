<?php

namespace App\Controllers;

use App\Models\VaccineReceiver;
use mysqli_sql_exception;

class VaccineReceiverController extends BaseController
{

    public function info($phn)
    {
        $db = db_connect();

        $data = [];

        try {
            $query = $db->query("SELECT * FROM vacc.VaccineReceiver WHERE phn = {$phn}");
            $vaccineReceiver = $query->getRow(0, VaccineReceiver::class);
            $data['vaccineReceiver'] = $vaccineReceiver;

            if ($query->getNumRows() == 0) {
                throw new mysqli_sql_exception("No vaccine receiver with PHN {$phn}");
            }
        } catch (mysqli_sql_exception $e) {
            $data['error'] = $e->getMessage();
        }

        return view('VaccineReceiver/infoView', $data);
    }

    public function edit($phn)
    {
        $db = db_connect();

        $data = [];

        try {
            $query = $db->query("SELECT * FROM vacc.VaccineReceiver WHERE phn = {$phn}");
            $vaccineReceiver = $query->getRow(0, VaccineReceiver::class);
            $data['vaccineReceiver'] = $vaccineReceiver;
            $data['error'] = session()->get("error");
        } catch (mysqli_sql_exception $e) {
            $data['error'] = $e->getMessage();
        }

        return view('VaccineReceiver/editView', $data);
    }

    public function editSubmit()
    {
        if (empty($_POST['phn'])) {
            return redirect()->back()->with('error', 'PHN is required')->withInput();
        }

        if (empty($_POST['name'])) {
            return redirect()->back()->with('error', 'Name is required')->withInput();
        }

        if (empty($_POST['email'])) {
            return redirect()->back()->with('error', 'Email is required')->withInput();
        }

        if (empty($_POST['pn'])) {
            return redirect()->back()->with('error', 'Phone Number is required')->withInput();
        }

        if (empty($_POST['dob'])) {
            return redirect()->back()->with('error', 'Date of Birth is required')->withInput();
        }

        if (empty($_POST['postalCode'])) {
            return redirect()->back()->with('error', 'Postal Code is required')->withInput();
        }

        $data = [
            'phn' => $_POST['phn'],
            'name' => $_POST['name'],
            'email' => $_POST['email'],
            'pn' => $_POST['pn'],
            'dob' => $_POST['dob'],
            'postalCode' => $_POST['postalCode'],
        ];

        $db = db_connect();
        try {
            $db->query("UPDATE vacc.VaccineReceiver SET 
            name = '{$data["name"]}', 
            email = '{$data["email"]}', 
            phone_number = {$data["pn"]}, 
            date_of_birth = '{$data["dob"]}', 
            postal_code = '{$data["postalCode"]}' 
            WHERE phn = {$data["phn"]}");
        } catch (mysqli_sql_exception $e) {
            return redirect()->back()->with('error', $e->getMessage())->withInput();
        }

        return redirect()->to("/VaccineReceiver/{$data['phn']}");
    }

    public function add()
    {
        $data = [

            'error' => session()->get("error")
        ];

        return view('VaccineReceiver/addView', $data);
    }

    public function addSubmit()
    {
        if (empty($_POST['phn'])) {
            return redirect()->back()->with('error', 'phn is required')->withInput();
        }

        if (empty($_POST['name'])) {
            return redirect()->back()->with('error', 'name is required')->withInput();
        }

        if (empty($_POST['email'])) {
            return redirect()->back()->with('error', 'email is required')->withInput();
        }
        if (empty($_POST['phone_number'])) {
            return redirect()->back()->with('error', 'phone_number is required')->withInput();
        }
        if (empty($_POST['date_of_birth'])) {
            return redirect()->back()->with('error', 'date_of_birth is required')->withInput();
        }
        if (empty($_POST['postal_code'])) {
            return redirect()->back()->with('error', 'postal_code is required')->withInput();
        }



        $data = [
            'phn' => $_POST['phn'],
            'name' => $_POST['name'],
            'email' => $_POST['email'],
            'phone_number' => $_POST['phone_number'],
            'date_of_birth' => $_POST['date_of_birth'],
            'postal_code' => $_POST['postal_code'],

        ];

        $db = db_connect();
        try {
            $db->query("INSERT INTO VaccineReceiver(phn,name,email,phone_number,date_of_birth,postal_code)
            VALUES ('{$data["phn"]}', '{$data["name"]}', '{$data["email"]}', {$data["phone_number"]},'{$data["date_of_birth"]}','{$data["postal_code"]}')");
        } catch (mysqli_sql_exception $e) {
            return redirect()->back()->with('error', $e->getMessage())->withInput();
        }

        return redirect()->to("/VaccineReceiver/{$_POST['phn']}");
    }
}
