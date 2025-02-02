<!DOCTYPE html>
<html lang="vi">
<head>
    <title>HỆ THỐNG GIÁM SÁT RỪNG HÀ NAM</title>
    <base href="{{ asset('')}}">
    <meta name="_token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta property="og:image" content="~/Assets/Client/images/bavi/3vi0.jpg">
    <meta property="og:type" content="article">
    <meta property="og:image:alt" content="Giám Sát Rừng HÀ NAM">
    <meta property="og:image:width" content="408">
    <meta property="og:title" content="Hệ thống giám sát rừng HÀ NAM | IFEE">
    <meta property="og:image:height" content="200">
    <meta property="og:image:type" content="image/jpeg">
    <meta property="og:url" content="http://giamsatrungninhbinh.ifee.edu.vn/">
    <meta property="og:description" content="Hỗ trợ giám sát rừng tỉnh HÀ NAM..">
    <link href="web/css/bootstrap.css" rel="stylesheet" type="text/css" media="all"/>
    <link href="web/css/style.css" rel="stylesheet" type="text/css" media="all"/>
    <link href="web/css/font-awesome.css" rel="stylesheet">
    <link href="//fonts.googleapis.com/css?family=Oswald" rel="stylesheet">
    <link href='//fonts.googleapis.com/css?family=Roboto+Condensed:400,700italic,700,400italic,300italic,300'
          rel='stylesheet' type='text/css'>
    <link rel="shortcut icon" type="image/png" href="admin/images/logo.jpg"/>
    @yield('head')
</head>
<body>
@include('web.layout.header')
@yield('content')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="web/js/bootstrap.js"></script>
@yield('script')
</body>
</html>
