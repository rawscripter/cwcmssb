<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>C & W MANAGEMENT SERVICES SDN BHD</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,400;0,600;0,700;0,900;1,400&display=swap"
        rel="stylesheet">
    <script src="https://kit.fontawesome.com/fce0f0f0f9.js" crossorigin="anonymous"></script>
    <link rel="stylesheet"
        href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
    <style>
        body {
            margin: 0;
            height: 100vh;
            display: flex;
            flex-direction: column;
            justify-content: center;
            font-family: 'Poppins', sans-serif;
            color: #17343e;
        }

        h1,
        h2,
        h3,
        h4,
        h5,
        p,
        h6 {
            font-family: 'Poppins', sans-serif;
            margin: 0;
            letter-spacing: 1px
        }

        .half {
            width: 100%;
            height: 100%;
            display: flex;
            justify-content: center;

        }

        .flex-end {
            align-items: end;
        }

        .p-10 {
            padding: 10px;
        }

        h1 {
            font-weight: 700;

        }

        .bg-teal {
            background-color: #00bcd4;
        }

        .text-white {
            color: #fff;
        }

        .f-bold {
            font-weight: 700;
        }

        .company-info {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            margin-bottom: 20px;
        }

        .text-center {
            text-align: center;
        }

        .mt-2 {
            margin-top: 5px
        }

        .fw-500 {
            font-weight: 400
        }

        .las {
            font-weight: bold;
            font-size: 22px
        }

        .login {
            position: absolute;
            right: 20px;
            top: 20px;
            font-weight: 500;
            color: #17343e;
            text-decoration: none;
        }

    </style>
</head>

<body>
    <div class="half bg-teal flex-end">
        @guest
            <a class="login" href="/login">
                <i class="las la-user"></i> Login
            </a>
        @endguest
        @auth
            <a class="login" href="/home">
                <i class="las la-user"></i> Home
            </a>
        @endauth
        <div class="company-info  text-center ">
            <img src="{{ asset('logo.png') }}" width="80px" alt="">
            <h1>C & W MANAGEMENT SERVICES SDN BHD</h1>
            <p class=" f-bold">(197901008960 (53244-D))</p>
            <p class="text-white f-bold">SECRETARIAL & MANAGEMENT SERVICES</p>
        </div>
    </div>
    <div class="half ">
        <div class="p-10 text-center fw-500">
            <i class="las la-map-marker"></i> 36-Level 3, Jalan Tun Sambanthan 3, <br>
            50470 Kuala Lumpur, Malaysia. <br>

            <div class="mt-2"> <i class="las la-phone"></i> +03-2274 2181
                &nbsp; &nbsp;
                <i class="las la-envelope"></i> cwmgtservices@hotmail.com
            </div>

        </div>
    </div>
</body>

</html>
