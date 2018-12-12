<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login</title>
    <link rel="stylesheet" href="{{asset('assets')}}/bs/css/bootstrap.min.css">
    <script src="{{asset('assets')}}/bs/css/bootstrap.min.js"></script>
    <script src="{{asset('assets')}}/js/core/jquery.min.js"></script>
    <style>
        .login-container{
            margin-top: 5%;
            margin-bottom: 5%;
        }
        .login-form-1{
            padding: 5%;
            box-shadow: 0 5px 8px 0 rgba(0, 0, 0, 0.2), 0 9px 26px 0 rgba(0, 0, 0, 0.19);
        }
        .login-form-1 h3{
            text-align: center;
            color: #333;
        }
        .login-form-2{
            padding: 5%;
            background: #0062cc;
            box-shadow: 0 5px 8px 0 rgba(0, 0, 0, 0.2), 0 9px 26px 0 rgba(0, 0, 0, 0.19);
        }
        .login-form-2 h3{
            text-align: center;
            color: #fff;
        }
        .login-container form{
            padding: 10%;
        }
        .btnSubmit
        {
            width: 50%;
            border-radius: 1rem;
            padding: 1.5%;
            border: none;
            cursor: pointer;
        }
        .login-form-1 .btnSubmit{
            font-weight: 600;
            color: #fff;
            background-color: #0062cc;
        }
        .login-form-2 .btnSubmit{
            font-weight: 600;
            color: #0062cc;
            background-color: #fff;
        }
        .login-form-2 .ForgetPwd{
            color: #fff;
            font-weight: 600;
            text-decoration: none;
        }
        .login-form-1 .ForgetPwd{
            color: #0062cc;
            font-weight: 600;
            text-decoration: none;
        }

    </style>
</head>
<body>
    <div class="container login-container">
        <div class="row">
            <div class="col-md-3"></div>
            <div class="col-md-6 login-form-2">
                <h3>Login</h3>
                <form action="{{ route('login') }}" method="post">
                    @csrf
                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="Your Email *" value="" name="email" />
                    </div>
                    <div class="form-group">
                        <input type="password" class="form-control" placeholder="Your Password *" value="" name="password" />
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btnSubmit" >{{ __('Login') }}</button>
                    </div>
                    <div class="form-group">

                        <a href="#" class="ForgetPwd" value="Login">Forget Password?</a>
                    </div>
                </form>
            </div>
        </div>

    </div>
</body>
</html>