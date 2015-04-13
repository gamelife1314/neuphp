<div class="am-panel am-panel-default div-custom div-color-white bottom-bar">
	<div class="am-panel-hd am-kai">{{ trans('bbs.Navigation and Links') }}</div>
	<div class="am-g">
	    <div class="am-u-sm-12 am-u-md-3 am-u-lg-2">
	    		<p class="am-monospace default am-text-right">PHP</p>
	    </div>
	    <div class="am-u-sm-12 am-u-md-9 am-u-lg-10">
	    		<ul class="am-list horizontal">
		    		@foreach ($nodes as $node)
		    			@if ($node->parent_node == 1)
		    				<li><a href="{{ route('read.node',$node->id) }}">
                                  @if (Auth::check() && Auth::user()->language == 'en')
                                 	{{ $node->slug }}
                                 @else
                                     {{ $node->name }}
                                 @endif
		    				     </a>
		    				</li>
		    			@endif
		    		@endforeach
	    	   </ul>
	    </div>
    </div>
    <div class="am-g ">
	    <div class="am-u-sm-12 am-u-md-3 am-u-lg-2">
	    		<p class="am-monospace default am-text-right">{{ trans('bbs.Web') }}</p>
	    </div>
	    <div class="am-u-sm-12 am-u-md-9 am-u-lg-10">
	           <ul class="am-list horizontal">
	    		@foreach ($nodes as $node)
		    			@if ($node->parent_node == 2)
		    				<li><a href="{{ route('read.node',$node->id) }}">
                                @if (Auth::check() && Auth::user()->language == 'en')
                                 	{{ $node->slug }}
                                 @else
                                     {{ $node->name }}
                                 @endif
		    				</a></li>
		    			@endif
		    	@endforeach
	    	</ul>
	    </div>
    </div>
    <div class="am-g">
	    <div class="am-u-sm-12 am-u-md-3 am-u-lg-2">
	    		<p class="am-monospace default am-text-right">Mobile</p>
	    </div>
	    <div class="am-u-sm-12 am-u-md-9 am-u-lg-10">
	    		<ul class="am-list horizontal">
	    		@foreach ($nodes as $node)
		    			@if ($node->parent_node == 3)
		    				<li><a href="{{ route('read.node',$node->id) }}">
		    				     @if (Auth::check() && Auth::user()->language == 'en')
                                 	{{ $node->slug }}
                                 @else
                                     {{ $node->name }}
                                 @endif
                                 </a></li>
		    			@endif
		    		@endforeach
	    	</ul>
	    </div>
    </div>
    <div class="am-g">
	    <div class="am-u-sm-12 am-u-md-3 am-u-lg-2">
	    		<p class="am-monospace default am-text-right">Languages</p>
	    </div>
	    <div class="am-u-sm-12 am-u-md-9 am-u-lg-10">
	    		<ul class="am-list horizontal">
		    		@foreach ($nodes as $node)
		    			@if ($node->parent_node == 4)
		    				<li><a href="{{ route('read.node',$node->id) }}">
                                 @if (Auth::check() && Auth::user()->language == 'en')
                                 	{{ $node->slug }}
                                 @else
                                     {{ $node->name }}
                                 @endif
		    				</a></li>
		    			@endif
		    		@endforeach
	    	   </ul>
	    </div>
    </div>
    <div class="am-g">
	    <div class="am-u-sm-12 am-u-md-3 am-u-lg-2">
	    		<p class="am-monospace default am-text-right">{{ trans('bbs.Community') }}</p>
	    </div>
	    <div class="am-u-sm-12 am-u-md-9 am-u-lg-10">
	    		<ul class="am-list horizontal">
		    		@foreach ($nodes as $node)
		    			@if ($node->parent_node == 5)
		    				<li><a href="{{ route('read.node',$node->id) }}">
                             @if (Auth::check() && Auth::user()->language == 'en')
                                 	{{ $node->slug }}
                                 @else
                                     {{ $node->name }}
                                 @endif
		    				</a></li>
		    			@endif
		    		@endforeach
	    	   </ul>
	    </div>
    </div>
    <div class="am-g">
	    <div class="am-u-sm-12 am-u-md-3 am-u-lg-2">
	    		<p class="am-monospace default am-text-right">{{ trans('bbs.share') }}</p>
	    </div>
	    <div class="am-u-sm-12 am-u-md-9 am-u-lg-10">
	    		<ul class="am-list horizontal">
		    		@foreach ($nodes as $node)
		    			@if ($node->parent_node == 6)
		    				<li><a href="{{ route('read.node',$node->id) }}">
                                @if (Auth::check() && Auth::user()->language == 'en')
                                 	{{ $node->slug }}
                                 @else
                                     {{ $node->name }}
                                 @endif
		    				</a></li>
		    			@endif
		    		@endforeach
	    	   </ul>
	    </div>
    </div>
    <div class="am-g">
	    <div class="am-u-sm-12 am-u-md-3 am-u-lg-2">
	    		<p class="am-monospace default am-text-right">{{ trans('bbs.link') }}</p>
	    </div>
	    <div class="am-u-sm-12 am-u-md-9 am-u-lg-10">
	    		<ul class="am-list horizontal">
		    		<li><a href="https://github.com/" target="_blank">GitHub</a></li>
		    		<li><a href="http://www.bootcss.com/" target="_blank">BootStrap</a></li>
		    		<li><a href="http://amazeui.org/" target="_blank">Amaze UI</a></li>
	    		    <li><a href="http://www.golaravel.com/" target="_blank">Laravel</a></li>
	    		    <li><a href="http://www.w3school.com.cn/" target="_blank">W3C School</a></li>
	    	   </ul>
	    </div>
    </div>
</div>
<script type="text/javascript">
	jQuery(document).ready(function(){
		function toggleAlign() {
			var togglep = jQuery("div.bottom-bar").find("p.default");
			if (jQuery(window).width() > 640) {
				togglep.toggleClass("am-text-right",true).toggleClass("am-text-left",false);
			}
			else {
				togglep.toggleClass("am-text-right",false).toggleClass("am-text-left",true);
			}
		}
		toggleAlign();
		jQuery(window).resize(function(){
			toggleAlign();
		});
	});
</script>