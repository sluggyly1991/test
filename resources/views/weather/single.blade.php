<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Kontaktbuch</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">


    <style>
        body {
            font-family: 'Nunito', sans-serif;
        }
    </style>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
</head>

<body class="antialiased">
    <div class="container">
        <table class="table table-striped mt-5">
            <tbody>
                <tr>
                    <td></td>
                    <td><img src="https://www.weatherbit.io/static/img/icons/{{ $weather['weather']['icon'] }}.png"><br>
                    {{ $weather['weather']['description'] }}
                    </td>
                </tr>
                <tr>
                    <td>Temperatur</td>
                    <td>{{ $weather['temp'] }} &deg;C</td>
                </tr>
                <tr>
                    <td>Gefühlte Temperatur</td>
                    <td>{{ $weather['app_temp'] }} &deg;C</td>
                </tr>
                <tr>
                    <td>Wind</td>
                    <td>{{ $weather['wind_spd'] }} km/h aus {{ $weather['wind_cdir'] }}
                        ({{ $weather['wind_cdir_full'] }})</td>
                </tr>
                <tr>
                    <td>Stadt</td>
                    <td>{{ $weather['city_name'] }}</td>
                </tr>
            </tbody>
        </table>
    </div>

<div class="fixed-bottom m-3">
        <div class="row">
            <div class="col-3">
                <a href="{{ route('contacts.show') }}" class="btn btn-primary">Zur Übersicht</a>
            </div>
        </div>
    </div>

</body>

</html>
