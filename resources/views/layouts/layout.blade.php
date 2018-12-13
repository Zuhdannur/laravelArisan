<html lang="en">

<head>
    <meta charset="utf-8"/>
    <link rel="apple-touch-icon" sizes="76x76" href="{{asset('assets')}}/img/apple-icon.png">
    <link rel="icon" type="image/png" href="{{asset('assets')}}/img/favicon.png">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/>
    <title>
        Derazu
    </title>
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no'
          name='viewport'/>
    <!--     Fonts and icons     -->
    <link rel="stylesheet" type="text/css"
          href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons"/>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css">
    <!-- CSS Files -->
    <link href="{{asset('assets')}}/css/material-dashboard.css?v=2.1.1" rel="stylesheet"/>
</head>
<body>

    @include('partials.nav')

    @include('partials.sidebar')
    <div class="main-panel">
        @yield('content')
    </div>

<script src="{{asset('assets')}}/js/core/jquery.min.js"></script>
<script src="{{asset('assets')}}/js/core/popper.min.js"></script>
<script src="{{asset('assets')}}/js/core/bootstrap-material-design.min.js"></script>
<script src="{{asset('assets')}}/js/plugins/perfect-scrollbar.jquery.min.js"></script>
<!-- Plugin for the momentJs  -->
<script src="{{asset('assets')}}/js/plugins/moment.min.js"></script>
<!--  Plugin for Sweet Alert -->
<script src="{{asset('assets')}}/js/plugins/sweetalert2.js"></script>
@stack('extras-js')
</body>
</html>
