 @include('layouts.partial.header')

 <body>
  <link rel="stylesheet" href="{{ asset('assets/css/cropper.css') }}">
   @include('layouts.partial.home.topbar')

   @include('layouts.partial.operationTips')

  <div class="am-g div-custom">
  	<div class="am-u-sm-3 am-u-md-3 am-u-lg-3">
  		<div class="am-g">
  			<div class="user-avatar am-u-sm-12 am-u-md-12 am-u-lg-12 div-color-white am-padding-bottom border-radius avatar-view">
  			     <img src="{{ asset($user->image_url) }}" alt="avatars" class="avatars-lg am-margin-top am-radius am-img-thumbnail">
  		    </div>
  		    <div class="am-u-sm-12 am-u-md-12 am-u-lg-12 am-margin-top div-color-white border-radius am-text-left">
  		    	<div class="am-margin-top" name="choose-avatars">
	  		         <button type="button" class="am-btn am-btn-secondary border-radius am-kai" data-am-modal="{target: '#doc-modal-1'}">{{ trans('bbs.Choose form library') }}</button>
	                @if (Auth::user()->language == 'zh-CN')
                     <span class="am-text-middle am-margin-left-sm am-kai am-text-muted">({{ trans('bbs.We recommend') }})</span>
                  @endif
  		    	</div>
                <div name="choose" class="am-margin-top am-margin-bottom">
                	<button type="button" class="am-btn am-btn-warning border-radius am-kai" data-am-modal="{target: '#avatar-modal',width: '820',height:'560'}">{{ trans('bbs.custome avatar') }}</button>
                	@if (Auth::user()->language == 'zh-CN')
                    <span class="am-text-middle am-margin-left-sm am-kai am-text-muted">({{ trans('bbs.carefully select') }})</span>
                  @endif
                </div>
  		    </div>
          <div class="am-u-sm-12 am-u-md-12 am-u-lg-12 am-margin-top-lg  div-color-white  border-radius am-text-left">
            {{--  <div class=""> --}}
                 <a href="{{ route('home.post') }}" style="color: white" class="am-btn am-btn-success border-radius am-margin-top am-margin-bottom am-kai am-padding-top-xs">{{ trans('bbs.post now') }}&nbsp;&nbsp;
                 </a>
                  {{-- <span class="am-text-middle am-margin-left-sm am-kai am-text-muted">({{ trans('bbs.post now') }})</span> --}}
           {{--   </div> --}}
          </div>
          {{-- 如果是站长 --}}
            {{-- <div class="am-u-sm-12 am-u-md-12 am-u-lg-12 am-margin-top-lg  div-color-white  border-radius am-text-left">
                 <a href="{{ route('admin') }}" style="color: white" class="am-btn am-btn-success border-radius am-margin-top am-margin-bottom am-kai am-padding-top-xs">{{ trans('bbs.manage site') }}&nbsp;&nbsp;</a>
          }
          </div> --}}

  		</div>
  	</div>
  	<div class="am-u-sm-9 am-u-md-9 am-u-lg-9">
         <div class="am-tabs div-color-white border-radius" data-am-tabs>
              <ul class="am-tabs-nav am-nav am-nav-tabs">
                <li class="am-active"><a href="#tab1" class="am-kai">{{ trans('bbs.Changge Information') }}</a></li>
                <li><a href="#tab2" class="am-kai">{{ trans('bbs.remind') }}&nbsp;<span class="am-badge am-badge-success am-radius tips">{{ $tips_count }}</span></a></li>
                <li><a href="#tab3" class="am-kai">{{ trans('bbs.change password') }}</a></li>
                <li><a href="#tab4" class="am-kai">{{ trans('bbs.setting') }}</a></li>
              </ul>

            <div class="am-tabs-bd">
              <div class="am-tab-panel am-fade am-text-left am-in am-active" id="tab1">
                 <form class="am-form am-form-horizontal" action="{{ action('Home\UserController@updateProfile') }}" method="post">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <input type="hidden"   name="id" value="{{ $user->id }}">
                         <div class="am-form-group">
                             <label for="doc-ipt-3" class="am-u-sm-2 am-form-label">{{ trans('bbs.email') }}：</label>
                             <div class="am-u-sm-10">
                                   <input type="email" name="email" readonly="" class="border-radius am-input-sm" value="{{ $user->email }}">
                             </div>
                         </div>
                         <div class="am-form-group">
                             <label for="doc-ipt-3" class="am-u-sm-2 am-form-label">{{ trans('bbs.nick name') }}：</label>
                             <div class="am-u-sm-10">
                                   <input type="text" name="name" readonly="" class="border-radius am-input-sm" value="{{ $user->name }}">
                             </div>
                         </div>
                         <div class="am-form-group">
                             <label for="doc-ipt-3" class="am-u-sm-2 am-form-label">{{ trans('bbs.name') }}：</label>
                             <div class="am-u-sm-10">
                                   <input type="text" name="real_name"  class="border-radius am-input-sm" value="{{ $user->real_name }}">
                             </div>
                         </div>
                         <div class="am-form-group">
                             <label for="doc-ipt-3" class="am-u-sm-2 am-form-label">{{ trans('bbs.autograph') }}：</label>
                             <div class="am-u-sm-10">
                                   <input type="text" name="autograph"  class="border-radius am-input-sm" value="{{ $user->autograph }}" required>
                             </div>
                         </div>
                         <div class="am-form-group">
                             <label for="doc-ipt-3" class="am-u-sm-2 am-form-label">GitHub：</label>
                             <div class="am-u-sm-10">
                                   <input type="url" name="github"  class="border-radius am-input-sm" placeholder="包含http://或者https://" value="{{ $user->github }}">
                             </div>
                         </div>
                         <div class="am-form-group">
                             <label for="doc-ipt-3" class="am-u-sm-2 am-form-label">{{ trans('bbs.city') }}：</label>
                             <div class="am-u-sm-10">
                                   <input type="text" name="city"  class="border-radius am-input-sm" value="{{ $user->city }}" placeholder="中国 · 辽宁 · 沈阳">
                             </div>
                         </div>
                         <div class="am-form-group">
                             <label for="doc-ipt-3" class="am-u-sm-2 am-form-label">{{ trans('bbs.university') }}：</label>
                             <div class="am-u-sm-10">
                                   <input type="text" name="university"  class="border-radius am-input-sm" value="{{ $user->university }}">
                             </div>
                         </div>
                         <div class="am-form-group">
                             <label for="doc-ipt-3" class="am-u-sm-2 am-form-label">{{ trans('bbs.major') }}：</label>
                             <div class="am-u-sm-10">
                                   <input type="text" name="major"  class="border-radius am-input-sm" value="{{ $user->major }}">
                             </div>
                         </div>
                         <div class="am-form-group">
                             <label for="doc-ipt-3" class="am-u-sm-2 am-form-label">{{ trans('bbs.personal website') }}：</label>
                             <div class="am-u-sm-10">
                                   <input type="url" name="personal_website"  class="border-radius am-input-sm" placeholder="包含http://或者https://" value="{{ $user->personal_website }}">
                             </div>
                         </div>
                         <div class="am-form-group">
                              <label for="doc-ipt-3" class="am-u-sm-2 am-form-label">{{ trans('bbs.description') }}：</label>
                              <div class="am-u-sm-10">
                                  <textarea class="border-radius am-kai" rows="3" name="introduction">{{ $user->introduction }}</textarea>
                              </div>
                         </div>
                         <hr data-am-widget="divider" style="" class="am-divider am-divider-default"/>
                         <button class="am-btn am-btn-secondary border-radius am-fr">{{ trans('bbs.update') }}</button>
                 </form>
              </div>

              <div class="am-tab-panel am-fade " id="tab2">
                  @foreach ($user_tips as $key => $user_tip)
                    <div class="am-g">
                      <div class="am-u-sm-1 am-text-right">
                          <p>{{ $key + 1 }}.</p>
                      </div>
                       <div class="am-u-sm-8 am-text-left">
                          {!! $user_tip->body !!}
                       </div>
                       <div class="am-u-sm-3">{{ $user_tip->created_at }}</div>
                    </div>
                  @endforeach
              </div>

              <div class="am-tab-panel am-fade " id="tab3">
                 <form class="am-form am-form-horizontal" method="post" action="{{ action('Home\UserController@updatePassword') }}">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <input type="hidden"   name="id" value="{{ $user->id }}">
                    <div class="am-form-group">
                             <label for="doc-ipt-3" class="am-u-sm-3 am-form-label">{{ trans('bbs.old password') }}：</label>
                             <div class="am-u-sm-9">
                                   <input type="password" name="old_password" class="border-radius am-input-sm">
                             </div>
                    </div>
                    <div class="am-form-group">
                             <label for="doc-ipt-3" class="am-u-sm-3 am-form-label">{{ trans('bbs.new password') }}：</label>
                             <div class="am-u-sm-9">
                                   <input type="password" name="new_password" class="border-radius am-input-sm">
                             </div>
                    </div>
                    <div class="am-form-group">
                             <label for="doc-ipt-3" class="am-u-sm-3 am-form-label">{{ trans('bbs.confirm new password') }}：</label>
                             <div class="am-u-sm-9">
                                   <input type="password" name="new_password_confirmation" class="border-radius am-input-sm">
                             </div>
                    </div>
                    <hr data-am-widget="divider" style="" class="am-divider am-divider-default">
                         <button class="am-btn am-btn-secondary border-radius am-fr">{{ trans('bbs.update') }}</button>
                 </form>
              </div>
              <div class="am-tab-panel am-fade " id="tab4">
                 <form class="am-form am-form-horizontal" method="post" action="{{ action('Home\UserController@set') }}">
                     <input type="hidden" name="_token" value="{{ csrf_token() }}">
                     <div class="am-form-group am-margin-top-sm">
                             <label for="doc-ipt-3" class="am-u-sm-2 am-form-label">{{ trans('bbs.choose language') }}：</label>
                             <div class="am-u-sm-10">
                                   <select class="am-input-sm border-radius" name="language">
                                          <option value="zh-CN">中文简体</option>
                                          <option value="en">English</option>
                                   </select>
                             </div>
                    </div>
                    <button class="am-btn am-btn-secondary border-radius am-fr" type="submmit">{{ trans('bbs.setting') }}</button>
                 </form>
              </div>
            </div>
          </div>

    </div>
  </div>
 {{-- 从库中选择 --}}
	 <div class="am-modal am-modal-no-btn" tabindex="-1" id="doc-modal-1">
		  <div class="am-modal-dialog">
			    <div class="am-modal-hd">
			      <span class="am-kai">{{ trans('bbs.choose tip') }}</span>
             <a href="javascript: void(0)" class="am-close am-close-spin" data-am-modal-close>&times;</a>
             <hr data-am-widget="divider" style="" class="am-divider am-divider-default"/>
			    </div>
			    <div class="am-modal-bd am-text-left avatar-choose">
			      <div class="am-g">
			      	 <div class="am-u-sm-12 am-u-md-12 am-u-lg-12">
			      	 	@foreach ($avatars_img as $index => $value)
                  <img src="{{ asset($value) }}" alt="avatars" class="avatars am-margin-xs am-radius am-img-thumbnail" data-id="{{ $index + 1}}">
                @endforeach
                <hr data-am-widget="divider" style="" class="am-divider am-divider-default"/>
			      	 </div>
			      	 <div class="am-u-sm-12 am-u-md-12 am-u-lg-12">
			      	   <form class="am-form am-form-horizontal" method="post" action="{{ action('Home\UserController@updateAvatar') }}">
			      	      <input type="hidden" name="_token" value="{{ csrf_token() }}">
			      	      <input type="hidden"   name="focus_image_id" value="1">
                     <input type="hidden"   name="user_id" value="{{ $user->id }}">
                    <button type="submit" class="am-btn am-btn-success border-radius am-margin-top-sm" id="updateAvatar">{{ trans('bbs.save') }}</button>
			      	   </form>
			      	 </div>
			      </div>
			    </div>
		  </div>
	</div>{{-- 从库中选择结束 --}}


      <div class="am-modal am-modal-no-btn" tabindex="-1" id="avatar-modal">
         <div class="am-modal-dialog border-radius">
              <div class="am-modal-hd am-text-left">
                   <span class="am-kai"><strong>Change Avatar</strong></span>
                   <a href="javascript: void(0)" class="am-close am-close-spin" data-am-modal-close>&times;</a>
                   <hr data-am-widget="divider" style="" class="am-divider am-divider-default"/>
              </div>
              <div class="am-modal-bd">
                  <form class=" am-form am-form-horizontal" action="{{ action('Home\UserController@uploadAvatar') }}" method="post" id="changeAvatar">
                       <div class="am-form-group">
                           <input type="hidden"   name="_token" value="{{ csrf_token() }}">
                           <input type="hidden"   name="image_url" value="">
                           <input type="hidden"   name="user_id" value="{{ $user->id }}">
                           <div class="am-u-sm-10">
                                <input  class="avatar-input" id="avatarInput" name="avatar_file" type="file">
                           </div>
                      </div>
                      <div class="am-g">
                          <div class="am-u-sm-9 am-u-md-9 am-u-lg-9">
                              <div class="avatar-wrapper bbs-preview"></div>
                          </div>
                          <div class="am-u-sm-3 am-u-md-3 am-u-lg-3">
                              <div class="img-preview-lg am-margin-left-xs am-margin-top"></div>
                              <div class="img-preview-md am-margin-left-xs am-margin-top"></div>
                              <div class="img-preview-sm am-margin-left-xs am-margin-top"></div>
                          </div>
                      </div>
                       <hr data-am-widget="divider" style="" class="am-divider am-divider-default"/>
                        <div class="modal-footer am-text-right">
                              <button class="am-btn am-btn-secondary border-radius" type="submit" id="uploadAvatar">Save</button>
                        </div>
                  </form>
              </div>
         </div>
     </div>


  <div class="am-modal am-modal-loading am-modal-no-btn" tabindex="-1" id="my-modal-loading">
  <div class="am-modal-dialog">
    <div class="am-modal-hd">{{ trans('bbs.updating') }}</div>
    <div class="am-modal-bd">
      <span class="am-icon-spinner am-icon-spin"></span>
    </div>
  </div>
