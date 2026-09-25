@if (session('success'))
    <div class="alert alert-success">
        <button class="close" data-dismiss="alert">
            <i class="ace-icon fa fa-times"></i>
        </button>
        @if(is_array(json_decode(Session::get('success'), true)))
            {!! implode('', Session::get('success')->all(':message<br/>')) !!}
        @else
            {!! Session::get('success') !!}
        @endif
    </div>
@endif
@if (session('error'))
    <div class="alert alert-danger">
        <button class="close" data-dismiss="alert">
            <i class="ace-icon fa fa-times"></i>
        </button>
        @if(is_array(json_decode(Session::get('error'), true)))
            {!! implode('', Session::get('error')->all(':message<br/>')) !!}
        @else
            {!! Session::get('error') !!}
        @endif
    </div>
@endif
@if ($errors->any())
    <div class="alert alert-danger">
        <button class="close" data-dismiss="alert">
            <i class="ace-icon fa fa-times"></i>
        </button>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
