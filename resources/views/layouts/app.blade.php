<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    @vite('resources/css/app.css')
    
    @livewireStyles
    
    <title>{{ env('APP_NAME') }}}</title>
</head>

<body>
    @yield('content')

    @livewireScripts

    @if(env('APP_DEBUG'))
        @dsAutoClearOnPageReload
    @endif
</body>

</html>