 @include('layouts.partial.header')
 <body>
 	  @include('layouts.partial.home.topbar')

      @include('layouts.partial.operationTips')

      <div class="am-g div-custom ">
            <div class="am-u-sm-12 am-u-md-9 am-u-lg-9  border-radius" >
                 <div class="div-color-white border-radius am-padding-top-sm am-text-left">
                 	  <p class="am-kai am-margin-bottom-xs am-margin-left am-padding-bottom-sm">{{ trans('bbs.Edit Topic!') }}</p>
                 </div>
                 <div class="am-panel am-panel-success am-margin-top am-text-left">
                 	  <div class="am-panel-hd am-kai">{{ trans('bbs.Post by') }}<a href="{{ route('home.markdown') }}" target="_blank"> Markdown</a></div>
					  <div class="am-panel-bd">
					       <p class="am-kai">{{ trans('bbs.title') }} &nbsp; {{ trans('bbs.strong') }}</p>
					       <p class="am-kai">{{ trans('bbs.image') }} &nbsp; {{ trans('bbs.link') }}</p>
					  </div>
                 </div>
                 <div class="div-color-white am-margin-top-sm border-radius am-text-left am-padding-bottom">
                 	<form class="am-form" method="post" action="{{ action('Home\TopicController@update') }}">
                 	    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <input type="hidden"  name="topic_id" value="{{ $topic->id }}">
                 	    <div class="am-form-group am-padding-left-xs am-padding-right-xs">
                               <span class="am-kai  am-text-secondary " >{{ trans('bbs.Choose node') }}：</span>
                               <select name="node_id" class="am-input-sm border-radius" >
							        @foreach ($nodes as $node)
							        	 @if ($topic->node_id == $node->id)
                            <option value="{{ $node->id }}" selected="">{{ $node->name }}</option>
                         @else
                            <option value="{{ $node->id }}">{{ $node->name }}</option>
                         @endif
							        @endforeach
                               </select>
                               <span class="am-form-caret"></span>
                        </div>
                         <div class="am-form-group am-padding-left-xs am-padding-right-xs">
						       <span class="am-kai  am-text-secondary " >{{ trans('bbs.title content') }}：</span>
						       <input type="text" class="border-radius am-input-sm" name="title" readonly="" value="{{ $topic->title }}">
					    </div>
				         <div class="am-form-group am-padding-left-xs am-padding-right-xs am-padding-top-sm">
                           <span class="am-kai  am-text-secondary " >{{ trans('bbs.Please share your knowleage now!') }}：</span>
                           <textarea class="border-radius am-kai am-margin-top-sm" rows="15" name="content">{{ old('content') ?: $topic->content }}</textarea>
                      </div>
                      <button class="am-btn am-btn-secondary border-radius am-margin-left am-kai">{{ trans('bbs.post') }}</button>
                       <a class="am-btn am-text-muted border-radius am-margin-left am-kai am-text-sm" data-am-modal="{target: '#doc-modal-1',width: '600',height:'249'}">添加图片</a>
                    </form>
                 </div>
                 @include('layouts.partial.home.bottombar'){{-- 包含页底导航部分 --}}
            </div>
            <div class="am-u-sm-12 am-u-md-3 am-u-lg-3">
                  @include('layouts.partial.home.rightMenu')
            </div>
      </div>

      <div class="am-modal am-modal-no-btn " tabindex="-1" id="doc-modal-1">
          <div class="am-modal-dialog border-radius">
              <div class="am-modal-hd am-text-left">
                  <strong class="am-kai">{{ trans('bbs.Upload Image') }}</strong>
                  <a href="javascript: void(0)" class="am-close am-close-spin" data-am-modal-close>&times;</a>
                  <p class="am-text-muted am-text-sm">{{ trans('bbs.Upload Response') }}</p>
              </div>
              <div class="am-modal-bd am-text-left">
                    <form class="am-form am-form-horizontal" id="uploadForm" method="post" enctype="multipart/form-data" action="{{ route('upload.topicImage') }}">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <div class="am-form-group">
                             <div class="am-u-sm-10">
                                 <input type="file" name="image" required id="fileImage">
                             </div>
                             <div class="am-u-sm-2">
                              <button id="upload" class="am-btn am-btn-success border-radius" type="submit">{{ trans('bbs.upload') }}</button>
                             </div>
                        </div>
                    </form>
                    <hr data-am-widget="divider" style="" class="am-divider am-divider-default">
                    <div class="am-u-sm-12 responseInf am-text-left am-margin-top">
                       <p class="am-text-warning"></p>
                    </div>
              </div>
          </div>
      </div>

     <div class="am-modal am-modal-no-btn" tabindex="-1" id="modal-tip">
          <div class="am-modal-dialog border-radius" style="background-color: #c0c0c0">
              <div class="am-modal-hd am-kai am-text-left">{{ trans('bbs.tips') }}：
                <a href="javascript: void(0)" class="am-close am-close-spin" data-am-modal-close>&times;</a>
              </div>
              <div class="am-modal-bd am-text-left">
                 <p class="am-kai" name="tipContent"></p>
              </div>
          </div>
     </div>

      @include('layouts.partial.author')
        <script type="text/javascript" src="{{ asset('assets/js/jquery.form.js') }}"></script>
      <script type="text/javascript">

          jQuery(document).ready(function(){

          		jQuery("div.bottom-bar").css({width: '100%'});
          });
          (function(){


            jQuery("#uploadForm").ajaxForm({
              beforeSend:function(xhr,o){
                 jQuery("#upload").toggleClass("am-disabled",true);
                var file = document.getElementById("fileImage").files[0];
                if (!file.type.indexOf('image') == 0 || file.size > 204800 ) {
                   jQuery("#modal-tip").find("p[name='tipContent']").text("{{ trans('Image size') }}").end().modal('open');
                   xhr.abort();
                }
              },
              success:function(data, status, xhr){
                 jQuery("div.responseInf").find("p").text(data[0]);
                  jQuery("#upload").toggleClass("am-disabled",false);
              },
              complete:function(){
                 jQuery("#upload").toggleClass("am-disabled",false);
              },
              uploadProgress: function(event, position, total, percentComplete){
                jQuery("div.responseInf").find("p").text("{{ trans('bbs.progress') }}" + percentComplete + "%");
              },
            });
          })();
      </script>
 </body>
     @include('layouts.partial.html')