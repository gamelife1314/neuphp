@extends('layouts.home.layout')

@section('announce')

     @include('layouts.partial.operationTips')

	<div class="am-g div-custom div-color-white">
  	<div class="am-u-sm-12 am-u-md-12 am-u-lg-12">
  		<p class="am-monospace default"><strong>NEU PHP {{ trans('bbs.announce') }}</strong> </p>
  	</div>
  </div>
@stop

@section('excellent_topic')

  <div class="am-g div-custom div-color-white">
	    <div class="am-panel am-panel-default border-radius">
			  <div class="am-panel-hd">
			       <p class="am-panel-title am-kai">{{ trans('bbs.community excellent topic') }}&nbsp;<span class="am-icon-home"></span></p>
			  </div>
			  <div class="am-panel-bd">
				  <div class="am-g home-excellent">
			           @foreach ($excellenTopics as $index => $singleTopic)
			           <div class="am-u-md-12 am-margin-bottom-xs am-u-sm-12 am-u-lg-6">
			                <div class="am-u-md-2 am-u-sm-2">
					  			<a href="{{ route('read.user',$singleTopic->user_id) }}"><img src="{{ asset($singleTopic->user_image_url) }}" alt="" class="avatars am-radius am-img-thumbnail"></a>
					  		</div>
					  		<div class="am-u-md-9 am-u-sm-9 am-text-left">
					  			<div class="am-u-md-12 am-text-truncate">
					  				<a href="{{ route('read.topic',$singleTopic->id) }}" class="am-text-default am-text-sm">{{ $singleTopic->title}}</a>
					  			</div>
					  			<div class="am-u-md-12 am-text-muted am-text-xs am-text-truncate">
						  			<a href="{{ route('vote.topic',$singleTopic->id) }}" class="am-text-muted"><span class="am-icon-thumbs-o-up">&nbsp;{{ $singleTopic->vote_count }}</span></a>&nbsp;•
						  			<a href="{{ route('read.node',$singleTopic->node_id) }}" class="am-text-muted">
                                      @if (Auth::check() && Auth::user()->language == 'en')
		                                 	{{ $singleTopic->node_slug }}
		                                 @else
		                                     {{ $singleTopic->node_name }}
		                                 @endif
						  			</a>&nbsp;•&nbsp;{{ trans('bbs.finnaly by') }}&nbsp;
						  			<a href="{{ route('read.user',$singleTopic->last_reply_user_id) }}" class="am-text-muted">{{ $singleTopic->last_user_name }}</a>&nbsp;•&nbsp;<span title="{{ $singleTopic->created_at }}">{{ $singleTopic->postTime }}</span> {{ trans('bbs.ago') }}
					  			</div>
					  		</div>
					  		<div class="am-u-md-1 am-u-sm-1 am-padding-top-sm am-padding-right-xs">
						  		<span class="am-badge am-round am-text-secondary" title="阅览人数">
						  			@if ($singleTopic->view_count < 10)
						  			  &nbsp;&nbsp;{{ $singleTopic->view_count }}
						  			@else
						  			  {{ $singleTopic->view_count }}
						  			@endif
						  		</span>
					  		</div>
					  	</div>
					  	@if ($index % 2 == 1 && $index != (count($excellenTopics) - 1))
					  	 <hr data-am-widget="divider" style="" class="am-divider am-divider-default"/>
					  	@endif
			           @endforeach
				  </div> {{-- am-g --}}
	         </div> {{-- panel-body --}}
		  <a href="/community" class="am-fr am-margin-top-xs am-margin-bottom-xs am-margin-right am-text-sm">{{ trans('bbs.more exciting content') }}...</a>
	    </div>
  </div>

@stop

