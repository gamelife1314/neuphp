 @include('layouts.partial.header')
 <body>
 	  @include('layouts.partial.home.topbar')

     @include('layouts.partial.operationTips')


{{-- 本页面内容 --}}

   <div class="am-g div-custom ">
      	<div class="am-u-sm-12 am-u-md-9 am-u-lg-9  community-u-body border-radius" > {{-- 左半部分开始 --}}
      		<div class="am-panel am-panel-default community-panel">
        			<div class="am-panel-hd am-text-right am-kai am-text-sm block-div">
            			  <a href="{{ route('home.community',['arg' => 'recent']) }}" class="am-text-muted am-margin-right-xs"><span class="am-icon-clock-o">&nbsp;最近发表</a>
            			  <a href="{{ route('home.community',['arg' => 'excellent']) }}" class="am-text-muted am-margin-right-xs"><span class="am-icon-heart">&nbsp;精华主题</a>
            			  <a href="{{ route('home.community',['arg' => 'maxvote']) }}" class="am-text-muted am-margin-right-xs"><span class="am-icon-comment">&nbsp;最多投票</a>
            			  <a href="{{ route('home.community',['arg' => 'nobodyview']) }}" class="am-text-muted am-margin-right-xs"><span class="am-icon-eye-slash">&nbsp;无人问津</a>
        			</div>
      			<div class="am-panel-bd" style="padding-bottom:0px">
          			 <div class="am-g">
              			 	 @foreach ($returnTopics as $index => $singleTopic)
                            <div class="am-u-md-12 am-margin-bottom-xs am-u-sm-12 am-u-lg-12">
                                <div class="am-u-md-2 am-u-sm-2 am-u-lg-2">
                		  			         <a href="{{ route('read.user',$singleTopic->user_id) }}"><img src="{{ asset($singleTopic->user_image_url) }}" alt="" class="avatars am-radius am-img-thumbnail"></a>
                		  		      </div>
                		  		      <div class="am-u-md-9 am-u-sm-9 am-u-lg-9 am-text-left am-text-truncate">
                  		  			      <div class="am-u-md-12">
                    		  				        <a href="{{ route('read.topic',$singleTopic->id) }}" class="am-text-default am-text-sm">
                                            @if ($singleTopic->stick == 1)
                                             <span class="am-badge am-badge-success am-radius am-text-xs">置顶</span>
                                            @elseif ($singleTopic->recommend == 1)
                                              <span class="am-badge am-badge-secondary am-radius am-text-xs">推荐</span>
                                            @endif
                    		  				          {{ $singleTopic->title }}
                                         </a>
                  		  			     </div>
                  		  			     <div class="am-u-md-12 am-text-muted am-text-xs am-text-truncate">
                      		  			       <a href="{{ route('vote.topic',$singleTopic->id) }}" class="am-text-muted"><span class="am-icon-thumbs-o-up">&nbsp;{{ $singleTopic->vote_count }}</span></a>&nbsp;•
                      		  			       <a href="{{ route('read.node',$singleTopic->node_id) }}" class="am-text-muted">{{ $singleTopic->node_name }}</a>&nbsp;•&nbsp;最后由&nbsp;
                      		  			       <a href="{{ route('read.user',$singleTopic->last_reply_user_id) }}" class="am-text-muted">{{ $singleTopic->last_user_name }}</a>&nbsp;•&nbsp;<span title="{{ $singleTopic->created_at }}">{{$singleTopic->replyTime }}</span>前
                  		  			     </div>
                		  		    </div>
                		  		    <div class="am-u-md-1 am-u-sm-1 am-padding-top-sm am-padding-right-xs am-u-lg-1">
                    		  		     <span class="am-badge am-round am-text-secondary" title="阅览人数">
                            		  			@if ($singleTopic->view_count < 10)
                            		  			  &nbsp;&nbsp;{{ $singleTopic->view_count }}
                            		  			@else
                            		  			  {{ $singleTopic->view_count }}
                            		  			@endif
                    		  		     </span>
                		  		    </div>
                		  	</div>
            		  	    <hr data-am-widget="divider" style="" class="am-divider am-divider-default"/>
                   @endforeach
          			 </div>
      			</div>{{-- am-panel-bd --}}

      			 @include('layouts.partial.home.pagination'){{-- 包含分页代码 --}}

      		</div>

      		@include('layouts.partial.home.bottombar'){{-- 包含页底导航部分 --}}

      	</div>

      	<div class="am-u-sm-12 am-u-md-3 am-u-lg-3">{{-- 右半部分菜单--}}

        	   @include('layouts.partial.home.rightMenu')

      	</div>

  </div>{{-- 页面容器am-g --}}




 	  @include('layouts.partial.author')


 	  <script type="text/javascript">
         jQuery(document).ready(function(){

          	jQuery("#doc-topbar-collapse").find("li").eq(0).addClass('am-active');
           	jQuery("div.bottom-bar").css({width: '100%'});

//前后翻页
              jQuery("ul.bbs-pagination").find("li:last").click(function(){
              	var a = jQuery(this).find("a");
              	var link = a.attr("page-class") + (parseInt(a.attr("page-id")) + 1);
              	window.location.href = link;
              });
              jQuery("ul.bbs-pagination").find("li:first").click(function(){
              	var a = jQuery(this).find("a");
              	var link = a.attr("page-class") + (parseInt(a.attr("page-id")) - 1);
              	window.location.href = link;
             });

             var block = '{{ $arg }}';
             var block_a = jQuery("div.block-div").find("a");
             if (block == "maxvote") {
                 block_a.eq(2).addClass('am-text-primary').removeClass('am-text-muted');
             }
             else if(block == "recent") {
                block_a.eq(0).addClass('am-text-primary').removeClass('am-text-muted');
             }
             else if(block == "excellent") {
              block_a.eq(1).addClass('am-text-primary').removeClass('am-text-muted');
             }
             else if (block == "nobodyview") {
              block_a.eq(3).addClass('am-text-primary').removeClass('am-text-muted');
             }

        });
    </script>
 </body>
      @include('layouts.partial.html')