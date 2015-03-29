@extends('layouts.home.layout')

@section('announce')
	<div class="am-g div-custom div-color-white">
  	<div class="am-u-sm-12 am-u-md-12 am-u-lg-12">
  		<p class="am-monospace default"><strong>NEU PHP</strong> 专注为NEUer提供一个专业便捷的&nbsp;<strong>php&laravel</strong>&nbsp;交流平台</p>
  	</div>
  </div>
@stop

@section('excellent_topic')

  <div class="am-g div-custom div-color-white">
	    <div class="am-panel am-panel-default border-radius">
			  <div class="am-panel-hd">
			       <p class="am-panel-title am-kai">社区精华帖&nbsp;<span class="am-icon-home"></span></p>
			  </div>
			  <div class="am-panel-bd">
				  <div class="am-g home-excellent">
			           @foreach ($excellenTopics as $index => $singleTopic)
			           <div class="am-u-md-12 am-margin-bottom-xs am-u-sm-12 am-u-lg-6">
			                <div class="am-u-md-2 am-u-sm-2">
					  			<a href="/read/users/{{ $singleTopic->user_id }}"><img src="{{ asset($singleTopic->user_image_url) }}" alt="" class="avatars am-radius am-img-thumbnail"></a>
					  		</div>
					  		<div class="am-u-md-9 am-u-sm-9 am-text-left">
					  			<div class="am-u-md-12 am-text-truncate">
					  				<a href="/read/topics/{{ $singleTopic->id }}" class="am-text-default am-text-sm">{{ substr_replace ($singleTopic->title, '...',40)}}</a>
					  			</div>
					  			<div class="am-u-md-12 am-text-muted am-text-xs am-text-truncate">
						  			<a href="/vote/topics/{{ $singleTopic->id }}" class="am-text-muted"><span class="am-icon-thumbs-o-up">&nbsp;{{ $singleTopic->vote_count }}</span></a>&nbsp;•
						  			<a href="/read/nodes/{{ $singleTopic->node_id }}" class="am-text-muted">{{ $singleTopic->node_name }}</a>&nbsp;•&nbsp;最后由&nbsp;
						  			<a href="/read/users/{{  $singleTopic->last_reply_user_id}}" class="am-text-muted">{{ $singleTopic->last_user_name }}</a>&nbsp;•&nbsp;{{ ceil((time() - strtotime($singleTopic->created_at)) / 86400) }}天前
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
		  <a href="/community" class="am-fr am-margin-top-xs am-margin-bottom-xs am-margin-right am-text-sm">更多精华内容...</a>
	    </div>
  </div>

@stop

