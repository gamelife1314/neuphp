<div class="am-panel am-panel-default div-custom div-color-white">
	<div class="am-panel-hd">导航与链接</div>
	<div class="am-g">
	    <div class="am-u-sm-12 am-u-md-3 am-u-lg-2">
	    		<p class="am-monospace default am-text-right">PHP</p>
	    </div>
	    <div class="am-u-sm-12 am-u-md-9 am-u-lg-10">
	    		<ul class="am-list horizontal">
	    		<li><a href="">laravel</a></li>
	    		<li><a href="">composer</a></li>
	    		<li><a href="">开源项目</a></li>
	    		<li><a href="">设计模式</a></li>
	    		<li><a href="">重构</a></li>
	    	</ul>
	    </div>
    </div>
    <div class="am-g ">
	    <div class="am-u-sm-12 am-u-md-3 am-u-lg-2">
	    		<p class="am-monospace default am-text-right">WEB开发</p>
	    </div>
	    <div class="am-u-sm-12 am-u-md-9 am-u-lg-10">
	    		<ul class="am-list horizontal">
	    		<li><a href="">MySQL</a></li>
	    		<li><a href="">Database</a></li>
	    		<li><a href="">Git</a></li>
	    		<li><a href="">linux</a></li>
	    		<li><a href="">WebServer</a></li>
	    	</ul>
	    </div>
    </div>
    <div class="am-g">
	    <div class="am-u-sm-12 am-u-md-3 am-u-lg-2">
	    		<p class="am-monospace default am-text-right">Mobile</p>
	    </div>
	    <div class="am-u-sm-12 am-u-md-9 am-u-lg-10">
	    		<ul class="am-list horizontal">
	    		<li><a href="">iPhone</a></li>
	    		<li><a href="">Android</a></li>
	    	</ul>
	    </div>
    </div>
    <div class="am-g">
	    <div class="am-u-sm-12 am-u-md-3 am-u-lg-2">
	    		<p class="am-monospace default am-text-right">Languages</p>
	    </div>
	    <div class="am-u-sm-12 am-u-md-9 am-u-lg-10">
	    		<ul class="am-list horizontal">
		    		<li><a href="">JavaScript</a></li>
		    		<li><a href="">Python</a></li>
		    		<li><a href="">Ruby</a></li>
	    		    <li><a href="">Golang</a></li>
	    	   </ul>
	    </div>
    </div>
    <div class="am-g">
	    <div class="am-u-sm-12 am-u-md-3 am-u-lg-2">
	    		<p class="am-monospace default am-text-right">社区</p>
	    </div>
	    <div class="am-u-sm-12 am-u-md-9 am-u-lg-10">
	    		<ul class="am-list horizontal">
		    		<li><a href="">公告</a></li>
		    		<li><a href="">反馈</a></li>
		    		<li><a href="">社区开发</a></li>
	    		    <li><a href="">线下讨论</a></li>
	    	   </ul>
	    </div>
    </div>
    <div class="am-g">
	    <div class="am-u-sm-12 am-u-md-3 am-u-lg-2">
	    		<p class="am-monospace default am-text-right">分享</p>
	    </div>
	    <div class="am-u-sm-12 am-u-md-9 am-u-lg-10">
	    		<ul class="am-list horizontal">
		    		<li><a href="">书籍</a></li>
		    		<li><a href="">工具</a></li>
		    		<li><a href="">其他</a></li>
	    		    <li><a href="">求职</a></li>
	    	   </ul>
	    </div>
    </div>
    <div class="am-g">
	    <div class="am-u-sm-12 am-u-md-3 am-u-lg-2">
	    		<p class="am-monospace default am-text-right">友情链接</p>
	    </div>
	    <div class="am-u-sm-12 am-u-md-9 am-u-lg-10">
	    		<ul class="am-list horizontal">
		    		<li><a href="">GitHub</a></li>
		    		<li><a href="">BootStrap</a></li>
		    		<li><a href="">AmazeUI</a></li>
	    		    <li><a href="">Laravel</a></li>
	    		    <li><a href="">W3CSchool</a></li>
	    	   </ul>
	    </div>
    </div>
</div>
<script type="text/javascript">
	jQuery(document).ready(function(){
		function toggleAlign() {
			var togglep = jQuery("div.am-panel").find("p.default");
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