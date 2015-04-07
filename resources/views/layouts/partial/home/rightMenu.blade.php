             <div class="post-topic div-color-white border-radius">
            	   <a href="{{ route('home.post') }}" style="color: white" class="am-btn am-btn-success border-radius am-margin-top am-margin-bottom">
                        <i class="am-icon-eyedropper"></i>&nbsp;发布新帖
                   </a>
        	   </div>
        	   <div class="am-panel am-panel-default community-panel am-margin-top">
          	     <div class="am-panel-hd"> <p class="am-panel-title am-kai">友情社区</p></div>
          	      <div class="am-panel-bd">
            	        <a href="http://cnodejs.org/" target="_blank" title="cnodejs"><img src="/image/flag/cnodejs.png" alt="cnodejs" class="site-img am-img-thumbnail am-margin-top-sm border-radius"></a>
            	        <a href="http://elixir-cn.com/" target="_blank" title="ElixirChina"><img src="/image/flag/Elixircn.png" alt="ElixirChina" class="site-img am-img-thumbnail am-margin-top-sm border-radius"></a>
            	        <a href="http://golangtc.com/" target="_blank" title="GolangChina"><img src="/image/flag/Golangcn.png" alt="GolangChina" class="site-img am-img-thumbnail am-margin-top-sm border-radius"></a>
            	        <a href="https://ruby-china.org" target="_blank" title="RubyChina"><img src="/image/flag/Rubycn.png" alt="RubyChina" class="site-img am-img-thumbnail am-margin-top-sm border-radius"></a>
                      <a href="https://phphub.org/" target="_blank" title="PHPHub"><img src="/image/flag/phphub.png" alt="PHPHub" class="site-img am-img-thumbnail am-margin-top-sm border-radius"></a>
          	      </div>
        	   </div>
             <div class="am-panel am-panel-default community-panel am-margin-top">
                <div class="am-panel-hd"> <p class="am-panel-title am-kai">小贴士</p></div>
                <div class="am-panel-bd am-text-warning am-text-sm am-sans-serif am-text-left" >
                     @foreach ($tips as $key => $value)
                       <p>{{ $value->content }}</p>
                     @endforeach

                </div>
             </div>
             <div class="am-panel am-panel-default community-panel am-margin-top">
                <div class="am-panel-hd"> <p class="am-panel-title am-kai">站长推荐</p></div>
                <div class="am-panel-bd am-text-left">
                    <ul class="am-list am-list-static">
                    	@foreach ($recommend as $index => $value)
                    	<li><a href="/read/topics/{{ $value->id }}" class="am-text-muted am-text-sm">{{ substr_replace($value->title, "...", 30) }}</a></li>
                    	@endforeach
                    </ul>
                </div>
            </div>
            <div class="am-panel am-panel-default community-panel am-margin-top">
                <div class="am-panel-hd"> <p class="am-panel-title am-kai">本站统计</p></div>
                <div class="am-panel-bd am-text-sm am-sans-serif am-text-center" >
                    <p>•&nbsp;会员数：{{ $siteInf->register_count }}&nbsp;人</p>
                    <p>•&nbsp;发帖数：{{ $siteInf->topic_count }}&nbsp;条</p>
                    <p>•&nbsp;回复数：{{ $siteInf->reply_count }}&nbsp;条</p>
                    @if (isset($topicCount))
                        <p class="am-text-warning">•&nbsp;本版块：{{ $topicCount }}&nbsp;条</p>
                    @endif
                </div>
             </div>