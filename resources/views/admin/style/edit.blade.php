@extends('layouts.admin.main')
@section('content')
    <div class="analytics-sparkle-area">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="product-status-wrap">
                        <h4>Sửa phong cách: {{ $style->name_vi }}</h4>
                        @if ($style->trashed())
                            <div class="alert alert-warning" style="margin:10px 20px">Phong cách này đang ở trạng thái đã xóa.</div>
                        @endif
                        @include('layouts.admin._message',['errors'=>$errors])
                    </div>
                </div>
                {!! Form::open(['url' => route('admin.style.update'), 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
                <input type="hidden" name="id" value="{{ $style->id }}">
                @include('admin.style._form', ['submitLabel' => 'Cập nhật'])
                {!! Form::close() !!}
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>$(function () { $('.summernote').summernote({ height: 220 }); });</script>
@endsection
