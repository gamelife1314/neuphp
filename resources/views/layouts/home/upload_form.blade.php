
 @include('layouts.partial.header')
 <body>

 <div class="am-g">
 	<div class="am-u-sm-12">
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


</body>
 @include('layouts.partial.html')