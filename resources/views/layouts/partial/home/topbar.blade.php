<header class="am-topbar topbar-color-custom am-padding-left-xl am-padding-right-xl">
  <h1 class="am-topbar-brand">
    <a href="/">NEU PHP</a>
  </h1>

  <button class="am-topbar-btn am-topbar-toggle am-btn am-btn-sm am-btn-success am-show-sm-only" data-am-collapse="{target: '#doc-topbar-collapse'}"><span class="am-sr-only">导航切换</span> <span class="am-icon-bars"></span></button>

  <div class="am-collapse am-topbar-collapse" id="doc-topbar-collapse">
    <ul class="am-nav am-nav-pills am-topbar-nav">
      <li><a href="/community">社区</a></li>
      <li><a href="/wiki">Wiki</a></li>
      <li><a href="/member">会员</a></li>
      <li><a href="/about">关于</a></li>
      <li><a href="/documents">文档</a></li>
      <li><a href="https://github.com/gamelife1314/neuphp" target="_blank">源码</a></li>
      <li><a href="/markdowm">Markdown</a></li>
    </ul>

    <form class="am-topbar-form am-topbar-left am-form-inline" role="search">
      <div class="am-form-group">
        <input type="text" class="am-form-field am-input-sm" placeholder="search">
      </div>
    </form>

    <div class="am-topbar-right">
      <button class="am-btn am-topbar-btn am-btn-success button-round-custom">
        <i class="am-icon-drupal"></i>
        登录
      </button>
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
