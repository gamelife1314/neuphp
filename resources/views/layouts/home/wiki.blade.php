 @include('layouts.partial.header')

 <body>


 	@include('layouts.partial.home.topbar')

    @include('layouts.partial.operationTips')

<div class="am-g div-custom div-color-white">

     <div class="am-panel am-panel-default border-radius" style="margin-bottom:0px">

           <div class="am-panel-hd">
			         <p class="am-panel-title am-kai">Wiki&nbsp;&nbsp;<span class="am-icon-rss am-text-warning"></span></p>
		       </div>
           <div class="am-panel-bd">
                <div class="am-g home-excellent">
                     @foreach ($wikiTopics as $index => $value)
                           <div class="am-u-md-12 am-margin-bottom-xs am-u-sm-12 am-u-lg-6 am-text-left am-text-truncate">
                              <span>{{ $index + 1}}.</span>
                              <a href="/read/topics/{{ $value->id }}" class="am-text-sm">{{ $value->title }}</a>
                           </div>
                           @if ($index % 2 == 1 && $index != (count($wikiTopics) - 1))
    					  	            <hr data-am-widget="divider" style="" class="am-divider am-divider-default"/>
    					             @endif
                     @endforeach
                </div>
           </div>
     </div>
</div>
    @include('layouts.partial.author')

   <script type="text/javascript">
       jQuery("#doc-topbar-collapse").find("li").eq(1).addClass('am-active');
   </script>
 </body>
  @include('layouts.partial.html')