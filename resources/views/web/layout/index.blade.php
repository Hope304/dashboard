<!DOCTYPE html>
<html lang="vi">
<head>
    <title>HỆ THỐNG GIÁM SÁT RỪNG HÀ NAM</title>
    <base href="{{ asset('')}}">
    <meta name="_token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta property="og:image" content="web/images/hanam/6.jpg">
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
    <link href="web/css/lightbox.css" rel="stylesheet"/>
    <link rel="stylesheet" href="web/css/flexslider.css" type="text/css" media="screen"
          property=""/>
    <link href="//fonts.googleapis.com/css?family=Oswald" rel="stylesheet">
    <link href='//fonts.googleapis.com/css?family=Roboto+Condensed:400,700italic,700,400italic,300italic,300'
          rel='stylesheet' type='text/css'>
    <link rel="shortcut icon" type="image/png" href="admin/images/logo.jpg"/>
</head>
<body>
@include('web.layout.header')
@yield('content')
@include('web.layout.footer')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="web/js/bootstrap.js"></script>
<script src="web/js/SmoothScroll.min.js"></script>
<script src="web/js/lightbox-plus-jquery.min.js"></script>
<script type="text/javascript" src="web/js/move-top.js"></script>
<script type="text/javascript" src="web/js/easing.js"></script>
<script defer src="web/js/jquery.flexslider.js"></script>
<script type="text/javascript">
    $(window).on('load', function () {
        $('.flexslider').flexslider({
            animation: "slide",
            start: function (slider) {
                $('body').removeClass('loading');
            }
        });
    });
</script>

<!-- here stars scrolling icon -->
<script type="text/javascript">
    $(document).ready(function () {
        $().UItoTop({ easingType: 'easeOutQuart' });
    });
</script>



@yield('script')
</body>
</html>