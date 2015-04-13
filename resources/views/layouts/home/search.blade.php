 @include('layouts.partial.header')
 <body>

 	  @include('layouts.partial.home.topbar')

 	   @include('layouts.partial.operationTips')

        <div class="am-g div-custom ">

             <div class="am-u-sm-12 am-u-md-9 am-u-lg-9  community-u-body border-radius" >
                  <div class="am-panel am-panel-default">
                       <div class="am-panel-hd am-text-left am-kai am-margin-bottom-xs">
                            <p class="am-text-default am-margin-bottom-xs ">关键字：<span class="am-text-warning">{{ $keyword }}</span></p>
                       </div>
                       <div class="am-panel-bd" style="padding-bottom:0px">
          			        <div class="am-g">
		              			 	 @foreach ($searchs as  $search)
			                            <div class="am-u-md-12 am-margin-bottom-xs am-u-sm-12 am-u-lg-12 am-text-left">
			                                <a href="{{ route('read.topic',$search->id) }}">{!! str_replace($keyword, "<span class='am-text-warning'>".$keyword."</span>", $search->title) !!}</a>
			                		  	</div>
			            		  	    <hr data-am-widget="divider" style="" class="am-divider am-divider-default"/>
		                            @endforeach
          			         </div>
      			        </div>{{-- am-panel-bd --}}
      			      <div class="am-panel-footer div-color-white laravel-pagination  am-margin-bottom-xl" style="border-top: none;">
                               {!! $searchs->render() !!}
                  </div>
                  </div>

                    @include('layouts.partial.home.bottombar')
             </div>

             <div class="am-u-sm-12 am-u-md-3 am-u-lg-3">
                  @include('layouts.partial.home.rightMenu')
             </div>
        </div>

 	  @include('layouts.partial.author')
 	  <script type="text/javascript">
            jQuery("div.bottom-bar").css({width: '100%'});
 	  </script>

 </body>

 @include('layouts.partial.html')