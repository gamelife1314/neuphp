<div class="am-panel-footer div-color-white" style="padding:0px;border-top:none">
    <ul class="am-pagination am-text-right am-padding-right bbs-pagination" style="margin:0px">
	 	     @if ($current_pid == 1)
		            <li class="am-disabled"><a href="#" class="a-mg-rt-5">&laquo;</a></li>
		       @else
		            <li class="prev"><a class = "cursor a-mg-rt-5" page-class="/{{ $siteNode }}/{{ $arg }}/" page-id="{{ $current_pid }}">&laquo;</a></li>
		       @endif

		       @for ($i = $current_pid; $i <= $max_pid; $i++)
		            @if ($i != $current_pid)
		                 <li><a href="/{{ $siteNode }}/{{ $arg }}/{{ $i }}" class="a-mg-rt-5">{{ $i }}</a></li>
		            @else
		                 <li class="am-active"><a href="/{{ $siteNode }}/{{ $arg }}/{{ $i }}" class="a-mg-rt-5">{{ $i }}</a></li>
		            @endif
		       @endfor

		      @if ($pageNumber > $max_pid)
		             <li class="am-disabled"><a href="#" class="a-mg-rt-5">...</a></li>
		             <li><a href="/{{ $siteNode }}/{{ $arg }}/{{ $pageNumber }}" class="a-mg-rt-5">{{ $pageNumber }}</a></li>
		      @endif

		     @if ($current_pid == $max_pid)
		         <li class="am-disabled"><a href="#" class="a-mg-rt-5">&raquo;</a></li>
		     @else
		         <li class="next"><a class = "cursor a-mg-rt-5" page-class="/{{ $siteNode }}/{{ $arg }}/" page-id="{{ $current_pid }}">&raquo;</a></li>
		     @endif

    </ul>
</div>