 @include('layouts.partial.header')

 <body>
   @include('layouts.partial.home.topbar')

   <div class="am-alert am-alert-warning div-custom am-text-left {{ count($errors) > 0 ? 'am-show' : 'am-hide' }}" data-am-alert>
        <button type="button" class="am-close">&times;</button>
        @foreach ($errors->all() as $error)
          	<p>{{ $error }}</p>
          @endforeach
   </div>

    @include('layouts.partial.operationTips')

   <div class="am-g div-custom am-padding-bottom-xl div-color-white">
   	  <div class="am-usm-12 am-u-md-4 am-u-lg-4 am-padding-top-xl">
   	  	<img src="{{ asset('image/bbs.png') }} " alt="bbsIcon">
   	  	<p class="am-kai">让我们一起自由交流，分享知识吧，Let's Go！</p>
   	  </div>
   	  <div class="am-usm-12 am-u-md-8 am-u-lg-8">
   	  	   <div class="am-tabs am-margin-top-lg" data-am-tabs>
			  <ul class="am-tabs-nav am-nav am-nav-tabs am-kai">
				    <li class="am-active"><a href="#tab1">登录</a></li>
				    <li><a href="#tab2">注册</a></li>
				    <li><a href="#tab3">忘记密码</a></li>
			  </ul>

			  <div class="am-tabs-bd" style="min-height: 256px">
				    <div class="am-tab-panel am-fade am-in am-active am-text-left" id="tab1">
                         <form class="am-form am-form-horizontal am-margin-top-lg" method="post" action="{{ action('Home\UserController@login') }}">
                              <input type="hidden" name="_token" value="{{ csrf_token() }}">
							  <div class="am-form-group">
							    <label for="email" class="am-u-sm-2 am-form-label">电子邮件：</label>
							    <div class="am-u-sm-10">
							      <input type="email" name="email" placeholder="email" class="border-radius">
							    </div>
							  </div>

							  <div class="am-form-group">
							    <label for="password" class="am-u-sm-2 am-form-label">密码：</label>
							    <div class="am-u-sm-10">
							      <input type="password" name="password" placeholder="password" class="border-radius">
							    </div>
							  </div>

							  <div class="am-form-group">
							    <div class="am-u-sm-offset-2 am-u-sm-10">
							      <div class="checkbox">
							        <label>
							          <input type="checkbox" name="remember"> 记住我
							        </label>
							      </div>
							    </div>
							  </div>

							  <div class="am-form-group">
							    <div class="am-u-sm-10 am-u-sm-offset-2">
							      <button type="submit" class="am-btn am-btn-secondary border-radius">登录</button>
							    </div>
							  </div>
					     </form>

				    </div>
				    <div class="am-tab-panel am-fade am-text-left" id="tab2">
				        <form class="am-form am-form-horizontal" method="post" action="{{ action('Home\UserController@create') }}">
				               <input type="hidden" name="_token" value="{{ csrf_token() }}">
							  <div class="am-form-group">
							    <label for="email" class="am-u-sm-2 am-form-label">邮件：</label>
							    <div class="am-u-sm-10">
							      <input type="email" name="email" class="border-radius" value="{{ count($errors) > 0 ? old('email') : ' ' }}">
							    </div>
							  </div>

							  <div class="am-form-group">
							    <label for="user_name" class="am-u-sm-2 am-form-label">用户名：</label>
							    <div class="am-u-sm-10">
							      <input type="text" name="user_name"  class="border-radius" value="{{ count($errors) > 0 ? old('user_name') : ' ' }}">
							    </div>
							  </div>

							  <div class="am-form-group">
							    <label for="password" class="am-u-sm-2 am-form-label">密码：</label>
							    <div class="am-u-sm-10">
							      <input type="password" name="password" placeholder="密码" class="border-radius">
							    </div>
							  </div>
							  <div class="am-form-group">
							    <label for="password_confirmation" class="am-u-sm-2 am-form-label">确认密码：</label>
							    <div class="am-u-sm-10">
							      <input type="password" name="password_confirmation" placeholder="确认密码" class="border-radius">
							    </div>
							  </div>

							  <div class="am-form-group">
							    <div class="am-u-sm-10 am-u-sm-offset-2">
							      <button type="submit" class="am-btn am-btn-success border-radius">注册</button>
							    </div>
							  </div>
						</form>

				    </div>
				    <div class="am-tab-panel am-fade am-text-left" id="tab3">
				    	<form class="am-form am-form-horizontal" method="post" action="{{ action('Home\UserController@exist') }}">
				    	   <input type="hidden" name="_token" value="{{ csrf_token() }}">
				    	   <div class="am-form-group">
							    <label for="email" class="am-u-sm-2 am-form-label">邮件：</label>
							    <div class="am-u-sm-10">
							      <input type="email" name="email" class="border-radius" required>
							    </div>
							  </div>

							  <div class="am-form-group">
							    <label for="user_name" class="am-u-sm-2 am-form-label">用户名：</label>
							    <div class="am-u-sm-10">
							      <input type="text" name="user_name"  class="border-radius" placeholder="可选">
							    </div>
							  </div>

							  <div class="am-form-group">
							    <div class="am-u-sm-10 am-u-sm-offset-2">
							      <button type="submit" class="am-btn am-btn-success border-radius">提交</button>
							    </div>
							  </div>
				    	</form>
				    	<div class="am-u-sm-12 am-text-left am-margin-top">
				    		<p class="am-kai am-text-muted">请您填写必要的信息，我们将在验证正确之后向您发送一份用于重设密码的邮件</p>
				    	</div>
				    </div>
	           </div>
            </div>
      </div>
   </div>

   @include('layouts.partial.author')

 </body>
  @include('layouts.partial.html')