 @include('layouts.partial.header')

 <body>


  <p>{{ $user }}&nbsp;，{{ trans('bbs.random password') }}：<span style="color: red">{{ $password }}</span></p>


 </body>
  @include('layouts.partial.html')