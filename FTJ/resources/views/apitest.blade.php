<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Nunito', sans-serif;
                font-weight: 200;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 84px;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 13px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }

            
        </style>
    </head>
    <body>
        <!-- flex-center position-ref full-height -->
        <div class="">

            <!-- table table-dark -->
            <div class="content">
                <div>
                    <table class="">
                        <th>Flight number</th>
                        <th>Departure Airport</th>
                        <th>city / country</th>
                        <th>Destination Airport</th>
                        <th>city / country</th>
                        <th>Distance</th>
                        <th>Duration</th>
                        <th>Plane</th>
                        <th>Consumption</th>
                    @php $i = 0; @endphp
                    @foreach($data[1] as $flight)
                        @if($flight->estArrivalAirport != null)
                            <tr>
                                <td>{{$flight->callsign}}</td>
                                <td>{{$data[0]->name}}</td>
                                <td>{{$data[0]->city}} / {{$data[0]->country}}</td>
                                <td>{{$data[2][$i]["name"]}}</td>
                                <td>{{$data[2][$i]["city"]}} / {{$data[2][$i]["country"]}}</td>
                                <td>{{$data[3][$i]}} km</td>
                                <td>{{$data[5][$i]}}</td>
                                <td>{{$data[4][$i]['model']}} </td>
                                <td>{{$data[6][$i]}} kg</td>
                                @php $i++; @endphp
                            </tr>
                        @endif
                        @if($i == 150)
                            @break
                        @endif
                    @endforeach
                    </table>
                </div>
            </div>         
        </div>
    </body>
</html>
