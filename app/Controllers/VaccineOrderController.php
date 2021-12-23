<?php

namespace App\Controllers;

use mysqli_sql_exception;

class VaccineOrderController extends BaseController
{
    public function order()
    {
        $data = [
            'error' => session()->get("error")
        ];

        return view('VaccineOrder/orderView', $data);
    }

    public function orderSubmit()
    {
        if (empty($_POST['order_id'])) {
            return redirect()->back()->with('error', 'order_id is required')->withInput();
        }

        if (empty($_POST['manufacturername'])) {
            return redirect()->back()->with('error', 'manufacturername is required')->withInput();
        }

        if (empty($_POST['center_id'])) {
            return redirect()->back()->with('error', 'center id is required')->withInput();
        }

        if (empty($_POST['order_amount'])) {
            return redirect()->back()->with('error', 'order amount is required')->withInput();
        }
        
        if (empty($_POST['order_date'])) {
            return redirect()->back()->with('error', 'order date is required')->withInput();
        }

        if (empty($_POST['vaccine_name'])) {
            return redirect()->back()->with('error', 'vaccine name is required')->withInput();
        }

        $data = [
            'order_id' => $_POST['order_id'],
            'manufacturername' => $_POST['manufacturername'],
            'center_id' => $_POST['center_id'],
            'order_amount' => $_POST['order_amount'],
            'order_date' => $_POST['order_date'],
            'vaccine_name' => $_POST['vaccine_name'],

        ];

        $db = db_connect();
        try {
            $db->query("INSERT INTO VaccineOrder(order_id,manufacturer_name,center_id,order_amount,order_date,vaccine_name)
             VALUES ({$data["order_id"]}, '{$data["manufacturername"]}', {$data["center_id"]}, {$data["order_amount"]},'{$data["order_date"]}','{$data["vaccine_name"]}')");
        } catch (mysqli_sql_exception $e) {
            return redirect()->back()->with('error', $e->getMessage())->withInput();
        }

        return redirect()->to("/VaccineOrder/{$_POST["order_id"]}/{$_POST["manufacturername"]}");
    }



    public function info($manufacturerName, $orderId)
    {
        $data = [
            'orderId' => $orderId,
            'manufacturerName' => $manufacturerName,
        ];

        return view("VaccineOrder/infoView", $data);
    }
}
