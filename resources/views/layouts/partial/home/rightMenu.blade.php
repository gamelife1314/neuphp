             <div class="post-topic div-color-white border-radius">
            	   <a href="{{ route('home.post') }}" style="color: white" class="am-btn am-btn-success border-radius am-margin-top am-margin-bottom">
                        <i class="am-icon-eyedropper"></i>&nbsp;{{ trans('bbs.new posts') }}
                   </a>
        	   </div>
        	   <div class="am-panel am-panel-default community-panel am-margin-top">
          	     <div class="am-panel-hd"> <p class="am-panel-title am-kai">{{ trans('bbs.friendly community') }}</p></div>
          	      <div class="am-panel-bd">
            	        <a href="http://cnodejs.org/" target="_blank" title="cnodejs"><img src="/image/flag/cnodejs.png" alt="cnodejs" class="site-img am-img-thumbnail am-margin-top-sm border-radius"></a>
            	        <a href="http://elixir-cn.com/" target="_blank" title="ElixirChina"><img src="/image/flag/Elixircn.png" alt="ElixirChina" class="site-img am-img-thumbnail am-margin-top-sm border-radius"></a>
            	        <a href="http://golangtc.com/" target="_blank" title="GolangChina"><img src="/image/flag/Golangcn.png" alt="GolangChina" class="site-img am-img-thumbnail am-margin-top-sm border-radius"></a>
            	        <a href="https://ruby-china.org" target="_blank" title="RubyChina"><img src="/image/flag/Rubycn.png" alt="RubyChina" class="site-img am-img-thumbnail am-margin-top-sm border-radius"></a>
                      <a href="https://phphub.org/" target="_blank" title="PHPHub"><img src="/image/flag/phphub.png" alt="PHPHub" class="site-img am-img-thumbnail am-margin-top-sm border-radius"></a>
          	      </div>
        	   </div>
             <div class="am-panel am-panel-default community-panel am-margin-top">
                <div class="am-panel-hd"> <p class="am-panel-title am-kai">{{ trans('bbs.small tips') }}</p></div>
                <div class="am-panel-bd am-text-warning am-text-sm am-sans-serif am-text-left" >
                     @foreach ($tips as $key => $value)
                       <p>{{ $value->content }}</p>
                     @endforeach

                </div>
             </div>
             <div class="am-panel am-panel-default community-panel am-margin-top">
                <div class="am-panel-hd"> <p class="am-panel-title am-kai">{{ trans('bbs.Chief recommended') }}</p></div>
                <div class="am-panel-bd am-text-left">
                    <ul class="am-list am-list-static">
                    	@foreach ($recommend as $index => $value)
                    	<li class="am-text-truncate"><a href="/read/topics/{{ $value->id }}" class="am-text-muted am-text-sm">{{ $value->title }}</a></li>
                    	@endforeach
                    </ul>
                </div>
            </div>
            <div class="am-panel am-panel-default community-panel am-margin-top">
                <div class="am-panel-hd"> <p class="am-panel-title am-kai">{{ trans('bbs.Site Statistics') }}</p></div>
                <div class="am-panel-bd am-text-sm am-sans-serif am-text-left" >
                    <p>•&nbsp;{{ trans('bbs.Membership') }}：{{ $siteInf->register_count }}&nbsp;</p>
                    <p>•&nbsp;{{ trans('bbs.Posts') }}：{{ $siteInf->topic_count }}&nbsp;</p>
                    <p>•&nbsp;{{ trans('bbs.Replies') }}：{{ $siteInf->reply_count }}&nbsp;</p>
                    @if (isset($topicCount))
                        <p class="am-text-warning">•&nbsp;{{ trans('bbs.The area') }}：{{ $topicCount }}&nbsp;</p>
                    @endif
                </div>
             </div>