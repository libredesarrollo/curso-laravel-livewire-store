<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Contacto</title>

    <link rel="stylesheet" href="{{ mix("css/app.css") }}">
    <script src="{{ mix('js/app.js') }}" defer></script>
    @livewireStyles

</head>
<body>
    
<div class="container">
    {{ $slot }}
</div>

    @livewireScripts

</body>
</html>