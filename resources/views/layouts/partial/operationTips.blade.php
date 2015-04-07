
 @if (\Session::has('returnInf'))
      <div class="am-alert {{ session('operationResult') }} div-custom am-text-left" data-am-alert>
         <button type="button" class="am-close">&times;</button>
         @foreach (session('returnInf') as $element)
           <p class="am-kai">{!! $element !!}</p>
         @endforeach
      </div>
   @endif