<!doctype html>
<html class="no-js">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="description" content="">
  <meta name="keywords" content="">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
  <title>NEU PHP</title>

  <meta name="keywords" content="NEU PHP">

  <meta name="keywords" content="markdown在线编辑">

  <meta name="keywords" content="NEUPHP官方网站">

  <!-- Set render engine for 360 browser -->
  <meta name="renderer" content="webkit">

  <!-- No Baidu Siteapp-->
  <meta http-equiv="Cache-Control" content="no-siteapp"/>

  <link rel="icon" type="image/png" href="{{ asset('assets/i/app.ico') }}">

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
  <link rel="stylesheet" href="{{ asset('assets/css/app.css') }}">

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
<script type="text/javascript">
   jQuery(document).ready(function(){

    $.AMUI.progress.start();
    setTimeout(function(){
      $.AMUI.progress.set(0.4);
    },200);
    setTimeout(function(){
      $.AMUI.progress.done();
    },400);

   });
  </script>
</head>