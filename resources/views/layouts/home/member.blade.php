 @include('layouts.partial.header')

  <body>

  @include('layouts.partial.home.topbar')

   @include('layouts.partial.operationTips')

<div class="am-g div-custom div-color-white">

      <div class="am-panel am-panel-default border-radius" style="margin-bottom:0px">
           <div class="am-panel-hd">
			      <p class="am-panel-title am-kai">{{ trans('bbs.community member') }}({{ count($bbsMember) }} )</p>
		   </div>
		   <div class="am-panel-bd">
          <div class="am-g">
              @foreach ($bbsMember as $index => $value)
                <div class="am-u-sm-3 am-u-md-2 am-u-lg-1 am-margin-top-sm">
                    <a href="{{ route('read.user',$value->id) }}">
                       <img src="{{ asset($value->image_url) }}" alt="{{ $value->name }}" class="avatars am-radius am-img-thumbnail {{ $value->active == 1 ? ' ' : 'gray' }}" title="{{ $value->name }}{{ $value->active == 1 ? ' ' : '，未激活' }}">
                    </a>
                </div>
              @endforeach
          </div>
		   </div>
      </div>

</div>

  @include('layouts.partial.author')

   <script type="text/javascript">
       jQuery("#doc-topbar-collapse").find("li").eq(2).addClass('am-active');
   </script>

  </body>
  @include('layouts.partial.html')