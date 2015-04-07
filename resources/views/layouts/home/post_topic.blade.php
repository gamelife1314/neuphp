 @include('layouts.partial.header')
 <body>
 	  @include('layouts.partial.home.topbar')

      @include('layouts.partial.operationTips')

      <div class="am-g div-custom ">
            <div class="am-u-sm-12 am-u-md-9 am-u-lg-9  border-radius" >
                 <div class="div-color-white border-radius am-padding-top-sm am-text-left">
                 	  <p class="am-kai am-margin-bottom-xs am-margin-left am-padding-bottom-sm">欢迎发帖！
                 	    <span class="am-text-muted am-text-sm">您的帖子是我们学习知识的重要渠道</span>
                 	  </p>
                 </div>
                 <div class="am-panel am-panel-success am-margin-top am-text-left">
                 	  <div class="am-panel-hd am-kai">发帖请使用&nbsp;<a href="{{ route('home.markdown') }}" target="_blank">Markdown</a>&nbsp;语法</div>
					  <div class="am-panel-bd">
					       <p class="am-kai">标题语法：#(1~6) 标题 &nbsp; 加粗语法：**加粗内容**</p>
					       <p class="am-kai">图片:  ![图片文字][图片地址] &nbsp; 链接：[链接标题](链接地址)</p>
					  </div>
                 </div>
                 <div class="div-color-white am-margin-top-sm border-radius am-text-left am-padding-bottom">
                 	<form class="am-form" method="post" action="{{ action('Home\TopicController@create') }}">
                 	    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <input type="hidden"   name="user_id" value="{{ Auth::id() }}">
                 	    <div class="am-form-group am-padding-left-xs am-padding-right-xs">
                               <span class="am-kai  am-text-secondary " >结点选择：</span>
                               <select name="node_id" class="am-input-sm border-radius" >
							        @foreach ($nodes as $node)
							        	<option value="{{ $node->id }}">{{ $node->name }}</option>
							        @endforeach
                               </select>
                               <span class="am-form-caret"></span>
                        </div>
                         <div class="am-form-group am-padding-left-xs am-padding-right-xs">
						       <span class="am-kai  am-text-secondary " >标题：</span>
						       <input type="text" class="border-radius am-input-sm" name="title" required value="{{ old('title') or '' }}">
					    </div>
				         <div class="am-form-group am-padding-left-xs am-padding-right-xs am-padding-top-sm">
                           <span class="am-kai  am-text-secondary " >请分享您的知识吧：</span>
                           <textarea class="border-radius am-kai am-margin-top-sm" rows="15" name="content">{{ old('content') or "" }}</textarea>
                      </div>
                      <button class="am-btn am-btn-secondary border-radius am-margin-left am-kai">发布</button>
                       <a class="am-btn am-text-muted border-radius am-margin-left am-kai am-text-sm" data-am-modal="{target: '#doc-modal-1',width: '820',height:'560'}">添加图片</a>
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
                  <strong class="am-kai">上传图片</strong>
                  <a href="javascript: void(0)" class="am-close am-close-spin" data-am-modal-close>&times;</a>
                  <p class="am-text-muted am-text-sm">图片上传采用异步方式，上传完成后，会返回图片在服务器中地址，您的浏览器需要支持HTML5</p>
              </div>
              <div class="am-modal-bd am-text-left">
                   <form class="am-form am-form-horizontal" enctype="multipart/form-data">
                          <div class="am-form-group">
                               <div class="am-u-sm-10">
                                   <input type="file" id="topicImage">
                               </div>
                               <div class="am-u-sm-2">
                                <button id="upload" class="am-btn am-btn-success border-radius">上传</button>
                               </div>
                          </div>
                   </form>
                  <hr data-am-widget="divider" style="" class="am-divider am-divider-default">
              </div>
          </div>
      </div>

     <div class="am-modal am-modal-no-btn" tabindex="-1" id="modal-tip">
          <div class="am-modal-dialog border-radius" style="background-color: #c0c0c0">
              <div class="am-modal-hd am-kai am-text-left">提醒：
                <a href="javascript: void(0)" class="am-close am-close-spin" data-am-modal-close>&times;</a>
              </div>
              <div class="am-modal-bd am-text-left">
                 <p class="am-kai" name="tipContent"></p>
              </div>
          </div>
     </div>

      @include('layouts.partial.author')
      <script type="text/javascript">

          jQuery(document).ready(function(){

          		jQuery("div.bottom-bar").css({width: '100%'});

              var topicImage = '';
              jQuery("#topicImage").change(function(event){
                   topicImage = event.target.files[0];
                  if (topicImage.size >= 1048577 || /image\/\W+/.test(topicImage.type)) {
                     jQuery("#modal-tip").find("p[name='tipContent']").text("文件需为图片且小于1M")
                                                  .end().modal('open');
                  }
              });

            //用于异步上传文件
             jQuery("#upload").click(function(event){
                event.preventDefault();
                var xhr = new XMLHttpRequest();
                xhr.open("post", "{{ route('upload.topicImage') }}");
                xhr.setRequestHeader('content-type','text/plain');
                xhr.onreadystatechange = function(e) {console.log(xhr.status);};
                xhr.send('hellow world');
              });

          });
      </script>
 </body>
     @include('layouts.partial.html')