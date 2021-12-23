<?php

namespace App\Controllers;

use Config\View;
use Exception;
use mysqli_sql_exception;

class SideEffectController extends BaseController
{
    public function add()
    {
        $data = [
            'error' => session()->get("error")
        ];

        return view('SideEffect/addView', $data);
    }

    public function addSubmit()
    {
        if (empty($_POST['body_part'])) {
            return redirect()->back()->with('error', 'body part is required')->withInput();
        }

        if (empty($_POST['complaint'])) {
            return redirect()->back()->with('error', 'complaint is required')->withInput();
        }

        $data = [
            'body_part' => $_POST['body_part'],
            'complaint' => $_POST['complaint'],
        ];

        $db = db_connect();
        try {
            $db->query("INSERT INTO SideEffect(body_part,complaint)
                       VALUES ('{$data["body_part"]}', '{$data["complaint"]}')");
        } catch (mysqli_sql_exception $e) {
            return redirect()->back()->with('error', $e->getMessage())->withInput();
        }

        return redirect()->to("/SideEffect/{$_POST["body_part"]}/{$_POST["complaint"]}");
    }

    public function info($body_part, $complaint)
    {
        $data = [
            'body_part' => $body_part,
            'complaint' => $complaint,
        ];

        return view("SideEffect/infoView", $data);
    }
}
