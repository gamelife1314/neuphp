 @include('layouts.partial.header')

 <body>

    @include('layouts.partial.home.topbar')

      @include('layouts.partial.operationTips')

    <div class="am-g div-custom div-color-white markdown" id="parent">
          <div class="am-panel am-panel-default border-radius" style="margin-bottom:0px">
                <div class="am-panel-hd">
                      <p class="am-panel-title am-kai" data-am-collapse="{parent: '#parent', target: '#markdown'}">Markdown({{ trans('bbs.click to expand') }})</p>
                </div>
                <div id="markdown" class="am-panel-collapse am-collapse">
                       <div class="am-panel-bd am-text-left">
                        {!! $markdown !!}
                       </div>
               </div>
           </div>
     </div>

    <div class="am-g div-custom div-color-white markdown">
         <div class="am-panel am-panel-default border-radius" style="margin-bottom:0px">
             <div class="am-panel-hd">
                      <p class="am-panel-title am-kai am-text-left am-text-warning">Markdown {{ trans('bbs.edit online') }}：</p>
             </div>
             <div class="am-panel-bd am-text-left">
                     <form class="am-form am-form-horizontal" method="post" action="{{ action('Home\HomeController@viewMarkdownResult') }}">
                           <fieldset>
                           <input type="hidden" name="_token" value="{{ csrf_token() }}">
                           <div class="am-form-group">
                                   <textarea class="am-u-sm-10" rows="20" name="markdownInput">{!! $example !!}</textarea>
                          </div>
                          </fieldset>
                           <button type="submit"  class="am-btn am-btn-success border-radius">{{  trans('bbs.view result')  }}</button>
                      </form>
             </div>
         </div>
    </div>


    @include('layouts.partial.author')

   <script type="text/javascript">
       jQuery("#doc-topbar-collapse").find("li").eq(6).addClass('am-active');
       jQuery(".markdown").find("a").attr('target','_blank');
    </script>

    </body>
    @include('layouts.partial.html')