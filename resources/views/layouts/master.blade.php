<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        
        <title>AIMS - {{ $title }}</title>
        <meta name="description" content="{{$description or 'Alliance Internal Market System'}}">
        <meta content="AIMS - {{ $title }}" property="og:title">
        <meta content="{{$description or 'Alliance Internal Market System'}}" property="og:description">
        <meta content="AIMS" property="og:site_name">

        <!-- Fonts -->
        <link href="{{asset("css/app.css")}}" rel="stylesheet" type="text/css">
        {{$head or ''}}
    </head>
    <body>
        <div id="app">
            {{ $slot }}
        </div>
        <script src="{{asset("js/app.js")}}"></script>
    </body>
</html>