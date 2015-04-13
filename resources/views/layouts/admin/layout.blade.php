@include('layouts.partial.admin.header')

<body>

    @if (\Session::has('returnInf'))
      <div class="am-alert {{ session('operationResult') }} div-center am-text-left marginTop  border-radius" data-am-alert>
         <button type="button" class="am-close">&times;</button>
         @foreach (session('returnInf') as $element)
           <p class="am-kai">{!! $element !!}</p>
         @endforeach
      </div>
   @endif

   <div class="am-g div-center marginTop">
   	 <div class="am-u-sm-3 am-u-md-3 am-u-lg-3 marginTop ">
   	    <div class="am-u-sm-12 bg-white border-radius">
   	    	<a href="{{ route('read.user',Auth::id()) }}"><img src="{{ Auth::user()->image_url }}" alt="{{ Auth::user()->name }}" class="am-img-thumbnail am-radius avatar am-margin-top am-margin-bottom"></a>
   	    </div>
   	 	<div class="am-u-sm-12 bg-white border-radius am-padding-top marginTop">
   	 		<p class="am-kai"><a href="#home" class="border-radius">首页</a></p>
   	 		<p class="am-kai"><a href="#site" class="border-radius">站点资料</a></p>
   	 		<p class="am-kai"><a href="#about" class="border-radius">关于我们</a></p>
   	 		<p class="am-kai"><a href="#document" class="border-radius">站点文档</a></p>
   	 		<p class="am-kai"><a href="#markdown" class="border-radius">Markdowm</a></p>
   	 		<p class="am-kai"><a href="#node" class="border-radius">节点管理</a></p>
   	 		<p class="am-kai"><a href="#user" class="border-radius">用户管理</a></p>
   	 		<p class="am-kai"><a href="#topic" class="border-radius">帖子管理</a></p>
        </div>
        <div class="am-u-sm-12 bg-white border-radius marginTop">
        	<img src="{{ asset('image/bbsIcon.png') }}" alt="BBS_Icon" class="am-img-thumbnail am-radius am-margin-top am-margin-bottom">
        	<p class="am-kai"><strong>NEU PHP</strong>社区</p>
        </div>

        <div class="am-u-sm-12 bg-white border-radius am-padding-top marginTop">
   	 		<p class="am-kai">本站导航</p>
   	 		<p class="am-kai"><a href="{{ route('home') }}" class="border-radius">首页</a></p>
   	 		<p class="am-kai"><a href="{{ route('home.community') }}" class="border-radius">社区</a></p>
   	 		<p class="am-kai"><a href="{{ route('home.wiki') }}" class="border-radius">Wiki</a></p>
   	 		<p class="am-kai"><a href="{{ route('home.markdown') }}" class="border-radius">Markdowm</a></p>
   	 		<p class="am-kai"><a href="{{ route('home.about') }}" class="border-radius">关于我们</a></p>
   	 		<p class="am-kai"><a href="{{ route('home.documents') }}" class="border-radius">文档</a></p>
   	 		<p class="am-kai"><a href="{{ route('home.member') }}" class="border-radius">会员</a></p>
   	 		<p class="am-kai">本站导航</p>
        </div>

   	 </div>
   	 <div class="am-u-sm-9 am-u-md-9 am-u-lg-9 marginTop">
   	  @yield('content')
    </div>
   </div>

   <div class="am-g div-center div-author am-margin-bottom-lg am-padding-bottom marginTop">
  	<div class="am-u-sm-12 am-u-md-12 am-u-lg-12 ">
  		<span class="am-icon-cloud am-text-xs am-fl am-padding-horizontal-xs">&nbsp;&nbsp;Made With Love By gamelife </span>
  		<span class="am-icon-user am-text-xs am-fr am-padding-right-xs">&nbsp;&nbsp;Powered By <a href="{{ route('home.about') }}">gamelife</a></span>
  	</div>
  	<div class="am-u-sm-12 am-u-md-12 am-u-lg-12 am-margin-top-xs">
	  	<span class="am-icon-heart am-text-xs am-fl am-padding-horizontal-xs">&nbsp;&nbsp;Sincerely Thanks For Yuanjin  Team</span>
  	</div>
</div>


  <div data-am-widget="gotop" class="am-gotop am-gotop-fixed">
  <a href="#top" title="回到顶部">
    <img class="am-gotop-icon-custom" src="{{ asset('/image/up.png') }} "
    />
  </a>
</div>

</body>

@include('layouts.partial.html')