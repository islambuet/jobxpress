<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="shortcut icon" href="{{ asset('theme/images/logo.jpg') }}">
        <title>{{ config('app.name', 'Laravel') }}</title>

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
        
        
        <!-- Bootstrap JS -->
        <script type="text/javascript" src="{{ asset('theme/js/bootstrap.min.js') }}"></script>
        
        <header id="system_top_bar" class="d-print-none">
            <!-- LOGO -->
            <h3>JobXpress</h3>
            <div class="row">
                <form action="{{ url('/search-job') }}" method="POST" class="col-md-6 col-8">
                    @csrf
                    <div class="input-group">
                        <input type="text" name="serachJob" class="form-control" placeholder="Search..">
                        <div class="input-group-append">
                          <button class="input-group-text" type="submit">Go!</button>
                        </div>
                      </div>
                </form>
                <div class="col-md-6 col-4">
                    <a href="{{ url('/post-job') }}" class="btn btn-primary float-right">Post a Job</a>
                </div>
                
            </div>
        </header>
        
        <div id="system_content">
            @if (session()->has('alert_message'))
            <div class="alert alert-{{ session()->has('alert_type')?session('alert_type'):'success'}} alert-dismissible fade show" role="alert">
                {{ session('alert_message') }}
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