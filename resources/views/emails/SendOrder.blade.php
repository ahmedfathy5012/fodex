<!DOCTYPE html>
<html lang="ar">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="https://snunu.net/img/logo-footer.b003174e.png" type="image" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@600;700&family=Kdam+Thmor+Pro&display=swap"
        rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css"
        integrity="sha512-HK5fgLBL+xu6dm/Ii3z4xhlSUyZgTT9tuc/hSrtw6uzJOvgRr2a9jyxxT1ely+B+xFAmJKVSTbpM/CuL7qxO8w=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/fontawesome.min.css"
        integrity="sha512-shT5e46zNSD6lt4dlJHb+7LoUko9QZXTGlmWWx0qjI9UhQrElRb+Q5DM7SVte9G9ZNmovz2qIaV7IWv0xQkBkw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <title>fodex</title>

    <style>
        body {
            padding: 0;
            margin: 0;
            direction: rtl;
        }

        .logo {
            margin: 2rem auto;
            display: block;
            width:100px;
            height:100px;
        }

        .enjoy {
            background-color: #FF7D7D;
            background-repeat: no-repeat;
            background-size: cover;
            padding: 5% 0;
        }

        .enjoy h2 {
            color: #fff;
            text-align: center;
            width: 35%;
            margin: 0 auto;
            font-family: 'Cairo', sans-serif !important;
        }

        .enjoy .btn {
            margin: 1% auto;
            color: #000;
            display: block;
            background-color: #fff;
            width: -webkit-fit-content;
            width: -moz-fit-content;
            width: fit-content;
            padding: 0.375rem 1.5rem;
            border-radius: 25px;
            transition: .7s ease-in-out;
            font-family: 'Cairo', sans-serif !important;
        }

        .enjoy .btn:hover {
            background-color: transparent;
            border: 1px solid #fff;
            color: #fff;
            transition: .7s ease-in-out;
        }

        .text {
            font-family: 'Cairo', sans-serif !important;
            color: #000;
            text-align: center;
            width: 30%;
            margin: 2rem auto 0;
            unicode-bidi: plaintext;
        }

        .socialicon {
            display: flex;
            justify-content: center;
            margin-top: 1rem !important;
        }

        .socialicon li {
            list-style: none;
            margin: 7px 0 !important;
        }

        .socialicon li a {
            width: 40px;
            height: 40px;
            background-color: #fff;
            text-align: center;
            line-height: 30px;
            font-size: 20px;
            margin: 0 5px;
            display: block;
            border-radius: 50%;
            position: relative;
            overflow: hidden;
            border: 3px solid #fff;
            z-index: 1;
        }

        .socialicon li a .icon {
            position: relative;
            color: #3eb381;
            transition: 0.5s;
            z-index: 3;
            top: 5%;
            margin: 0;
        }

        .socialicon li a:hover .icon {
            color: #fff;
            transform: rotateY(360deg);
        }

        .socialicon li a:before {
            content: "";
            position: absolute;
            top: 100%;
            left: 0;
            width: 100%;
            height: 100%;
            background: #f00;
            transition: 0.5s;
            z-index: 2;
        }

        .socialicon li a:hover:before {
            top: 0;
        }

        .socialicon li:nth-child(1) a:before {
            background: #3b5999;
        }

        .socialicon li:nth-child(2) a:before {
            background: #55acee;
        }

        .socialicon li:nth-child(3) a:before {
            background: #0077b5;
        }

        .socialicon li:nth-child(4) a:before {
            background: #dd4b39;
        }

        .socialicon li:nth-child(5) a:before {
            background: #25d366;
        }

        @media only screen and (max-width: 991.98px) {
            .text {
                width: 60%;
            }
            .enjoy h2 {
                width: 50%;
                margin-bottom: 1rem;
            }
        }
        @media only screen and (max-width: 600px) {
            .text {
                width: 80%;
            }
            .enjoy h2 {
                width: 70%;
                margin-bottom: 1rem;
            }
        }
    </style>
</head>

<body>
   <img src="{{asset('fodexlogo2.jpg')}}" class="logo" alt="fodex">
    <section class="enjoy">
        <div class="container">
            <h2>
         {{ $details['title'] }}
            </h2><a href="{{route('showorders',$details['id'])}}" class="btn"> عرض</a>
        </div>
    </section>
    <p class="text">

    {{ $details['body'] }}
    </p>
    <ul class="socialicon mt-2">
        <!--<li>-->
        <!--    <a target="_blank" href="https://www.instagram.com/theplaza.hotelresort/"><i class="fab fa-facebook-f icon"></i></a>-->
        <!--</li>-->
        <!--<li>-->
        <!--    <a target="_blank" href="https://twitter.com/TheplazaH"><i class="fab fa-twitter icon"></i></a>-->
        <!--</li>-->
       
       
        <!--<li>-->
        <!--    <a target="_blank" href="https://www.instagram.com/theplaza.hotelresort"><i class="fab fa-instagram icon"></i></a>-->
        <!--</li>-->
       
    </ul>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa"
        crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/js/all.min.js"
    integrity="sha512-UwcC/iaz5ziHX7V6LjSKaXgCuRRqbTp1QHpbOJ4l1nw2/boCfZ2KlFIqBUA/uRVF0onbREnY9do8rM/uT/ilqw=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/js/fontawesome.min.js"
    integrity="sha512-pafh0hrrT9ZPZl/jx0cwyp7N2+ozgQf+YK94jSupHHLD2lcEYTLxEju4mW/2sbn4qFEfxJGZyIX/yJiQvgglpw=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
</body>

</html>