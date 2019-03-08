<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('assets') }}/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('assets') }}/css/bootstrap.css">
    <link rel="stylesheet" href="{{ asset('assets') }}/css/custom.css">
    <script src="{{ asset('assets') }}/js/plugin/webfont/webfont.min.js"></script>
    <script>
        WebFont.load({
            google: {"families": ["Lato:300,400,700,900"]},
            custom: {
                "families": ["Flaticon", "Font Awesome 5 Solid", "Font Awesome 5 Regular", "Font Awesome 5 Brands", "simple-line-icons"],
                urls: ['{{ asset('assets') }}/css/fonts.min.css']
            },
            active: function () {
                sessionStorage.fonts = true;
            }
        });
    </script>
    <title>Welcome To SikuAPP</title>
    <style>
        @font-face {
            font-family: 'Montserrat', sans-serif;
            src: url('https://fonts.googleapis.com/css?family=Montserrat');
        }

        .title {
            font-family: "Montserrat";
            font-size: 1.7rem;
        }

        body {
            margin: 0;
        }
    </style>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-dark text-white">
    <a class="navbar-brand text-white" style="margin-left: 5%;" href="#">SikuAPP</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText"
            aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarText">
        <div class="col-lg-12 col-md-6">
            <div class="d-flex justify-content-end">
                <div class="p-2"><a class="btn btn-success text-white navbar-text nav-link" href="{{ route('login') }}">
                        <i class="fa fa-user"></i>&nbsp;&nbsp;Login
                    </a></div>
            </div>
        </div>
    </div>
</nav>
<div class="jumbotron jumbotron-fluid bg-dark">
    <div class="container-fluid text-white">
        <div class="d-flex bd-highlight mb-3">
            <div class="w-50"></div>
            <div class="mr-auto p-1 w-100">
                <p class="display-4 text-white">Siku app</p>
                <p class="lead text-gray">
                    <small class="text-muted">Dapat Kan Kemudahan Dengan Siku App Aplikasi Yang Dapat Mempermudah Hidup
                        Anda
                    </small>
                </p>
                <a style="padding: 2%;" class="btn btn-success" href="{{ route('login') }}">&nbsp<span
                            class="btn-label">GET MY FREE ACCOUNT</span>&nbsp;&nbsp;<i
                            class="fa fa-arrow-alt-circle-right"></i>&nbsp
                </a>
            </div>
            <div class="p-0">
                <img src="{{ asset('assets') }}/image/background.png" class="img-fluid" width="70%"
                     alt="Responsive image">
            </div>
        </div>
    </div>
</div>
<div class="p-3 mb-2 bg-gradient-success">
    <p class="lead text-center ">Melakukan Menejemen Yang tepat serta cepat dengan perhitungan komputasi </p>
</div>
<div class="container-fluid">
    <div class="row mt-2 mb-4">
        <div class="col-lg-6 text-right pt-3">
            <img src="{{ asset('assets') }}/image/1SIKU.png" alt="Responsive image" class="img-fluid" width="50%">
        </div>
        <div class="col-lg-4 mt-lg-3">
            <p class="display-4">See Your Shop Easier Using Our Android App</p>
            <br>
            <img src="{{ asset('assets') }}/image/gp.png" alt="Responsive image" class="img-fluid" width="50%">
        </div>
    </div>
</div>
<footer class="container p-lg-5 bg-grey1">
    <p class="float-right">SIKU</p>
    <p>© 2017-2018 Company, Inc. · </p>
</footer>
</body>
</html>