<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Airport;

class FlightAPI extends Controller
{
    public function LoadPage(){
        $selected = Airport::where('ICAO', 'LSGG')->first();

        $destinationsAirports = array();

        $now = time();

        $begin = date('Y-m-d', strtotime('-11 day', $now));
        $begin = new \DateTime($begin);
        $begin = $begin->getTimestamp();

        $end = date('Y-m-d', strtotime('-10 day', $now));
        $end = new \DateTime($end);
        $end = $end->getTimestamp();


        $url = 'https://opensky-network.org/api/flights/departure?airport=LSGG&begin='.$begin.'&end='.$end;

        $json = file_get_contents($url);
        $flights = json_decode($json);

        foreach($flights as $flight){
            array_push($destinationsAirports, Airport::where('ICAO', $flight->estArrivalAirport)->first());
        }

        $data = array($selected, $flights, $destinationsAirports);

        return view('apitest', compact('data'));
    }

    public function loadFlights(Request $request,$icao){
        return view('airport.flights',compact('icao'));
    }
}
