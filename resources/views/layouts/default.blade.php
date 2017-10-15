<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0">
    <title>@yield('title', '中国模具网') - By ara</title>
    <!-- CSS -->
    {{--<link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Roboto:400,100,300,500">--}}
    {{--<link rel="stylesheet" href="http://fonts.useso.com/css?family=Roboto:400,100,300,500">--}}
    <link rel="stylesheet" href="/assets/css/dialog.css">
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="/assets/css/lottery.css">
    <link rel="stylesheet" href="/assets/css/mould.css">


    <!-- Favicon and touch icons -->
    <link rel="shortcut icon" href="assets/ico/panda.png">

</head>

<body>
<div class="container">
    @include('layouts._header')
    <div class="col-md-offset-1 col-md-10 content">
        @include('shared._messages')
        @yield('content')
        @include('layouts._footer')
    </div>
</div>
<!-- Javascript -->
<script src="assets/js/jquery-1.11.1.min.js"></script>
<script src="assets/bootstrap/js/bootstrap.min.js"></script>
<script src="/assets/js/dialog.js"></script>
<script src="/assets/js/jquery.totemticker.js"></script>
<script src="/assets/js/lottery.js"></script>

</body>

</html>