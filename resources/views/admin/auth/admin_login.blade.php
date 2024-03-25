<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Log In</title>

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300..800;1,300..800&display=swap');

        body {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: calc(100vh - 50px);
            font-family: "Open Sans", sans-serif;
            font-optical-sizing: auto;
            font-weight: <weight>;
            font-style: normal;
            font-variation-settings:
                "wdth" 100;
                background-color: #f1f1f1;
        }

        h1 {
            margin: 0;
            font-size: 30px;
            padding-bottom: 20px;
        }

        .login {
            padding: 15px;
            box-sizing: border-box;
            background-color: #fff;
        }

        .input-area {
            width: 360px;
            max-width: 100%;
        }

        input {
            padding: 0 15px;
            border: 1px solid #ddd;
            height: 45px;
            margin-bottom: 10px;
            background: #fff;
            font-size: 16px;
            width: calc(100% - 30px);
        }

        input[type="checkbox"] {
            width: auto;
            display: inline-block;
            height: auto;
            margin: 0 10px 0 0;
        }

        .form-check {
            display: flex;
            align-items: center;
        }

        button {
            margin-top: 15px;
            width: 120px;
            height: 40px;
            background-color: #000;
            color: #fff;
            border: 0;
            font-size: 16px;
            cursor: pointer;
        }

    </style>

</head>
<body>
    <!-- Log In start -->
    <section class="login">
        <div class="container">
            <div class="account-form">
                <h1 class="text-center">Log In</h1>
                <form action="{{ route('admin.login.store') }}" method="POST">
                    @csrf
                    <div class="input-area">
                        <input name="email" type="email" class="form-control" id="email" placeholder="Email">
                        @if ($errors->any())
                        <small class="text-danger">{{ $errors->first() }}</small>
                        @endif
                    </div>
    
                    <div class="input-area">
                        <input name="password" type="password" class="form-control" id="password" placeholder="Password">
                    </div>
    
                    <div class="form-check">
                        <input name="remember" type="checkbox" class="form-check-input" id="remember">
                        <label class="form-check-label" for="remember">Check me logged in</label>
                    </div>
    
                    <button type="submit" class="btn btn-primary">Log In</button>
                </form>
            </div>
        </div>
    </section>
    <!-- Log In end -->
    
</body>
</html>
