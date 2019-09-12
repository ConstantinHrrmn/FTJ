<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Airport;

class FlightAPI extends Controller
{
    public function LoadPage(){
        $selected = Airport::where('ICAO', 'LSGG')->first();
        
        $end = time();
        $begin = date('Y-m-d H:i:s', strtotime('+1 day', $end));

        var_dump(time());

        $json = file_get_contents('https://opensky-network.org/api/flights/departure?airport=LSGG&begin='.$begin.'&end='.$end);
        $flights = json_decode($json);

        $data = array($selected, $flights);

        return view('apitest', compact('data'));
    }
}
