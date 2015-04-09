<!doctype html>
<html class="no-js">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="description" content="">
  <meta name="keywords" content="">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
  <title>404 Not Found</title>

  <!-- Set render engine for 360 browser -->
  <meta name="renderer" content="webkit">

  <!-- No Baidu Siteapp-->
  <meta http-equiv="Cache-Control" content="no-siteapp"/>


  <!-- Add to homescreen for Chrome on Android -->
  <meta name="mobile-web-app-capable" content="yes">
  <link rel="icon" sizes="192x192" href="{{ asset('assets/i/app.ico') }}">

  <!-- Add to homescreen for Safari on iOS -->
  <meta name="apple-mobile-web-app-capable" content="yes">
  <meta name="apple-mobile-web-app-status-bar-style" content="black">
  <meta name="apple-mobile-web-app-title" content="Amaze UI"/>
  <link rel="apple-touch-icon-precomposed" href="{{ asset('assets/i/app.ico') }}">

  <!-- Tile icon for Win8 (144x144 + tile color) -->
  <meta name="msapplication-TileImage" content="{{ asset('assets/i/app.ico') }}">
  <meta name="msapplication-TileColor" content="#0e90d2">

  <link rel="stylesheet" href="{{ asset('assets/css/amazeui.min.css') }}">

  <!--[if lt IE 9]>
<script src="http://libs.baidu.com/jquery/1.11.1/jquery.min.js"></script>
<script src="http://cdn.staticfile.org/modernizr/2.8.3/modernizr.js"></script>
<script src="assets/js/polyfill/rem.min.js"></script>
<script src="assets/js/polyfill/respond.min.js"></script>
<script src="assets/js/amazeui.legacy.js"></script>
<![endif]-->

<!--[if (gte IE 9)|!(IE)]><!-->
<script src="{{ asset('assets/js/jquery.min.js') }}"></script>
<script src="{{ asset('assets/js/amazeui.min.js') }}"></script>
<!--<![endif]-->
<body>
   <div class="am-g">
     <div class="am-u-sm-offset-3 am-u-sm-6 am-margin-top-xl">
       <a href="{{ route('home') }}"><img src="{{ asset('image/404.jpg') }}" alt="404 Not Found" class="am-img-thumbnail am-circle"></a>
     </div>
     <div class="am-u-sm-12 am-text-center am-margin-top">
       <p class="am-kai am-text-warning">客官实在抱歉，您访问的页面不存在啊，点击上方图片发泄心中怒火！</p>
     </div>
   </div>
</body>

</html>