<!DOCTYPE html>
<html>
<head>
    <title>@yield('title', "Nofaro - Início")</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @section('styles')
        <link rel="stylesheet" type="text/css" href="{{ mix('/css/app.css') }}">
        <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    @show
</head>
<body>
    <div class="container">
        @yield('content')
        @if (session('danger'))
            @foreach(session('danger') as $msg)
                <div class="alert alert-danger col-sm-12">
                    {{ $msg }}
                </div>
            @endforeach
        @endif
        @if (session('success'))
            @foreach(session('success') as $msg)
                <div class="alert alert-success col-sm-12">
                    {{ $msg }}
                </div>
            @endforeach
        @endif
    </div>

    @include('modal');

    @section('scripts')
        <script type="text/javascript" src="{{ mix('/js/app.js') }}"></script>
    @show
</body>
</html>