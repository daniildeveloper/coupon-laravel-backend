<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title')</title>

    <!-- Styles -->
    <link href="/css/app.css" rel="stylesheet">
    <link rel="stylesheet" href="{{asset("css/font-awesome.min.css")}}">

    <!-- Scripts -->
    <script>
        window.Laravel = <?php echo json_encode([
    'csrfToken' => csrf_token(),
]); ?>
    </script>
</head>
<body>
    @include('layouts.header')

    {{-- alert --}}
    @if(isset($alert))
        <div class="container">
            <div class="alert alert-{{ isset($alertContext) ? $alertContext : 'warning' }} alert-dismissible" role="alert">
              <button type="button" class="close" data-dismiss="alert" aria-label="Закрыть"><span aria-hidden="true">&times;</span></button>
              <strong>{{ isset($alertStrong) ? $alertStrong : '' }}</strong> {!! $alert !!}
            </div>
        </div>
    @endif
    {{-- end alert --}}

    {{-- All content goes here --}}
    <main>
        @yield('content')
    </main>
    {{-- end content --}}

    {{-- page footer. creds, app download link --}}
    @include('layouts.footer')

    <!-- Scripts -->
    <script src="{{asset("js/jquery.js")}}">
    </script>
    <script src="{{asset("js/boostrap.min.js")}}">
    </script>
    <script src="{{asset("js/countdown.min.js")}}">
    </script>
    <script src="{{asset("js/flexnav.min.js")}}">
    </script>
    <script src="{{asset("js/magnific.js")}}">
    </script>
    <script src="{{asset("js/tweet.min.js")}}">
    </script>
    <script src="https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false">
    </script>
    <script src="{{asset("js/fitvids.min.js")}}">
    </script>
    <script src="{{asset("js/mail.min.js")}}">
    </script>
    <script src="{{asset("js/ionrangeslider.js")}}">
    </script>
    <script src="{{asset("js/icheck.js")}}">
    </script>
    <script src="{{asset("js/fotorama.js")}}">
    </script>
    <script src="{{asset("js/card-payment.js")}}">
    </script>
    <script src="{{asset("js/owl-carousel.js")}}">
    </script>
    <script src="{{asset("js/masonry.js")}}">
    </script>
    <script src="{{asset("js/nicescroll.js")}}">
    </script>
    <script src="{{asset("js/custom.js")}}">
    </script>
    <script src="{{asset("js/simple.js")}}"></script>
    @yield('scripts')
</body>
</html>
