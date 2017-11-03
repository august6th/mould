<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="/assets/css/sweetalert.css">
        <title>中国模具网 - By ara</title>
        <link rel="shortcut icon" href="assets/ico/panda.png">
        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: Consolas;
                font-weight: 100;
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
                font-size: 55px;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 12px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }
        </style>
    </head>
    <body>
        <div class="flex-center position-ref full-height">
            <div class="content">
                <div class="title m-b-md">
                    中国模具网
                </div>

                <div class="links">
                    <a href="https://www.mould.net.cn">中模网</a>
                    <a href="https://www.mouldbbs.com">中模论坛</a>
                </div>
            </div>
        </div>
        <script src="/assets/js/sweetalert.min.js"></script>
        <script>
            swal({
                title: "您来早了，活动尚未开始！",
                text: "活动时间：2017-11-9 9:00",
                imageUrl: "assets/img/time.png",
                imageSize: "100x100"
            });
        </script>
    </body>
</html>
