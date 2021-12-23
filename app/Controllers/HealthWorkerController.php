<?php

namespace App\Controllers;

use Config\View;
use Exception;
use mysqli_sql_exception;

class HealthWorkerController extends BaseController
{
    public function add()
    {
        $data = [
            'error' => session()->get("error")
        ];

        return view('HealthWorker/addView', $data);
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


        $data = [
            'phn' => $_POST['phn'],
            'name' => $_POST['name'],
            'email' => $_POST['email'],
        ];

        $db = db_connect();
        try {
            $db->query("INSERT INTO HealthWorker(phn,name,email) 
            VALUES ('{$data["phn"]}', '{$data["name"]}', '{$data["email"]}')");
        } catch (mysqli_sql_exception $e) {
            return redirect()->back()->with('error', $e->getMessage())->withInput();
        }

        return redirect()->to("/HealthWorker/{$_POST['phn']}");
    }



    public function info($phn)
    {
        $data = [
            'phn' => $phn
        ];

        return view("HealthWorker/infoview", $data);
    }
}
