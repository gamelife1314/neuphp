 @include('layouts.partial.header')

 <body>


  <p><span style="color: red">{{ $user }}</span>&nbsp;您好，请通过以下链接对您的账户进行激活：<a href="{{ $url }}">{{ $url }}</a></p>


   </body>
  @include('layouts.partial.html')