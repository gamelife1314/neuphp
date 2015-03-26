<!doctype html>
<html class="no-js">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="description" content="">
  <meta name="keywords" content="">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
  <title>NEU PHP</title>

  @include('layouts.partial.header')

</head>

<body>

  @include('layouts.partial.home.topbar')

  <script type="text/javascript">
   jQuery(document).ready(function(){

    $.AMUI.progress.start();
    setTimeout(function(){
      $.AMUI.progress.set(0.4);
    },800);
    setTimeout(function(){
      $.AMUI.progress.done();
    },1200);

   });
  </script>

  @yield('announce')

  @include('layouts.partial.home.bottombar')

  @include('layouts.partial.author')

</body>
</html>
