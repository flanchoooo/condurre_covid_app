<?php

namespace App\Http\Controllers;

use App\CompanyAdmin;
use App\Visit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class VisitController extends Controller
{
    public function getAverageTemperature()
    {

        $company = CompanyAdmin::whereEmail(Auth::user()->email)->first();


        $dates =  DB::connection('mysql2')
            ->select(DB::raw("SELECT DATE(created_date) as 'day',
                                AVG(temperature) as 'temp'
                                FROM visit 
                                WHERE company_id = :company_id
                                GROUP BY DATE(created_date)"), array('company_id' => $company->company_id));
        $new_data = [];
        foreach ($dates as $date){
            array_push($new_data,[$date->day=>$date->temp]);
        }

        $merged = call_user_func_array('array_merge', $new_data);

        return $merged;




    }
    public function getVisitCount()
    {

        $company = CompanyAdmin::whereEmail(Auth::user()->email)->first();

        $dates =  DB::connection('mysql2')
            ->select(DB::raw("SELECT DATE(created_date) as 'day',
                                COUNT(temperature) as 'count'
                                FROM visit 
                                WHERE company_id = :company_id
                                GROUP BY DATE(created_date)"), array('company_id' => $company->company_id));
        $new_data = [];
        foreach ($dates as $date){
            array_push($new_data,[$date->day=>$date->count]);
        }

        $merged = call_user_func_array('array_merge', $new_data);
        return $merged;




    }

}
