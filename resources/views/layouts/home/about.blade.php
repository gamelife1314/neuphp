 @include('layouts.partial.header')

 <body>
   @include('layouts.partial.home.topbar')

   <div class="am-g div-custom div-color-white">
        <div class="am-panel am-panel-default border-radius" style="margin-bottom:0px">
             <div class="am-panel-hd">
			         <p class="am-panel-title am-kai">关于我们</p>
		     </div>
		     <div class="am-panel-bd am-text-left">
		         	{!! $abouts !!}
		     </div>
        </div>
   </div>

   @include('layouts.partial.author')

   <script type="text/javascript">
       jQuery("#doc-topbar-collapse").find("li").eq(3).addClass('am-active');
   </script>
 </body>
  @include('layouts.partial.html')