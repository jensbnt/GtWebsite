@if(Session::has('info'))
    <div class="alert alert-dark" role="alert">
        {{ Session::get('info') }}
    </div>
@elseif(Session::has('fail'))
    <div class="alert alert-danger" role="alert">
        {{ Session::get('fail') }}
    </div>
@elseif(Session::has('compare'))
    <div class="alert alert-info" role="alert">
        {{ Session::get('compare') }} ♦ <a href="{{ route('compare.index') }}">Compare</a>
    </div>
@endif