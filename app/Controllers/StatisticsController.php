<?php

namespace App\Controllers;

use App\Models\VaccinationCenter;
use mysqli_sql_exception;

class StatisticsController extends BaseController
{
    public function info()
    {
        $data = [
            'error' => session()->get("error")
        ];

        return $this->_renderInfo($data);
    }

    public function vaccinationCenterSearchSubmit()
    {
        if (empty($_POST['vaccineName'])) {
            return redirect()->back()->with('error', 'Vaccine Name is required')->withInput();
        }

        $data = [
            'vaccineName' => $_POST['vaccineName'],
        ];

        $db = db_connect();
        try {
            $query = $db->query("SELECT VaccinationCenter.center_id, 
            VaccinationCenter.name, 
            VaccinationCenter.address, 
            VaccinationCenter.postal_code, 
            VaccinationCenter.state, 
            VaccinationCenterInventoriesVaccine.amount 
            FROM VaccinationCenter INNER JOIN VaccinationCenterInventoriesVaccine 
            ON (VaccinationCenterInventoriesVaccine.vaccine_name = '{$data["vaccineName"]}' AND VaccinationCenter.center_id = VaccinationCenterInventoriesVaccine.center_id);");

            $vaccinationCenters = $query->getResult(VaccinationCenter::class);
            $data['vaccinationCenters'] = $vaccinationCenters;
        } catch (mysqli_sql_exception $e) {
            return redirect()->back()->with('error', $e->getMessage())->withInput();
        }


        return $this->_renderInfo($data);
    }

    private function _renderInfo($data)
    {

        $db = db_connect();

        try {
            $query = $db->query("SELECT COUNT(vaccine_name) as count, vaccine_name
            FROM VaccineRecieverGetsShotVaccine
            GROUP BY vaccine_name
            ORDER BY COUNT(vaccine_name) DESC");
            $vaccineCounts = $query->getResult();
            $data['vaccineCounts'] = $vaccineCounts;

            $lastMonthDate = date('Y-m-d h:m:s', strtotime('-1 month'));
            $orderCountQuery = $db->query("SELECT MAX(order_amount) as amount, order_date
            FROM VaccineOrder
            GROUP BY order_date
            HAVING order_date > '{$lastMonthDate}'
            ORDER BY amount DESC LIMIT 10");
            $orderCounts = $orderCountQuery->getResult();
            $data['orderCounts'] = $orderCounts;

            $fullyVaccinatedsQuery = $db->query("SELECT receiver_phn, vaccine_name
            FROM VaccineRecieverGetsShotVaccine
            GROUP BY receiver_phn, vaccine_name
            HAVING COUNT(*) = (SELECT  number_of_shots 
                FROM    Vaccine
                WHERE   Vaccine.name = vaccine_name)");
            $fullyVaccinateds = $fullyVaccinatedsQuery->getResult();
            $data['fullyVaccinateds'] = $fullyVaccinateds;

            $vaccCenterHasAllVaccinesQuery = $db->query("SELECT * FROM VaccinationCenter
            WHERE NOT EXISTS (
                SELECT Vaccine.name from Vaccine
                WHERE NOT EXISTS (
                SELECT VaccinationCenterInventoriesVaccine.vaccine_name FROM VaccinationCenterInventoriesVaccine 
                WHERE (VaccinationCenter.center_id = VaccinationCenterInventoriesVaccine.center_id AND Vaccine.name = VaccinationCenterInventoriesVaccine.vaccine_name)
                )
            )");
            $vaccCenterHasAllVaccines = $vaccCenterHasAllVaccinesQuery->getResult(VaccinationCenter::class);
            $data['vaccCenterHasAllVaccines'] = $vaccCenterHasAllVaccines;
        } catch (mysqli_sql_exception $e) {
            $data['error'] = $e->getMessage();
        }

        return view('Statistics/infoView', $data);
    }
}
