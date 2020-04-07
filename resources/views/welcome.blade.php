<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>School Management System</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Nunito', sans-serif;
                font-weight: 200;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 56px;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 13px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }

            button{
                cursor: pointer;
                outline: none;
                position: relative;
                background: transparent;
                color: #636b6f;
                font-size: 14px;
                border: #636b6f solid 2px;
                border-radius: 22px;
                padding: 10px 40px;
                text-transform: uppercase;
                transition: all 0.2s linear;
            }

            button:hover{
                background: #636b6f;
                color: white;
                border-color: white;
            }
        </style>
    </head>
    <body>
        <div class="flex-center position-ref full-height">
            <div class="content">
                <div class="title m-b-md">
                    School Management System
                </div>
            @if (Route::has('login'))
                @auth
                    <a href="{{ url('/home') }}">
                        <button>Go to dashboard</button>
                    </a>
                @else
                    <a href="{{ route('login') }}">
                        <button type="submit">Let's start</button>
                    </a>
                @endauth
            @endif
            </div>
        </div>
    </body>
</html>
