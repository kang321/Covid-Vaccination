<?php

namespace App\Controllers;

use mysqli_sql_exception;

class VaccineController extends BaseController
{
    public function info($vaccineName)
    {
        $db = db_connect();
        $data = [
            'vaccineName' => $vaccineName,
        ];
        
        try {
            $query = $db->query("SELECT * FROM Vaccine WHERE name = '{$vaccineName}'");
            if ($query->getNumRows() === 0) {
                $data['error'] = "Vaccine not found";
            }
            
            $vaccine = $query->getRowArray(0);
            $data['vaccine'] = $vaccine;

            $sideEffectsQuery = $db->query("SELECT * FROM VaccineHasSideEffect WHERE vaccine_name = '{$vaccineName}'");
            if ($sideEffectsQuery->getNumRows() > 0) {
                $sideEffects = $sideEffectsQuery->getResultArray();
                $data['sideEffects'] = $sideEffects;
            }
        } catch (mysqli_sql_exception $e) {
            $data['error'] = $e->getMessage();
        }

        return view('Vaccine/infoView', $data);
    }
}