</div>

<div class="am-modal am-modal-no-btn" tabindex="-1" id="modal-tip">
  <div class="am-modal-dialog border-radius"  style="background-color: #c0c0c0">
    <div class="am-modal-hd am-text-left am-kai">{{ trans('bbs.tips') }}：
      <a href="javascript: void(0)" class="am-close am-close-spin" data-am-modal-close>&times;</a>
    </div>
    <div class="am-modal-bd am-text-left am-kai">
       {{ trans('bbs.change browser') }}
    </div>
  </div>
</div>

   @include('layouts.partial.author')

   <script type="text/javascript" src="{{ asset('assets/js/cropper.js') }}"></script>
   <script type="text/javascript">

    // jQuery("span.tips").parent('a').click(function(){
    //  jQuery(this).child('span').tetx('0');
    // });

    jQuery("div.avatar-choose img").click(function(e){
    	var focus = e.target;
      jQuery(this).siblings('img').toggleClass('image-choose-focus',false);
      jQuery(this).addClass('image-choose-focus');
      jQuery("input[name='focus_image_id']").val(jQuery(this).attr('data-id'));
    });

   jQuery("#updateAvatar").click(function(){
      jQuery("#doc-modal-1").modal('toggle');
      jQuery("#my-modal-loading").modal('open');
   });

   jQuery("#uploadAvatar").click(function(){
      jQuery("#avatar-modal").modal('toggle');
      jQuery("#my-modal-loading").modal('open');
   });

   jQuery("#uploadAvatar").click(function(event){
     event.preventDefault();
     if (jQuery("input[name='image_url']").val() == "") {
      return false;
     }
     jQuery("#changeAvatar").submit();
   });

  jQuery("#avatarInput").change(function(event) {
    var img_file = event.target.files[0];
    if (window.File && window.FileList && window.FileReader && window.Blob) {
        var reader = new FileReader();
        reader.onload = function(e) {
         var img = jQuery("<img src=" + e.target.result + " alt=" + img_file.name + " class='img-upload am-img-thumbnail'/>");
         jQuery("div.bbs-preview").html(img);

        var crop_image = jQuery(".bbs-preview > img");
        crop_image.cropper({
          aspectRatio: 1 / 1,
          strict : false,
           multiple: false,
           autoCrop: true,
           dragCrop: false,
           dashed: false,
           modal: true,
           movable: true,
          resizable: false,
           zoomable: true,
          rotatable: true,
          dragend: function(){
          var dataURL = crop_image.cropper("getDataURL");
           jQuery(".img-preview-lg").html('<img src="' + dataURL + '" class=' + 'am-img-thumbnail am-round' + '>');
           jQuery(".img-preview-md").html('<img src="' + dataURL + '" class=' + 'am-img-thumbnail am-round' + ' >');
           jQuery(".img-preview-sm").html('<img src="' + dataURL + '" class=' + 'am-img-thumbnail am-round' + '>');
           jQuery("input[name='image_url']").val(dataURL);
          },
          built:function(){
          var dataURL = crop_image.cropper("getDataURL");
           jQuery(".img-preview-lg").html('<img src="' + dataURL + '" class=' + 'am-img-thumbnail am-round' + '>');
           jQuery(".img-preview-md").html('<img src="' + dataURL + '" class=' + 'am-img-thumbnail am-round' + ' >');
           jQuery(".img-preview-sm").html('<img src="' + dataURL + '" class=' + 'am-img-thumbnail am-round' + '>');
           jQuery("input[name='image_url']").val(dataURL);
          },
        });
        };
        reader.onerror = function() {
          jQuery("#avatar-modal").modal('close');
          jQuery("#modal-tip").modal('open');
        };
        reader.readAsDataURL(img_file);
    }
    else {
        jQuery("#avatar-modal").modal('close');
        jQuery("#modal-tip").modal('open');
    }
  });
   </script>
    </body>
  @include('layouts.partial.html')