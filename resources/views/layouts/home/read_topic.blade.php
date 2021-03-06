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
                                 				<h2 class="margin-bottom-0 am-kai">
                                             @if (Auth::id() == $returnTopics[0]->user_id)
                                             <a href="{{ route('edit.topic',$returnTopics[0]->id) }}" class="am-text-muted" ><span class="am-icon-edit inline-block" title="编辑"></span>&nbsp;&nbsp;</a>•
                                             @endif
                                             {{ $returnTopics[0]->title }}
                                        </h2>
                                 			</div>
                                 			{{-- <hr data-am-widget="divider" style="" class="am-divider am-divider-default"/> --}}
                                 			<div class="am-u-sm-12 am-u-md-12 am-u-lg-12 am-text-left am-kai">
                                 				<a href="{{ route('vote.up',$returnTopics[0]->id) }}"><span class="am-badge am-radius am-badge-primary" >&nbsp;<span class="am-icon-angle-up"></span>&nbsp;{{ $returnTopics[0]->vote_count }}</span></a>
                                 				<a href="{{ route('vote.down',$returnTopics[0]->id) }}"><span class="am-badge am-radius am-badge-default" >&nbsp;<span class="am-icon-angle-down"></span>&nbsp;</span></a>
                                 				<p class="inline-block margin-top-0 am-margin-left-sm am-text-muted am-text-sm">
                                 				  <a href="{{ route('read.node',['nid' => $returnTopics[0]->node_id]) }}" class="am-text-muted">{{ $returnTopics[0]->node_name }}</a> •
                                 				  <a href="{{ route('read.user',$returnTopics[0]->user_id) }}" class="am-text-muted">{{ $returnTopics[0]->user_name }}</a>  {{ trans('bbs.yu') }} <span title="{{ $returnTopics[0]->created_at }}">{{ $postTime }}</span>{{ trans('bbs.ago') }} • {{ trans('bbs.finnaly by') }}
                                 				  <a href="{{ route('read.user',$returnTopics[0]->last_reply_user_id) }}" class="am-text-muted">{{ $returnTopics[0]->last_user_name }}</a>  {{ trans('bbs.yu') }} <span title="{{ $returnTopics[0]->updated_at }}">{{ $lastReplyTime }}</span>{{ trans('bbs.ago') }} • {{ $returnTopics[0]->view_count }} {{ trans('bbs.reading') }}
                                 				</p>
                                 			</div>
                                 		</div>
                                 	</div>
                                 	<div class="am-u-sm-1 am-u-md-1 am-u-lg-1 am-padding-top-sm am-padding-left-sm">
                                 		<a href="{{ route('read.user',$returnTopics[0]->user_id) }}"><img src="{{ asset($returnTopics[0]->user_image_url) }}" alt="{{ $returnTopics[0]->user_name }}" class="avatars am-radius am-img-thumbnail"></a>
                                 	</div>
                                 </div>
                             </div>

                             <div class="am-panel-bd am-text-left topic-body" id="topic" >
                                       {!! $returnTopics[0]->content !!}
                                       @if ($returnTopics[0]->is_excellent)
                                       	<p class="am-text-warning am-text-sm am-kai"><span class="am-icon-trophy"></span>&nbsp;{{ trans('bbs.This has been set as an excellent post!') }}</p>
                                       @endif
                                       @if ($returnTopics[0]->stick)
                                        <p class="am-text-warning am-text-sm am-kai"><span class="am-icon-thumb-tack"></span>&nbsp;{{ trans('bbs.This has been promoted to the top!') }}</p>
                                       @endif
                                       @if ($returnTopics[0]->recommend or $returnTopics[0]->is_right_recommend)
                                        <p class="am-text-warning am-text-sm am-kai"><span class="am-icon-thumbs-up"></span>&nbsp;{{  trans('bbs.This has been recommended!')  }}</p>
                                       @endif

                                       @if (Auth::check() && Auth::user()->is_admin)
                                       &nbsp;&nbsp;<a href="{{ route('excellent.topic',$returnTopics[0]->id) }}" class="am-text-muted operation"><span class="am-icon-trophy inline-block" title="精华"></span>&nbsp;&nbsp;</a>•
                                       &nbsp;&nbsp;<a href="{{ route('stick.topic',$returnTopics[0]->id) }}" class="am-text-muted operation" ><span class="am-icon-thumb-tack inline-block" title="置顶"></span>&nbsp;&nbsp;</a>•
                                       &nbsp;&nbsp;<a href="{{ route('admin.delete.topic',$returnTopics[0]->id) }}" class="am-text-muted operation" onclick="return confirm('您确定要删除？')"><span class="am-icon-trash inline-block" title="删除"></span>&nbsp;&nbsp;</a>•
                                       &nbsp;&nbsp;<a href="{{ route('recommend.topic',$returnTopics[0]->id) }}" class="am-text-muted operation" ><span class="am-icon-thumbs-up inline-block" title="推荐"></span>&nbsp;&nbsp;</a>•
                                       &nbsp;&nbsp;<a href="{{ route('admin.recommend',$returnTopics[0]->id) }}" class="am-text-muted operation" ><span class="am-icon-angellist inline-block" title="站长推荐"></span>&nbsp;&nbsp;</a>•
                                       &nbsp;&nbsp;<a href="{{ route('wiki.topic',$returnTopics[0]->id) }}" class="am-text-muted operation" ><span class="am-icon-won inline-block" title="Wiki"></span>&nbsp;&nbsp;</a>
                                       @endif
                             </div>
                             <div class="am-panel-footer am-text-left">
                             	<div class="am-g">
                             		<div class="am-u-sm-8"><div class="bshare-custom"><div class="bsPromo bsPromo2"></div><a title="分享到" href="http://www.bShare.cn/" id="bshare-shareto" class="bshare-more">分享到</a><a title="分享到QQ空间" class="bshare-qzone">QQ空间</a><a title="分享到新浪微博" class="bshare-sinaminiblog">新浪微博</a><a title="分享到微信" class="bshare-weixin" href="javascript:void(0);">微信</a><a title="分享到人人网" class="bshare-renren">人人网</a><a title="分享到QQ好友" class="bshare-qqim" href="javascript:void(0);">QQ好友</a><a title="分享到腾讯微博" class="bshare-qqmb">腾讯微博</a><a title="更多平台" class="bshare-more bshare-more-icon more-style-sharethis"></a><span style="float: none;" class="BSHARE_COUNT bshare-share-count">36.7K</span></div><script type="text/javascript" charset="utf-8" src="http://static.bshare.cn/b/buttonLite.js#style=-1&amp;uuid=&amp;pophcol=3&amp;lang=zh"></script><script type="text/javascript" charset="utf-8" src="http://static.bshare.cn/b/bshareC0.js"></script></div>
                             	    <div class="am-u-sm-4 am-text-sm am-kai am-text-right">
	                             	    <a href="{{ route('favorite.topic',$returnTopics[0]->id) }}" ><span class="am-icon-heart"></span>&nbsp;{{ trans('bbs.favorite') }}</a>&nbsp;&nbsp;
	                             	    <a href="{{ route('collect.topic',$returnTopics[0]->id) }}" ><span class="am-icon-lock"></span>&nbsp;{{ trans('bbs.collect') }}</a>&nbsp;&nbsp;
                                        <a href="" data-id='{{ $returnTopics[0]->user_id }}' name='{{ $returnTopics[0]->user_name }}' class="reply"><span class="am-icon-reply " title="回复{{ $returnTopics[0]->user_name }}"></span>{{ trans('bbs.reply') }}</a>
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
                                         <a href="{{ route('read.user',$element->user_id) }}"><img src="{{ asset($element->user_image_url) }}" alt="" class="avatars am-radius am-img-thumbnail"></a>
                                     </div>
                                     <div class="am-u-sm-11 am-u-md-11 am-u-lg-11">
                                         <div class="am-g">
                                              <div class="am-u-sm-12 am-u-md-12 am-u-lg-12">
                                                  <div class="am-g">
                                                      <div class="am-u-sm-9 am-u-md-9 am-u-lg-9 am-text-left am-text-muted am-text-sm am-kai">
                                                           <a href="{{ route('read.user',$element->user_id) }}" class="am-text-muted">{{ $element->user_name }}</a> • <span title="{{ $element->created_at }}">{{ $element->replyTime }}</span>{{ trans('bbs.ago') }}
                                                      </div>
                                                      <div class="am-u-sm-3 am-u-md-3 am-u-lg-3 am-text-right">
                                                           <a href="{{ route('vote.reply',$element->id) }}" class="{{ Auth::id() == $element->user_id ? 'forbid_vote' : '' }}"><span class="am-icon-thumbs-o-up" title="点赞"></span>&nbsp;{{ $element->vote_count }}</a>&nbsp;&nbsp;•&nbsp;&nbsp;
                                                           <a href="" class="reply" data-id='{{ $element->user_id }}' name="{{ $element->user_name }}"><span class="am-icon-reply" title="回复{{ $element->user_name }}"></span></a>
                                                           @if (Auth::id() == $element->user_id)
                                                              &nbsp;&nbsp;•&nbsp;&nbsp;<a href="{{ route('delete.reply',$element->id) }}"><span class="am-icon-trash" title="删除" onclick="return confirm('您确定要删除？');"></span>&nbsp;</a>
                                                           @endif
                                                      </div>
                                                  </div>
                                              </div>
                                              <div class="am-u-sm-12 am-u-md-12 am-u-lg-12 topic-body am-text-break">
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
                                 <p class="am-text-muted am-text-sm am-kai">温馨提示：如果您想拥有漂亮的排版，请采用<a href="{{ route('home.markdown') }}" target="_blank">&nbsp;Markdown&nbsp;</a>语法,暂不支持回复本地图片</p>
                                 <form class="am-form am-text-left" method="post" action="{{ action('Home\TopicController@replyTopic') }}">
                                       <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                       <input type="hidden" name="tipUser" value="{{ old('tipUser') or '' }}">
                                       <input type="hidden" name="topic_id" value="{{ $returnTopics[0]->id }}">
                                       <input type="hidden" name="topic_title" value="{{ $returnTopics[0]->title }}">
                                      <div class="am-form-group">
                                         <textarea class="am-text-left am-kai border-radius" rows="5" name="replyContent" required>{{ old('replyContent')}}</textarea>
                                      </div>
                                      <button type="submit" class="am-btn am-btn-success am-round am-kai">{{ trans('bbs.reply') }}</button>
                                       <a class="am-btn am-text-muted border-radius am-margin-left am-kai am-text-sm" data-am-modal="{target: '#emjoy',width: '820',height:'520'}">{{ trans('bbs.add emjoy') }}</a>
                                 </form>
                              </div>
                    </div>
             </div>

             <div class="am-u-sm-12 am-u-md-3 am-u-lg-3">
                  @include('layouts.partial.home.rightMenu')
             </div>
       </div>

        <div class="am-modal am-modal-no-btn" tabindex="-1" id="emjoy">
          <div class="am-modal-dialog border-radius">
            <div class="am-modal-bd am-text-left">
              @for ($i = 1; $i <= $emjoy_count; $i++)
                <img src="{{ '/image/emjoy/emjoy ('.$i.').png' }}" alt="{{ $i }}" class="emjoy am-img-thumbnail am-margin-left-sm am-margin-top am-circle" style="cursor: pointer">
              @endfor
            </div>
          </div>
        </div>

 	  @include('layouts.partial.author')
      <script type="text/javascript">

         jQuery(".topic-body").find("a").attr('target','_blank');
         jQuery(".topic-body").find("a.operation").attr('target','_self');
         jQuery(".topic-body").find("img[alt='emjoy']").addClass('emjoy-sm');

         jQuery('a.forbid_vote').addClass('am-link-muted').bind('click',function(event){
           event.preventDefault();
         });

          jQuery('a.reply').bind('click',function(event){
             // event.preventDefault();

             var user_id = jQuery(this).attr('data-id');
             var user_name = jQuery(this).attr('name');

             jQuery("input[name='tipUser']").val(function(index,value){
               return value + "@" + user_id + "@;;@";
             });

             var new_ = '@' + user_id + '@;;@';
             var textarea =  jQuery("textarea[name='replyContent']");
             var old = textarea.text();
             textarea.text(new_ + old);

             textarea.focus();

             return false;

          });

          jQuery('img.emjoy').bind('click',function(event){
             var textarea =  jQuery("textarea[name='replyContent']");
             var old = textarea.text();
             textarea.text(old + "![emjoy](" + event.target.src + ")");
             jQuery("#emjoy").modal('close');
          });
      </script>
 </body>
      @include('layouts.partial.html')