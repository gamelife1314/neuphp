 @include('layouts.partial.header')
 <body>

 	  @include('layouts.partial.home.topbar')

 	   @include('layouts.partial.operationTips')

        <div class="am-g div-custom ">

             <div class="am-u-sm-12 am-u-md-9 am-u-lg-9  community-u-body border-radius" >
                  <div class="am-panel am-panel-default">
                       <div class="am-panel-hd am-text-left am-kai am-margin-bottom-xs">
                            <p class="am-text-default am-margin-bottom-xs ">{{ trans('bbs.current node') }}：<span class="am-text-warning">{{ $currentNode[0]->name }}</span></p>
                       </div>
                       <div class="am-panel-bd" style="padding-bottom:0px">
          			        <div class="am-g">
		              			 	 @foreach ($returnTopics as $index => $singleTopic)
			                            <div class="am-u-md-12 am-margin-bottom-xs am-u-sm-12 am-u-lg-12">
			                                <div class="am-u-md-2 am-u-sm-2 am-u-lg-2">
			                		  			         <a href="/read/users/{{ $singleTopic->user_id }}"><img src="{{ asset($singleTopic->user_image_url) }}" alt="" class="avatars am-radius am-img-thumbnail"></a>
			                		  		 </div>
			                		  		 <div class="am-u-md-9 am-u-sm-9 am-u-lg-9 am-text-left am-text-truncate">
		                  		  			      <div class="am-u-md-12">
		                    		  				    <a href="/read/topics/{{ $singleTopic->id }}" class="am-text-default am-text-sm">
					                                            @if ($singleTopic->stick == 1)
					                                             <span class="am-badge am-badge-success am-radius am-text-xs">{{ trans('bbs.stick') }}</span>
					                                            @elseif ($singleTopic->recommend == 1)
					                                              <span class="am-badge am-badge-secondary am-radius am-text-xs">{{ trans('bbs.recommend') }}</span>
					                                            @endif
		                    		  				            {{ $singleTopic->title }}
		                                                </a>
		                  		  			     </div>
			                  		  			 <div class="am-u-md-12 am-text-muted am-text-xs am-text-truncate">
			                      		  			       <a href="/vote/topics/{{ $singleTopic->id }}" class="am-text-muted"><span class="am-icon-thumbs-o-up">&nbsp;{{ $singleTopic->vote_count }}</span></a>&nbsp;•
			                      		  			       <a href="/read/nodes/{{ $singleTopic->node_id }}" class="am-text-muted">{{ $singleTopic->node_name }}</a>&nbsp;•&nbsp;最后由&nbsp;
			                      		  			       <a href="/read/users/{{  $singleTopic->last_reply_user_id}}" class="am-text-muted">{{ $singleTopic->last_user_name }}</a>&nbsp;•&nbsp;<span title="{{ $singleTopic->created_at }}">{{$singleTopic->replyTime }}</span>前
			                  		  			 </div>
			                		  		 </div>
			                		  		 <div class="am-u-md-1 am-u-sm-1 am-padding-top-sm am-padding-right-xs am-u-lg-1">
			                    		  		     <span class="am-badge am-round am-text-secondary" title="{{ trans('bbs.view number') }}">
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
                  @include('layouts.partial.home.bottombar')
             </div>

             <div class="am-u-sm-12 am-u-md-3 am-u-lg-3">
                  @include('layouts.partial.home.rightMenu')
             </div>
        </div>

 	  @include('layouts.partial.author')
 	  <script type="text/javascript">
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
 	  </script>

 </body>

 @include('layouts.partial.html')