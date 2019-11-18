<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Airport;
use App\Plane;
use App\fuel;

class FlightAPI extends Controller
{
    private function GetFlightDistance($lat1, $lon1, $lat2, $lon2){
        $lon1 = floatval($lon1);
        $lat1 = floatval($lat1);

        $lon2 = floatval($lon2);
        $lat2 = floatval($lat2);

        // distance between latitudes 
        // and longitudes 
        $dLat = ($lat2 - $lat1) * M_PI / 180.0; 
        $dLon = ($lon2 - $lon1) *  M_PI / 180.0; 

        // convert to radians 
        $lat1 = ($lat1) * M_PI / 180.0; 
        $lat2 = ($lat2) * M_PI / 180.0; 

        // apply formulae 
        $a = pow(sin($dLat / 2), 2) + pow(sin($dLon / 2), 2) * cos($lat1) * cos($lat2); 
        $rad = 6371; 

        $c = 2 * asin(sqrt($a)); 
        $result = round($rad * $c); 

        //var_dump($result);

        return $result;
    }

    private function GetPlane($icao24){
        $plane = Plane::where('icao24', $icao24)->first();
        return $plane;
    }

    private function GetFlightTime($begin, $end){
        $seconds = $end-$begin; 
        $output = sprintf('%02d:%02d:%02d', ($seconds/ 3600),($seconds/ 60 % 60), $seconds% 60);
        return $output;
    }

    private function GetFuelConsumption($aircraft){
        $exploded = explode(" ", $aircraft);
        $search = "";
        
        if(count($exploded) > 1){
            $search = $exploded[1];
        }else{
            $search = $exploded[0];
        }

       
        $exploded2 = explode("-",$search);
        $raw = 'Aircraft LIKE \'%'.$exploded2[0].'%\'';
        $kgh = fuel::whereRaw('Aircraft LIKE \'%?%\'', [$exploded2[0]])->first();
        var_dump($kgh);
       
    }
    
    public function LoadPage(){
        $selected = Airport::where('ICAO', 'LSGG')->first();

        $destinationsAirports = array();
        $flightDistances = array();
        $planes = array();
        $flighttimes = array();

        $now = time();

        $begin = date('Y-m-d', strtotime('-11 day', $now));
        $begin = new \DateTime($begin);
        $begin = $begin->getTimestamp();

        $end = date('Y-m-d', strtotime('-10 day', $now));
        $end = new \DateTime($end);
        $end = $end->getTimestamp();


        $url = 'https://opensky-network.org/api/flights/departure?airport=LSGG&begin='.$begin.'&end='.$end;
        //dd($url);

        $json = file_get_contents($url);
        $flights = json_decode($json);
        $i = 0;

        foreach($flights as $flight){
            $arrival = Airport::where('ICAO', $flight->estArrivalAirport)->first();
            array_push($destinationsAirports, $arrival);
            array_push($flightDistances,$this->GetFlightDistance($selected['latitude'], $selected['longitude'], $arrival['latitude'],$arrival['longitude']));
            $plane = $this->GetPlane($flight->icao24);
            array_push($planes,$plane);
            array_push($flighttimes,  $this->GetFlightTime($flight->firstSeen, $flight->lastSeen));
            $this->GetFuelConsumption($plane['model']);

            $i++;
            if($i >= 150){
                break;
            }
        }

        $data = array($selected, $flights, $destinationsAirports, $flightDistances,$planes, $flighttimes);

        return view('apitest', compact('data'));
    }



    public function loadFlights(Request $request,$icao){
        return view('airport.flights',compact('icao'));
    }
}
