 @include('layouts.partial.header')

 <body>


  <p><span style="color: red">{{ $user }}</span>&nbsp;{{ trans('bbs.Please active your acount by this link!') }}：<a href="{{ $url }}">{{ $url }}</a></p>


   </body>
  @include('layouts.partial.html')