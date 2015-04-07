 @include('layouts.partial.header')
 <body>
 	  @include('layouts.partial.home.topbar')

      @include('layouts.partial.operationTips')

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
                                 				<a href="{{ route('vote.up',$returnTopics[0]->id) }}"><span class="am-badge am-radius am-badge-primary" >&nbsp;<span class="am-icon-angle-up"></span>&nbsp;{{ $returnTopics[0]->vote_count }}</span></a>
                                 				<a href="{{ route('vote.down',$returnTopics[0]->id) }}"><span class="am-badge am-radius am-badge-default" >&nbsp;<span class="am-icon-angle-down"></span>&nbsp;</span></a>
                                 				<p class="inline-block margin-top-0 am-margin-left-sm am-text-muted am-text-sm">
                                 				  <a href="{{ route('read.node',['nid' => $returnTopics[0]->node_id]) }}" class="am-text-muted">{{ $returnTopics[0]->node_name }}</a> •
                                 				  <a href="{{ route('read.user',$returnTopics[0]->user_id) }}" class="am-text-muted">{{ $returnTopics[0]->user_name }}</a> • 于 <span title="{{ $returnTopics[0]->created_at }}">{{ $postTime }}</span>前 • 最后由
                                 				  <a href="{{ route('read.user',$returnTopics[0]->last_reply_user_id) }}" class="am-text-muted">{{ $returnTopics[0]->last_user_name }}</a> • 于 <span title="{{ $returnTopics[0]->updated_at }}">{{ $lastReplyTime }}</span>前 • {{ $returnTopics[0]->view_count }} 人阅读
                                 				</p>
                                 			</div>
                                 		</div>
                                 	</div>
                                 	<div class="am-u-sm-1 am-u-md-1 am-u-lg-1 am-padding-top-sm am-padding-left-sm">
                                 		<a href="/read/users/{{ $returnTopics[0]->user_id }}"><img src="{{ asset($returnTopics[0]->user_image_url) }}" alt="{{ $returnTopics[0]->user_name }}" class="avatars am-radius am-img-thumbnail"></a>
                                 	</div>
                                 </div>
                             </div>

                             <div class="am-panel-bd am-text-left topic-body" id="topic" >
                                       {!! $returnTopics[0]->content !!}
                                       @if ($returnTopics[0]->is_excellent)
                                       	<p class="am-text-warning am-text-sm am-kai"><span class="am-icon-trophy"></span>本贴已经被设置为精华帖!</p>
                                       @endif
                             </div>
                             <div class="am-panel-footer am-text-left">
                             	<div class="am-g">
                             		<div class="am-u-sm-9"><div class="bshare-custom"><div class="bsPromo bsPromo2"></div><a title="分享到" href="http://www.bShare.cn/" id="bshare-shareto" class="bshare-more">分享到</a><a title="分享到QQ空间" class="bshare-qzone">QQ空间</a><a title="分享到新浪微博" class="bshare-sinaminiblog">新浪微博</a><a title="分享到微信" class="bshare-weixin" href="javascript:void(0);">微信</a><a title="分享到人人网" class="bshare-renren">人人网</a><a title="分享到QQ好友" class="bshare-qqim" href="javascript:void(0);">QQ好友</a><a title="分享到腾讯微博" class="bshare-qqmb">腾讯微博</a><a title="更多平台" class="bshare-more bshare-more-icon more-style-sharethis"></a><span style="float: none;" class="BSHARE_COUNT bshare-share-count">36.7K</span></div><script type="text/javascript" charset="utf-8" src="http://static.bshare.cn/b/buttonLite.js#style=-1&amp;uuid=&amp;pophcol=3&amp;lang=zh"></script><script type="text/javascript" charset="utf-8" src="http://static.bshare.cn/b/bshareC0.js"></script></div>
                             	    <div class="am-u-sm-3 am-text-sm am-kai am-text-right">
	                             	    <a href="{{ route('favorite.topic',$returnTopics[0]->id) }}" ><span class="am-icon-heart"></span>&nbsp;最爱</a>&nbsp;&nbsp;
	                             	    <a href="{{ route('collect.topic',$returnTopics[0]->id) }}" ><span class="am-icon-lock"></span>&nbsp;收藏</a>&nbsp;&nbsp;
                                        <a href="" data-id='{{ $returnTopics[0]->user_id }}' name='{{ $returnTopics[0]->user_name }}' class="reply"><span class="am-icon-reply " title="回复{{ $returnTopics[0]->user_name }}"></span>回复</a>
                             	    </div>
                             	</div>
                            </div>
                         </div>
                    </div>
                    <div class="am-panel am-panel-default" id="replies">
                         <div class="am-panel-hd">
                             <p class="am-text-left am-kai margin-bottom-0">回复数量：{{ $replies->total() }}</p>
                         </div>
                         <div class="am-panel-bd am-text-left" >
                              @foreach ($replies as $element)
                                <div class="am-g">
                                     <div class="am-u-sm-1 am-u-md-1 am-u-lg-1 am-padding-left-sm am-padding-right-xs">
                                         <a href="/read/users/{{ $element->user_id }}"><img src="{{ asset($element->user_image_url) }}" alt="" class="avatars am-radius am-img-thumbnail"></a>
                                     </div>
                                     <div class="am-u-sm-11 am-u-md-11 am-u-lg-11">
                                         <div class="am-g">
                                              <div class="am-u-sm-12 am-u-md-12 am-u-lg-12">
                                                  <div class="am-g">
                                                      <div class="am-u-sm-9 am-u-md-9 am-u-lg-9 am-text-left am-text-muted am-text-sm am-kai">
                                                           <a href="/read/users/{{ $element->user_id }}" class="am-text-muted">{{ $element->user_name }}</a> • <span title="{{ $element->created_at }}">{{ $element->replyTime }}</span>前
                                                      </div>
                                                      <div class="am-u-sm-3 am-u-md-3 am-u-lg-3 am-text-right">
                                                           <a href="{{ route('vote.reply',$element->id) }}"><span class="am-icon-thumbs-o-up" title="点赞"></span>&nbsp;{{ $element->vote_count }}</a>&nbsp;&nbsp;•&nbsp;&nbsp;
                                                           <a href="" class="reply" data-id='{{ $element->user_id }}' name="{{ $element->user_name }}"><span class="am-icon-reply" title="回复{{ $element->user_name }}"></span></a>
                                                           @if (Auth::id() == $element->user_id)
                                                              &nbsp;&nbsp;•&nbsp;&nbsp;<a href="{{ route('delete.reply',$element->id) }}"><span class="am-icon-trash" title="删除"></span>&nbsp;</a>
                                                           @endif
                                                      </div>
                                                  </div>
                                              </div>
                                              <div class="am-u-sm-12 am-u-md-12 am-u-lg-12 topic-body">
                                                  {!! $element->body !!}
                                              </div>
                                         </div>
                                     </div>
                                 </div>{{-- reply-am-g --}}
                              @endforeach
                             <div class="am-panel-footer div-color-white laravel-pagination  am-margin-bottom-sm" style="border-top: none;">
                               {!! $replies->fragment('replies')->render() !!}
                             </div>
                         </div>
                    </div>

                    <div class="am-panel am-panel-default">
                              <div class="am-panel-hd am-text-left">
                                  <p class="am-kai">我要回复：</p>
                              </div>
                              <div class="am-panel-bd am-text-left" >
                                 <p class="am-text-muted am-text-sm am-kai">温馨提示：如果您想拥有漂亮的排版，请采用<a href="{{ route('home.markdown') }}" target="_blank">&nbsp;Markdown&nbsp;</a>语法,暂不支持回复图片</p>
                                 <form class="am-form am-text-left" method="post" action="{{ action('Home\TopicController@replyTopic') }}">
                                       <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                       <input type="hidden" name="tipUser" value="{{ old('tipUser') or '' }}">
                                       <input type="hidden" name="topic_id" value="{{ $returnTopics[0]->id }}">
                                       <input type="hidden" name="topic_title" value="{{ $returnTopics[0]->title }}">
                                      <div class="am-form-group">
                                         <textarea class="am-text-left am-kai" rows="5" name="replyContent" required>{{ old('replyContent') or "" }}</textarea>
                                      </div>
                                      <button type="submit" class="am-btn am-btn-success am-round am-kai">回复</button>
                                 </form>
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

          jQuery('a.reply').bind('click',function(event){
             // event.preventDefault();

             var user_id = jQuery(this).attr('data-id');
             var user_name = jQuery(this).attr('name');

             jQuery("input[name='tipUser']").val(function(index,value){
               return value + "@" + user_id + ";";
             });

             var new_ = '@' + user_id + ';';
             var textarea =  jQuery("textarea[name='replyContent']");
             var old = textarea.text();
             textarea.text(new_ + old);

             textarea.focus();

             return false;

          });
      </script>
 </body>
      @include('layouts.partial.html')