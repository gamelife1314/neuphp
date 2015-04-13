@extends('layouts.admin.layout')

@section('content')
	<div class="am-u-sm-12 bg-white border-radius am-text-left">
		<p class="am-kai am-margin-bottom-xs">站长: &nbsp;&nbsp;<a href="{{ route('read.user',Auth::id()) }}" class="inline"><span class="am-text-warning">{{ Auth::user()->name }}</span></a></p>
	</div>
	<div class="am-u-sm-12  am-text-left marginTop bg-white border-radius am-text-muted am-kai am-text-muted" id="home">
	    <ul class="am-list am-list-static">
           <li>•&nbsp;本页将展示与站点相关的数据</li>
           <li>•&nbsp;管理员在修改与站点相关的数据时敬请务必小心</li>
           <li>•&nbsp;我们设计了自动维护系统可以检查数据库的中的无效数据并进行自动维护，但是请您慎重选择</li>
           <li>•&nbsp;<span><a href="{{ route('admin.autofix') }}" class="inline" data-am-modal="{target: '#my-modal-loading',closeViaDimmer: 0}" >点击维护</a></span></li>
        </ul>
	</div>

	<div class="am-u-sm-12 bg-white border-radius am-text-left marginTop am-kai" id="site">
	    <ul class="am-list am-list-static">
	     <li>•&nbsp;当前注册人数：{{ $site_state->register_count }}&nbsp;&nbsp;&nbsp;人</li>
	     <li>•&nbsp;当前发帖总数：{{ $site_state->topic_count }}&nbsp;&nbsp;&nbsp;条</li>
	     <li>•&nbsp;当前回复总数：{{ $site_state->reply_count }}&nbsp;条</li>
	     <li>•&nbsp;系统表情总数：{{ $site_state->emjoy_count }}&nbsp;&nbsp;&nbsp;&nbsp;个</li>
	     <li>•&nbsp;系统头像总数：{{ $site_state->avatars_count }}&nbsp;&nbsp;&nbsp;&nbsp;个</li>
	     <li>•&nbsp;<span><a href="{{ route('update.site_state') }}" class="inline">更新站点状态</a></span></li>
	    </ul>
	</div>

	<div class="am-u-sm-12 bg-white border-radius am-text-left marginTop am-kai  paddingLeft-0 paddingRight-0">
		 <div class="am-panel am-panel-default marginBottom-0" style="border: none">
			  <div class="am-panel-hd">站点公告</div>
			  <div class="am-panel-bd">
			    <ul class="am-list am-list-static tip">
			      @foreach ($tips as $tip)
			      	<li>•&nbsp;&nbsp;<span class="am-text-primary">{{ $tip->content }}</span>&nbsp;&nbsp;<a href="{{ route('tip.delete',$tip->id) }}" class="am-text-muted inline"><span class="am-icon-trash"></span></a></li>
			      @endforeach
			    </ul>
			  </div>
		</div>
		<form action="{{ action('Admin\AdminController@addTip') }}" method="post" class="am-form am-form-horizontal marginTop">
			<input type="hidden" name="_token" value="{{ csrf_token() }}">
			 <div class="am-form-group">
			    <label for="content" class="am-u-sm-2 am-form-label">公告内容：</label>
			    <div class="am-u-sm-10">
			       <textarea class="border-radius" rows="5" name="content" required></textarea>
			    </div>
            </div>
            <button type="submit" class="am-btn am-btn-secondary border-radius am-fr am-margin-right am-margin-bottom">添加</button>
		</form>
	</div>

	<div class="am-u-sm-12 bg-white border-radius am-text-left marginTop am-kai  paddingLeft-0 paddingRight-0" id="about">
	     <div class="am-panel am-panel-default marginBottom-0" style="border: none">
			  <div class="am-panel-hd">关于我们</div>
			  <div class="am-panel-bd">
			    <form action="{{ action('Admin\AdminController@updateAbout') }}" method="post" class="am-form am-form-horizontal marginTop">
					 <input type="hidden" name="_token" value="{{ csrf_token() }}">
					 <div class="am-form-group">
					    <label for="content" class="am-u-sm-2 am-form-label">About Us：</label>
					    <div class="am-u-sm-10">
					       <textarea class="border-radius" rows="10" name="body" required>{{ $abouts[0]->body }}</textarea>
					    </div>
		            </div>
		           <div class="am-form-group">
		           	   <div class="am-u-sm-12 am-text-right">
		          	        <button type="submit" class="am-btn am-btn-secondary border-radius ">更新</button>
		               </div>
		           </div>
				</form>
			  </div>
		</div>
	</div>

	<div class="am-u-sm-12 bg-white border-radius am-text-left marginTop am-kai  paddingLeft-0 paddingRight-0" id="document">
	     <div class="am-panel am-panel-default marginBottom-0" style="border: none">
			  <div class="am-panel-hd">站点文档</div>
			  <div class="am-panel-bd">
			    <ul class="am-list am-list-static tip">
			      @foreach ($documents as $document)
			      	<li>•&nbsp;&nbsp;<span class="am-text-primary">{{ $document->name }}</span>&nbsp;&nbsp;<a href="{{ route('delete.document',$document->id) }}" class="am-text-muted inline"><span class="am-icon-trash"></span></a></li>
			      @endforeach
			    </ul>
			      <form action="{{ action('Admin\AdminController@addDocument') }}" method="post" class="am-form am-form-horizontal marginTop">
                  <input type="hidden" name="_token" value="{{ csrf_token() }}">
                  <div class="am-form-group">
					    <label for="name" class="am-u-sm-2 am-form-label">名称：</label>
					    <div class="am-u-sm-10">
					      <input type="text" name="name" placeholder="文档名称" required class="border-radius">
					    </div>
		           </div>
		           <div class="am-form-group">
					    <label for="name" class="am-u-sm-2 am-form-label ">url：</label>
					    <div class="am-u-sm-10">
					      <input type="url" name="url" placeholder="文档链接" required class="border-radius">
					    </div>
		           </div>
                  <div class="am-form-group">
		           	   <div class="am-u-sm-12 am-text-right">
		          	        <button type="submit" class="am-btn am-btn-secondary border-radius ">添加</button>
		               </div>
		           </div>
			      </form>
			  </div>
		</div>
	</div>

	<div class="am-u-sm-12 bg-white border-radius am-text-left marginTop am-kai  paddingLeft-0 paddingRight-0" id="markdown">
	     <div class="am-panel am-panel-default marginBottom-0" style="border: none">
			  <div class="am-panel-hd">Markdown</div>
			  <div class="am-panel-bd">
			    <form action="{{ action('Admin\AdminController@updateMarkdown') }}" method="post" class="am-form am-form-horizontal marginTop">
					 <input type="hidden" name="_token" value="{{ csrf_token() }}">
					 <div class="am-form-group">
					    <label for="content" class="am-u-sm-2 am-form-label">Markdown：</label>
					    <div class="am-u-sm-10">
					       <textarea class="border-radius" rows="10" name="body" required>{{ $markdown[0]->body }}</textarea>
					    </div>
		            </div>
		           <div class="am-form-group">
		           	   <div class="am-u-sm-12 am-text-right">
		          	        <button type="submit" class="am-btn am-btn-secondary border-radius ">更新</button>
		               </div>
		           </div>
				</form>
			  </div>
		</div>
	</div>

	<div class="am-u-sm-12 bg-white border-radius am-text-left marginTop am-kai  paddingLeft-0 paddingRight-0" id="node">
	     <div class="am-panel am-panel-default marginBottom-0" style="border: none">
			  <div class="am-panel-hd">节点管理</div>
			  <div class="am-panel-bd">
			    <form action="{{ action('Admin\AdminController@addNode') }}" method="post" class="am-form am-form-horizontal marginTop">
					 <input type="hidden" name="_token" value="{{ csrf_token() }}">
					 <div class="am-form-group">
					    <label for="content" class="am-u-sm-2 am-form-label">根节点：</label>
					    <div class="am-u-sm-10">
					      <label class="am-radio-inline">
					          <input type="radio" name="root" value="1" id="yes">是
					      </label>
					      <label class="am-radio-inline">
					          <input type="radio" name="root" value="0" checked="" id="no">否
					      </label>
					    </div>
		            </div>
		            <div class="am-form-group">
		            	<label for="content" class="am-u-sm-2 am-form-label">选择根节点：</label>
		            	<div class="am-u-sm-10">
		            		 <select name="parent" class="border-radius am-input-sm">
		            		   @foreach ($parentNodes as $parentNode)
		            		   	<option value="{{ $parentNode->id }}">{{ $parentNode->name }}</option>
		            		   @endforeach
		            		 </select>
		            	</div>
		            </div>
		            <div class="am-form-group">
		            	<label for="content" class="am-u-sm-2 am-form-label">名称：</label>
		            	<div class="am-u-sm-10">
					      <input type="text" name="name" placeholder="节点名称" required class="border-radius am-input-sm">
					    </div>
		            </div>
		            <div class="am-form-group">
		            	<label for="content" class="am-u-sm-2 am-form-label">描述：</label>
		            	<div class="am-u-sm-10">
					      <input type="text" name="description" placeholder="结点描述" required class="border-radius am-input-sm">
					    </div>
		            </div>
		           <div class="am-form-group">
		           	   <div class="am-u-sm-12 am-text-right">
		          	        <button type="submit" class="am-btn am-btn-secondary border-radius ">添加</button>
		               </div>
		           </div>
				</form>
			  </div>
		 </div>
  </div>

   <div class="am-u-sm-12 bg-white border-radius am-text-left marginTop am-kai  paddingLeft-0 paddingRight-0" id="user">
	     <div class="am-panel am-panel-default marginBottom-0" style="border: none">
			  <div class="am-panel-hd">用户管理</div>
			  <div class="am-panel-bd">
			    <form action="{{ action('Admin\AdminController@banUser') }}" method="post" class="am-form am-form-horizontal marginTop">
					 <input type="hidden" name="_token" value="{{ csrf_token() }}">
					  <div class="am-form-group">
			            	<label for="content" class="am-u-sm-2 am-form-label">搜索：</label>
			            	<div class="am-u-sm-10">
			            		 <select name="evidence" class="border-radius am-input-sm">
			            		   <option value="1">id</option>
			            		   <option value="2">name</option>
			            		 </select>
			            	</div>
		              </div>
		               <div class="am-form-group">
		            	<label for="content" class="am-u-sm-2 am-form-label">凭据：</label>
		            	<div class="am-u-sm-10">
					      <input type="text" name="name" placeholder="id仅为数字" required class="border-radius am-input-sm">
					    </div>
		            </div>

		           <div class="am-form-group">
		           	   <div class="am-u-sm-12 am-text-right">
		          	        <button type="submit" class="am-btn am-btn-secondary border-radius ">禁用用户</button>
		               </div>
		           </div>
				</form>
				<form action="{{ action('Admin\AdminController@sendEmail') }}" method="post" class="am-form am-form-horizontal marginTop">
					 <input type="hidden" name="_token" value="{{ csrf_token() }}">
		               <div class="am-form-group">
		            	<label for="content" class="am-u-sm-2 am-form-label">名称：</label>
		            	<div class="am-u-sm-10">
					      <input type="text" name="name" required class="border-radius am-input-sm">
					    </div>
		            </div>

		           <div class="am-form-group">
		           	   <div class="am-u-sm-12 am-text-right">
		          	        <button type="submit" class="am-btn am-btn-secondary border-radius ">激活邮件</button>
		               </div>
		           </div>
				</form>
				<form action="{{ action('Admin\AdminController@activeUser') }}" method="post" class="am-form am-form-horizontal marginTop">
					 <input type="hidden" name="_token" value="{{ csrf_token() }}">
		               <div class="am-form-group">
		            	<label for="content" class="am-u-sm-2 am-form-label">名称：</label>
		            	<div class="am-u-sm-10">
					      <input type="text" name="name" required class="border-radius am-input-sm">
					    </div>
		            </div>

		           <div class="am-form-group">
		           	   <div class="am-u-sm-12 am-text-right">
		          	        <button type="submit" class="am-btn am-btn-secondary border-radius ">激活用户</button>
		               </div>
		           </div>
				</form>
			  </div>
		</div>
	</div>

	<div class="am-u-sm-12 bg-white border-radius am-text-left marginTop am-kai  paddingLeft-0 paddingRight-0" id="topic">
	     <div class="am-panel am-panel-default marginBottom-0" style="border: none">
			  <div class="am-panel-hd">帖子管理</div>
			  <div class="am-panel-bd">
			   @foreach ($topics as $topic)
			   	<div class="am-u-sm-1">{{ $topic->id }}</div>
			    <div class="am-u-sm-7 am-text-truncate"><a href="{{ route('read.topic',$topic->id) }}">{{ $topic->title }}</a></div>
			    <div class="am-u-sm-4">
			   	   &nbsp;&nbsp;<a href="{{ route('excellent.topic',$topic->id) }}" class="am-text-muted operation"><span class="am-icon-trophy inline-block" title="精华"></span>&nbsp;&nbsp;</a>•
                   &nbsp;&nbsp;<a href="{{ route('stick.topic',$topic->id) }}" class="am-text-muted operation" ><span class="am-icon-thumb-tack inline-block" title="置顶"></span>&nbsp;&nbsp;</a>•
                   &nbsp;&nbsp;<a href="{{ route('admin.delete.topic',$topic->id) }}" class="am-text-muted operation" onclick="return confirm('您确定要删除？')"><span class="am-icon-trash inline-block" title="删除"></span>&nbsp;&nbsp;</a>•
                   &nbsp;&nbsp;<a href="{{ route('recommend.topic',$topic->id) }}" class="am-text-muted operation" ><span class="am-icon-thumbs-up inline-block" title="推荐"></span>&nbsp;&nbsp;</a>•
                   &nbsp;&nbsp;<a href="{{ route('admin.recommend',$topic->id) }}" class="am-text-muted operation" ><span class="am-icon-angellist inline-block" title="站长推荐"></span>&nbsp;&nbsp;</a>•
                   &nbsp;&nbsp;<a href="{{ route('wiki.topic',$topic->id) }}" class="am-text-muted operation" ><span class="am-icon-won inline-block" title="Wiki"></span>&nbsp;&nbsp;</a>
			    </div>
			   @endforeach
			  </div>
			  <hr data-am-widget="divider" style="" class="am-divider am-divider-default"/>
			  <div class="am-panel-footer bg-white laravel-pagination am-u-sm-12 am-margin-bottom" style="border-top: none;">
                     {!! $topics->fragment('topic')->render() !!}
              </div>
		</div>
	</div>

	<div class="am-modal am-modal-loading am-modal-no-btn" tabindex="-1" id="my-modal-loading">
    <div class="am-modal-dialog border-radius">
    <div class="am-modal-hd">正在维护</div>
    <div class="am-modal-bd">
      <span class="am-icon-spinner am-icon-spin"></span>
    </div>
  </div>
</div>
@stop

