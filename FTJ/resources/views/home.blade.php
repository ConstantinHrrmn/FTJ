@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-4">
                <select name="airport" id="airport" class="form-control">
                    <option value="GVA">Geneva Cointrin International Airport</option>
                </select>
            </div>
            <div class="col-5 offset-3">
                <div class="card">
                    <div class="card-header font-weight-bold">Geneva Cointrin International Airport</div>
                    <div class="card-body">
                        <h5 class="font-weight-bold">Identification</h5>
                        <div class="row">
                            <div class="col-6">ICAO</div>
                            <div class="col-6">LSGG</div>
                        </div>
                        <div class="row">
                            <div class="col-6">IATA</div>
                            <div class="col-6">GVA</div>
                        </div>
                        <div class="row">
                            <div class="col-6">GPS Code</div>
                            <div class="col-6">LSGG</div>
                        </div>
                        <br>
                        <h5 class="font-weight-bold">Location</h5>
                        <div class="row">
                            <div class="col-6">Continent</div>
                            <div class="col-6">EU</div>
                        </div>
                        <div class="row">
                            <div class="col-6">Country</div>
                            <div class="col-6">CH</div>
                        </div>
                        <div class="row">
                            <div class="col-6">Region</div>
                            <div class="col-6">CH-GE</div>
                        </div>
                        <div class="row">
                            <div class="col-6">Municipality</div>
                            <div class="col-6">Geneva</div>
                        </div>
                        <div class="row">
                            <div class="col-6">City</div>
                            <div class="col-6">-</div>
                        </div>
                        <div class="row">
                            <div class="col-6">Continent</div>
                            <div class="col-6">EU</div>
                        </div>
                        <div class="row">
                            <div class="col-6">Latitude</div>
                            <div class="col-6">46.23809814453125</div>
                        </div>
                        <div class="row">
                            <div class="col-6">Longitude</div>
                            <div class="col-6">6.108950138092041</div>
                        </div>
                        <div class="row">
                            <div class="col-6">Geom. Altitude</div>
                            <div class="col-6">1411ft (430m)</div>
                        </div>
                        <br>
                        <h5 class="font-weight-bold">Details</h5>
                        <div class="row">
                            <div class="col-6">Homepage</div>
                            <div class="col-6"><a href="http://www.gva.ch" target="_blank">gva.ch</a></div>
                        </div>
                        <div class="row">
                            <div class="col-6">Wikipedia</div>
                            <div class="col-6"><a href="https://en.wikipedia.org/wiki/Geneva_Airport" target="_blank">en.wikipedia.org</a></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-5 offset-7">
                <a href="{{route('airport.flights','LSGG')}}" class="btn btn-outline-primary form-control">See Departures/Arrivals</a>
            </div>
        </div>
    </div>
@endsection
