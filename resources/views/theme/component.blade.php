<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="shortcut icon" href="{{ asset('theme/images/logo.jpg') }}">
        <title>JobXpress{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <!-- Bootstrap CSS CDN -->
        <link href="{{ asset('theme/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css">
        
        <!-- icons CSS -->
        <link href="{{ asset('theme/css/icons.min.css') }}" rel="stylesheet" type="text/css">

        <!-- Our Custom CSS -->
        <link href="{{ asset('theme/css/style.css') }}" rel="stylesheet" type="text/css">

        @livewireStyles

    </head>
    <body>
        <!-- jQuery -->
        <script type="text/javascript" src="{{ asset('theme/js/jquery-3.4.1.min.js') }}"></script>
        
        <!-- Popper.JS for Bootstrap Dropdown-->
        <script type="text/javascript" src="{{ asset('theme/js/popper.min.js') }}"></script>
        <!-- Bootstrap JS -->
        <script type="text/javascript" src="{{ asset('theme/js/bootstrap.min.js') }}"></script>
        
        @include('theme.header') 
        
        <div id="system_content">
            @if (session()->has('alert_message'))
            <div class="alert alert-{{ session()->has('alert_type')?session('alert_type'):'success'}} alert-dismissible fade show" role="alert">
                {!! session('alert_message') !!}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            
            @endif
            {{ $slot }}
            
        </div>

        @stack('modals')
        
        @livewireScripts
        
        @yield('jsInline')
    </body>
</html>
