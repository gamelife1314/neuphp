<header class="am-topbar topbar-color-custom am-padding-left-xl am-padding-right-xl">
  <h1 class="am-topbar-brand">
    <a href="{{ route('home') }}">NEU PHP</a>
  </h1>

  <button class="am-topbar-btn am-topbar-toggle am-btn am-btn-sm am-btn-success am-show-sm-only" data-am-collapse="{target: '#doc-topbar-collapse'}"><span class="am-sr-only">导航切换</span> <span class="am-icon-bars"></span></button>

  <div class="am-collapse am-topbar-collapse" id="doc-topbar-collapse">
    <ul class="am-nav am-nav-pills am-topbar-nav">
      <li><a href="{{ route('home.community') }}">{{ trans('bbs.Community') }}</a></li>
      <li><a href="{{ route('home.wiki') }}">Wiki</a></li>
      <li><a href="{{ route('home.member') }}">{{ trans('bbs.member') }}</a></li>
      <li><a href="{{ route('home.about') }}">{{ trans('bbs.about') }}</a></li>
      <li><a href="{{ route('home.documents') }}">{{ trans('bbs.document') }}</a></li>
      <li><a href="https://github.com/gamelife1314/neuphp" target="_blank">{{ trans('bbs.Source Code') }}</a></li>
      <li><a href="{{ route('home.markdown') }}">Markdown</a></li>
    </ul>

    <form class="am-topbar-form am-topbar-left am-form-inline" role="search" method="post" action="{{ action('Home\HomeController@search') }}">
      <input type="hidden" name="_token" value="{{ csrf_token() }}">
      <div class="am-form-group">
        <input type="text" class="am-form-field am-input-sm" placeholder="search" required name="keyword">
      </div>
    </form>

    <div class="am-topbar-right">
        @if (Auth::check() && !Auth::user()->is_banned)
          <div class="am-margin-top-sm">
            <a href="{{  route('read.user',Auth::id())  }}" class="am-margin-right-xs"><img src="{{ asset(Auth::user()->image_url) }}" alt="" class="am-radius am-img-thumbnail nav-avatars"></a>
            <a href="{{  route('edit.user',Auth::id())  }}" class="am-margin-right-xs"><span class="am-badge am-round am-text-secondary" title="{{ Auth::user()->tips }}条提醒">{{ Auth::user()->tips }}</span></a>
            <a href="{{  route('edit.user',Auth::id())  }}"><span  class="am-text-secondary">{{ Auth::user()->name }}</span></a>
            <a href="{{  route('logout') }}" class="am-margin-left-xs"><span class="am-icon-sign-out" title="退出"></span></a>
          </div>
        @else
           <a href="{{ route('login') }}" class="am-btn am-btn-secondary am-margin-top-xs border-radius am-padding-top-sm am-padding-bottom-xs"><i class="am-icon-drupal"></i>&nbsp;登录</a>
        @endif
    </div>
  </div>
</header>
<script type="text/javascript">
  jQuery(document).ready(function(){
    jQuery("form[role='search']").find("input").bind("focus",function(){
      jQuery(this).animate({
        width: "+=50px",
        paddingLeft: "+=10px"
      },"normal");
    }).blur(function(){
      jQuery(this).animate({
        width: "-=50px",
        paddingLeft: "-=10px"
      },"normal");
    });
  });
</script>
