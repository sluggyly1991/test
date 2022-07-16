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
        <table class="table table-striped">
            <thead>
                <tr>
                    @foreach ($fields as $field => $label)
                        <td>{{ $label }}</td>
                    @endforeach
                    <td>Optionen</td>
                </tr>
            </thead>
            <tbody>
                @foreach ($contacts as $contact)
                    <tr>
                        @foreach ($fields as $field => $label)
                            <td>{{ $contact->{$field} }}</td>
                        @endforeach
                        <td><a href="{{ route('weather.show.single', $contact->id) }}">aktuelles Wetter</a></td>
                    </tr>
                @endforeach
            </tbody </table>
    </div>

    <div class="fixed-bottom m-3">
        <div class="row">
            <div class="col-3">
                <a href="{{ route('contacts.add') }}" class="btn btn-primary">Neu hinzufügen</a>
            </div>
        </div>
    </div>
</body>

</html>
