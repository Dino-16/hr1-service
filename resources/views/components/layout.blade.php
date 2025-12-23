<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">

        {{-- Site title --}}
        <link rel="icon" type="image/png" href="{{ asset('images/jetlouge_logo.png') }}">
        <title>Jetlouge Travels</title>

        {{-- Styles | Scripts --}}
        @vite(['resources/css/app.css', 'resources/js/app.js'])

    </head>
    <body class="min-vh-100">

        {{ $slot }}

    </body>
</html>