 @include('layouts.partial.header')
 <body>
 	  @include('layouts.partial.home.topbar')

       <div class="am-g div-custom ">
             <div class="am-u-sm-12 am-u-md-9 am-u-lg-9  community-u-body border-radius" >
                    <div class="am-panel am-panel-default">
                         <div class="am-panel am-panel-default" style="margin-bottom: 0px;">
                             <div class="am-panel-hd" style="padding-bottom: 0px;">
                                 <div class="am-g">
                                 	<div class="am-u-sm-11 am-u-md-11 am-u-lg-11 am-padding-right-sm">
                                 		<div class="am-g">
                                 			<div class="am-u-sm-12 am-u-md-12 am-u-lg-12 am-text-left am-text-truncate">
                                 				<h2 class="margin-bottom-0 am-kai">{{ $returnTopics[0]->title }}</h2>
                                 			</div>
                                 			{{-- <hr data-am-widget="divider" style="" class="am-divider am-divider-default"/> --}}
                                 			<div class="am-u-sm-12 am-u-md-12 am-u-lg-12 am-text-left am-kai">
                                 				<a href=""><span class="am-badge am-radius am-badge-primary" >&nbsp;<span class="am-icon-angle-down"></span>&nbsp;</span></a>
                                 				<a href=""><span class="am-badge am-radius am-badge-primary" >&nbsp;<span class="am-icon-angle-up"></span>&nbsp;</span></a>
                                 				<p class="inline-block margin-top-0 am-margin-left-sm am-text-muted am-text-sm">
                                 				  <a href="/nodes/{{ $returnTopics[0]->node_id }}" class="am-text-muted">{{ $returnTopics[0]->node_name }}</a> •
                                 				  <a href="/read/users/{{ $returnTopics[0]->user_id }}" class="am-text-muted">{{ $returnTopics[0]->user_name }}</a> • 于 {{ $postTime }}前 • 最后由
                                 				  <a href="/read/users/{{ $returnTopics[0]->last_reply_user_id }}" class="am-text-muted">i{{ $returnTopics[0]->last_user_name }}</a> 于 {{ $lastReplyTime }}前 • {{ $returnTopics[0]->view_count }} 人阅读
                                 				</p>
                                 			</div>
                                 		</div>
                                 	</div>
                                 	<div class="am-u-sm-1 am-u-md-1 am-u-lg-1 am-padding-top-sm am-padding-left-sm">
                                 		<a href="/read/users/{{ $returnTopics[0]->user_id }}"><img src="{{ asset($returnTopics[0]->user_image_url) }}" alt="{{ $returnTopics[0]->user_name }}" class="avatars am-radius am-img-thumbnail"></a>
                                 	</div>
                                 </div>
                             </div>

                             <div class="am-panel-bd am-text-left topic-body" >
                                       {!! $returnTopics[0]->content !!}
                                       @if ($returnTopics[0]->is_excellent)
                                       	<p class="am-text-warning am-text-sm am-kai"><span class="am-icon-trophy"></span>本贴已经被设置为精华帖!</p>
                                       @endif
                             </div>
                             <div class="am-panel-footer am-text-left">
                             	<div class="am-g">
                             		<div class="am-u-sm-9"><div class="bshare-custom"><div class="bsPromo bsPromo2"></div><a title="分享到" href="http://www.bShare.cn/" id="bshare-shareto" class="bshare-more">分享到</a><a title="分享到QQ空间" class="bshare-qzone">QQ空间</a><a title="分享到新浪微博" class="bshare-sinaminiblog">新浪微博</a><a title="分享到微信" class="bshare-weixin" href="javascript:void(0);">微信</a><a title="分享到人人网" class="bshare-renren">人人网</a><a title="分享到QQ好友" class="bshare-qqim" href="javascript:void(0);">QQ好友</a><a title="分享到腾讯微博" class="bshare-qqmb">腾讯微博</a><a title="更多平台" class="bshare-more bshare-more-icon more-style-sharethis"></a><span style="float: none;" class="BSHARE_COUNT bshare-share-count">36.7K</span></div><script type="text/javascript" charset="utf-8" src="http://static.bshare.cn/b/buttonLite.js#style=-1&amp;uuid=&amp;pophcol=3&amp;lang=zh"></script><script type="text/javascript" charset="utf-8" src="http://static.bshare.cn/b/bshareC0.js"></script></div>
                             	    <div class="am-u-sm-3 am-text-sm am-kai am-text-right">
	                             	    <a href=""><span class="am-icon-heart"></span>&nbsp;最爱</a>&nbsp;&nbsp;
	                             	    <a href=""><span class="am-icon-lock"></span>&nbsp;收藏</a>
                             	    </div>
                             	</div>
                            </div>
                         </div>
                    </div>
             </div>

             <div class="am-u-sm-12 am-u-md-3 am-u-lg-3">
                  @include('layouts.partial.home.rightMenu')
             </div>
       </div>

 	  @include('layouts.partial.author')
      <script type="text/javascript">
         jQuery(".topic-body").find("a").attr('target','_blank');
      </script>
 </body>
      @include('layouts.partial.html')