@foreach(request()->input() as $key => $value)
    @if($key != $self && request()->has($key))
        @if(is_array(request()->input($key)))
            @foreach(request()->input($key) as $item)
                <input type="hidden" name="{{$key}}[]" value="{{ $item }}">
            @endforeach
        @else
            <input type="hidden" name="{{$key}}" value="{{ $value }}">
        @endif
    @endif
@endforeach
