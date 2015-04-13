 @include('layouts.partial.header')

 <body>
  @include('layouts.partial.home.topbar')

    @include('layouts.partial.operationTips')

  <div class="am-g div-custom ">
	  	 <div class="am-u-sm-12 am-u-md-9 am-u-lg-9">
	  	 	  <div class="am-g  div-color-white border-radius">
	  	           <div class="am-u-sm-12 am-u-md-12 am-u-lg-12">
	  		            <p class="am-monospace default am-kai">{{ $userInf[0]->autograph }}</p>
	  	           </div>
	          </div>
	          <div class="am-g  div-color-white border-radius am-margin-top" id="user">
	                <div class="am-tabs" data-am-tabs>
						    <ul class="am-tabs-nav am-nav am-nav-tabs am-kai">
						        <li class="am-active"><a href="#tab1">{{ trans('bbs.profile') }}</a></li>
						        <li><a href="#tab2">{{ trans('bbs.release') }}</a></li>
						        <li><a href="#tab3">{{ trans('bbs.reply') }}({{ $pagination->total() }})</a></li>
						        <li><a href="#tab4">{{ trans('bbs.collect') }}</a></li>
						    </ul>

		                   <div class="am-tabs-bd am-text-left">
							    <div class="am-tab-panel am-fade am-in am-active am-text-middle" id="tab1">
							    	   <img src="{{ asset( $userInf[0]->image_url ) }}" alt="{{ $userInf[0]->name }}" class="avatars am-radius am-img-thumbnail am-margin-right-lg">
							    	   <a href="{{ route('read.user',$userInf[0]->id) }}"> {{ $userInf[0]->real_name }}</a>
							    	   <hr data-am-widget="divider" style="" class="am-divider am-divider-default"/>
							    	   <p>{{ $userInf[0]->introduction }}</p>
							    </div>
							    <div class="am-tab-panel am-fade" id="tab2">
								      	@foreach ($posts as $element)
								      	 <div class="am-g am-margin-top-sm">
								      		<div class="am-u-sm-8">
								      			<a href="{{ route('read.topic',$element->id) }}" class="inline-block am-kai">{{ $element->title }}</a>
                                                 @if (Auth::check() && Auth::id() == $userInf[0]->id)
								      				&nbsp;&nbsp;<a href="{{ route('delete.topic',$element->id) }}" class="am-text-muted" onclick="return confirm('您确定要删除？');">•&nbsp;&nbsp;<span class="am-icon-trash inline-block" title="删除"></span></a>
								      				&nbsp;&nbsp;<a href="{{ route('edit.topic',$element->id) }}" class="am-text-muted" >•&nbsp;&nbsp;<span class="am-icon-edit inline-block" title="编辑"></span></a>
								      			 @endif
								      		</div>
								      		<div class="am-u-sm-3">
								      			<span class="am-fr am-text-muted">{{ $element->created_at }}</span>
								      		</div>
								      		 </div>
								      	@endforeach
							    </div>
							    <div class="am-tab-panel am-fade" id="tab3">
							    	<ul class="am-list">
							    		@foreach ($replies as $element)
							    			<li class="border-none">
								    			<ol class="am-list">
								    				<li class="border-none">
										    				<a href="{{ route('read.user',$element['topic_user']->id) }}" class="inline-block am-text-success">{{ $element['topic_user']->name }}</a>：
										    				<a href="{{ route('read.topic',$element['reply_topic']->id) }}" class="inline-block">{{ $element['reply_topic']->title }}</a>
								    				</li>
								    				<li class="border-none am-margin-left reply_body">
										    				<a href="{{ route('read.user',$userInf[0]->id) }}" class="inline-block">{{ $userInf[0]->name }}</a>：
										    				<a href="{{ route('read.user',$element['topic_user']->id) }}" class="inline-block am-margin-right-sm am-text-success">@ {{ $element['topic_user']->name }}</a>
										    				<span class="am-fr am-text-muted">{{ $element['reply']->created_at }}</span>
										    				{!! $element['reply']->body !!}
								    				</li>
								    			</ol>
								    			<hr data-am-widget="divider" style="" class="am-divider am-divider-default"/>
							    		   </li>
							    		@endforeach
							    	</ul>
							    	<div class="laravel-pagination">
								      	{!! $pagination->fragment('user')->render() !!}
								      </div>
							    </div>
							    <div class="am-tab-panel am-fade" id="tab4">
							    	<ul class="am-list">
							    	     @foreach ($collectTopics as $element)
							    	     	<li class="border-none">
							    	     	     <a href="{{ route('read.topic',$element->id) }}" class="">{{ $element->title }}
                                                  <span class="am-fr am-text-muted">{{ $element->created_at }}</span>
							    	     	     </a>
							    	     	</li>
							    	     @endforeach
							    	</ul>
							    </div>
		                   </div>
	                 </div>
              </div>
              <div class="am-g  div-color-white border-radius am-margin-top">
	                <div class="am-tabs" data-am-tabs>
						    <ul class="am-tabs-nav am-nav am-nav-tabs am-kai">
						        <li class="am-active"><a href="#tab5">{{ trans('bbs.Excellent topic') }}</a></li>
						        <li><a href="#tab6">{{ trans('bbs.favorite topic') }}</a></li>
						    </ul>

		                   <div class="am-tabs-bd am-text-left">
							    <div class="am-tab-panel am-fade am-in am-active" id="tab5">
							    	<ul class="am-list">
									    	 @foreach ($posts as $element)
									    	 	@if ($element->is_excellent or $element->recommend or $element->stick)
									    	 		<li class="border-none">
									    	 		    <a href="{{ route('read.topic',$element->id) }}" class="">
										    	 		     @if ($element->is_excellent)
										    	 		     	<span class="am-badge am-badge-success am-radius am-text-xs">精华</span>
										    	 		     @endif
										    	 		     @if ($element->recommend)
										    	 		     	<span class="am-badge am-badge-secondary am-radius am-text-xs">推荐</span>
										    	 		     @endif
										    	 		     @if ($element->stick)
										    	 		     	<span class="am-badge am-badge-warning am-radius am-text-xs">置顶</span>
										    	 		     @endif
									    	 		         &nbsp;&nbsp;{{ $element->title }}
									    	 		         <span class="am-fr am-text-muted">{{ $element->created_at }}</span>
									    	 		    </a>
									    	 		</li>
									    	 	@endif
									    	 @endforeach
								      </ul>
							    </div>
							    <div class="am-tab-panel am-fade" id="tab6">
							    	@foreach ($favorites_topics as $index => $element)
							    		<div class="am-g">
							    			<div class="am-u-sm-1 am-text-right">{{ $index + 1}}.</div>
							    			<div class="am-u-sm-8 am-text-left am-text-truncate">
							    				<p class="am-kai"><a href="{{ route('read.user',$element['id']) }}">{{ $element['title'] }}</a></p>
							    			</div>
							    			<div class="am-u-sm-3 am-text-right">
							    				{{  $element['favoriteTime'] }}
							    			</div>
							    		</div>
							    	@endforeach
							    </div>
		                   </div>
	                 </div>
              </div>
	  	 </div>
	  	 <div class="am-u-sm-12 am-u-md-3 am-u-lg-3">
	  	 	<div class="am-u-sm-12 div-color-white border-radius am-padding-top am-padding-bottom">
	  	 		<a href=""><img src="{{ asset( $userInf[0]->image_url ) }}" alt="{{ $userInf[0]->name }}" class="avatars-lg am-radius am-img-thumbnail"></a>
	  	 	</div>
	  	 	<div class="am-u-sm-12 div-color-white border-radius am-margin-top am-text-left" style="padding:0px;">
	  	 	    <table class="am-table  am-table-radius  am-text-sm " style="margin-bottom: 0px">
                         <tr>
                         	<td class="am-text-right">{{ trans('bbs.user id') }}:</td>
                         	<td>{{ $userInf[0]->id }}</td>
                         </tr>
                         <tr>
                         	<td class="am-text-right">{{ trans('bbs.nick name') }}:</td>
                         	<td>{{ $userInf[0]->name }}</td>
                         </tr>
                         <tr>
                         	<td class="am-text-right">{{ trans('bbs.name') }}:</td>
                         	<td>{{ $userInf[0]->real_name }}</td>
                         </tr>
                         <tr>
                         	<td class="am-text-right">Github:</td>
                         	<td><a href="{{ $userInf[0]->github }}" title="{{ $userInf[0]->github }}"> {{ $userInf[0]->name }} </a></td>
                         </tr>
                         <tr>
                         	<td class="am-text-right">Email:</td>
                         	<td>{{ $userInf[0]->email }}</td>
                         </tr>
                         <tr>
                         	<td class="am-text-right">{{ trans('bbs.Posts') }}:</td>
                         	<td>{{ $userInf[0]->topic_count }}</td>
                         </tr>
                         <tr>
                         	<td class="am-text-right">{{ trans('bbs.Replies') }}:</td>
                         	<td>{{ $userInf[0]->reply_count }}</td>
                         </tr>
                         <tr>
                         	<td class="am-text-right">{{ trans('bbs.city') }}:</td>
                         	<td>{{ $userInf[0]->city }}</td>
                         </tr>
                         <tr>
                         	<td class="am-text-right">{{ trans('bbs.university') }}:</td>
                         	<td>{{ $userInf[0]->university }}</td>
                         </tr>
                         <tr>
                         	<td class="am-text-right">{{ trans('bbs.major') }}:</td>
                         	<td>{{  $userInf[0]->major  }}</td>
                         </tr>
                         <tr>
                         	<td class="am-text-right">Blog:</td>
                         	<td><a href="{{ $userInf[0]->personal_website }}" title="{{ $userInf[0]->personal_website }}">{{ $userInf[0]->real_name }}</a></td>
                         </tr>
                         <tr>
                         	<td class="am-text-right">{{ trans('bbs.regist') }}:</td>
                         	<td>{{  $userInf[0]->created_at  }}</td>
                         </tr>
                         <tr>
                         	<td class="am-text-right">{{ trans('description') }}:</td>
                         	<td>{{ $userInf[0]->introduction }}</td>
                         </tr>
                </table>

	  	 	</div>
	  	 </div>
  </div>

  @include('layouts.partial.author')
  <script type="text/javascript">
     jQuery(document).ready(function(){
     	jQuery(".reply_body").find("img[alt='emjoy']").addClass('emjoy-sm');
     });
  </script>
 </body>
  @include('layouts.partial.html')