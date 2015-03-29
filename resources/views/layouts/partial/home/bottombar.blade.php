<div class="am-panel am-panel-default div-custom div-color-white bottom-bar">
	<div class="am-panel-hd am-kai">导航与链接&nbsp;&nbsp;<span class="am-icon-signal"></span> </div>
	<div class="am-g">
	    <div class="am-u-sm-12 am-u-md-3 am-u-lg-2">
	    		<p class="am-monospace default am-text-right">PHP</p>
	    </div>
	    <div class="am-u-sm-12 am-u-md-9 am-u-lg-10">
	    		<ul class="am-list horizontal">
	    		<li><a href="/nodes/7">php</a></li>
	    		<li><a href="/nodes/8">laravel</a></li>
	    		<li><a href="/nodes/9">composer</a></li>
	    		<li><a href="/nodes/14">开源项目</a></li>
	    		<li><a href="/nodes/11">设计模式</a></li>
	    		<li><a href="/nodes/10">重构</a></li>
	    		<li><a href="/nodes/12">Testing</a></li>
	    		<li><a href="/nodes/13">部署</a></li>
	    	</ul>
	    </div>
    </div>
    <div class="am-g ">
	    <div class="am-u-sm-12 am-u-md-3 am-u-lg-2">
	    		<p class="am-monospace default am-text-right">WEB开发</p>
	    </div>
	    <div class="am-u-sm-12 am-u-md-9 am-u-lg-10">
	    		<ul class="am-list horizontal">
	    		<li><a href="/nodes/15">MySQL</a></li>
	    		<li><a href="/nodes/16">Database</a></li>
	    		<li><a href="/nodes/17">Git</a></li>
	    		<li><a href="/nodes/18">linux</a></li>
	    		<li><a href="/nodes/19">WebServer</a></li>
	    		<li><a href="/nodes/20">算法</a></li>
	    		<li><a href="/nodes/21">运维</a></li>
	    		<li><a href="/nodes/22">安全</a></li>
	    		<li><a href="/nodes/23">云服务</a></li>
	    	</ul>
	    </div>
    </div>
    <div class="am-g">
	    <div class="am-u-sm-12 am-u-md-3 am-u-lg-2">
	    		<p class="am-monospace default am-text-right">Mobile</p>
	    </div>
	    <div class="am-u-sm-12 am-u-md-9 am-u-lg-10">
	    		<ul class="am-list horizontal">
	    		<li><a href="/nodes/24">iPhone</a></li>
	    		<li><a href="/nodes/25">Android</a></li>
	    	</ul>
	    </div>
    </div>
    <div class="am-g">
	    <div class="am-u-sm-12 am-u-md-3 am-u-lg-2">
	    		<p class="am-monospace default am-text-right">Languages</p>
	    </div>
	    <div class="am-u-sm-12 am-u-md-9 am-u-lg-10">
	    		<ul class="am-list horizontal">
		    		<li><a href="/nodes/26">JavaScript</a></li>
		    		<li><a href="/nodes/28">Python</a></li>
		    		<li><a href="/nodes/27">Ruby</a></li>
	    		    <li><a href="/nodes/29">Golang</a></li>
	    		    <li><a href="/nodes/30">Erlang</a></li>
	    	   </ul>
	    </div>
    </div>
    <div class="am-g">
	    <div class="am-u-sm-12 am-u-md-3 am-u-lg-2">
	    		<p class="am-monospace default am-text-right">社区</p>
	    </div>
	    <div class="am-u-sm-12 am-u-md-9 am-u-lg-10">
	    		<ul class="am-list horizontal">
		    		<li ><a class="am-text-muted">公告</a></li>
		    		<li><a  class="am-text-muted">反馈</a></li>
		    		<li><a  class="am-text-muted">社区维护</a></li>
	    		    <li><a  class="am-text-muted">线下讨论</a></li>
	    	   </ul>
	    </div>
    </div>
    <div class="am-g">
	    <div class="am-u-sm-12 am-u-md-3 am-u-lg-2">
	    		<p class="am-monospace default am-text-right">分享</p>
	    </div>
	    <div class="am-u-sm-12 am-u-md-9 am-u-lg-10">
	    		<ul class="am-list horizontal">
		    		<li><a class="am-text-muted">书籍</a></li>
		    		<li><a class="am-text-muted">工具</a></li>
		    		<li><a class="am-text-muted">其他</a></li>
	    		    <li><a class="am-text-muted">求职</a></li>
	    	   </ul>
	    </div>
    </div>
    <div class="am-g">
	    <div class="am-u-sm-12 am-u-md-3 am-u-lg-2">
	    		<p class="am-monospace default am-text-right">友情链接</p>
	    </div>
	    <div class="am-u-sm-12 am-u-md-9 am-u-lg-10">
	    		<ul class="am-list horizontal">
		    		<li><a href="https://github.com/" target="_blank">GitHub</a></li>
		    		<li><a href="http://www.bootcss.com/" target="_blank">BootStrap</a></li>
		    		<li><a href="http://amazeui.org/" target="_blank">Amaze UI</a></li>
	    		    <li><a href="http://www.golaravel.com/" target="_blank">Laravel</a></li>
	    		    <li><a href="http://www.w3school.com.cn/" target="_blank">W3C School</a></li>
	    	   </ul>
	    </div>
    </div>
</div>
<script type="text/javascript">
	jQuery(document).ready(function(){
		function toggleAlign() {
			var togglep = jQuery("div.bottom-bar").find("p.default");
			if (jQuery(window).width() > 640) {
				togglep.toggleClass("am-text-right",true).toggleClass("am-text-left",false);
			}
			else {
				togglep.toggleClass("am-text-right",false).toggleClass("am-text-left",true);
			}
		}
		toggleAlign();
		jQuery(window).resize(function(){
			toggleAlign();
		});
	});
</script>