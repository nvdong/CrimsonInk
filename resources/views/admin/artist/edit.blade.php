@extends('layouts.admin.main')
@section('content')
    <div class="analytics-sparkle-area">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="product-status-wrap">
                        <h4>Sửa artist: {{ $artist->name_vi }}</h4>
                        @if ($artist->trashed())
                            <div class="alert alert-warning" style="margin:10px 20px">Artist này đang ở trạng thái đã xóa.</div>
                        @endif
                        @include('layouts.admin._message',['errors'=>$errors])
                    </div>
                </div>
                {!! Form::open(['url' => route('admin.artist.update'), 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
                <input type="hidden" name="id" value="{{ $artist->id }}">
                @include('admin.artist._form', ['submitLabel' => 'Cập nhật'])
                {!! Form::close() !!}
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>$(function () { $('.summernote').summernote({ height: 220 }); });</script>
@endsection
