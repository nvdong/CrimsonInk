@extends('layouts.admin.main')
@section('content')
    <div class="analytics-sparkle-area">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="product-status-wrap">
                        <h4>Thêm artist</h4>
                        @include('layouts.admin._message',['errors'=>$errors])
                    </div>
                </div>
                {!! Form::open(['url' => route('admin.artist.store'), 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
                @include('admin.artist._form', ['submitLabel' => 'Thêm'])
                {!! Form::close() !!}
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>$(function () { $('.summernote').summernote({ height: 220 }); });</script>
@endsection
