@extends('layouts.admin.main')
@section('content')
    <div class="analytics-sparkle-area">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="product-status-wrap">
                        <h4>Thêm phong cách</h4>
                        @include('layouts.admin._message',['errors'=>$errors])
                    </div>
                </div>
                {!! Form::open(['url' => route('admin.style.store'), 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
                @include('admin.style._form', ['submitLabel' => 'Thêm'])

                {{-- Panel chạy được cả ở màn thêm mới: store() tạo bản ghi
                     trước rồi mới gắn file, nên lúc gắn đã có id. --}}
                @include('admin._media_panel', [
                    'mediaItems'      => $images,
                    'mediaMaxKb'      => $mediaMaxKb,
                    'mediaVideoMaxKb' => $mediaVideoMaxKb,
                    'mediaTotalMaxKb' => $mediaTotalMaxKb,
                    'mediaAllowVideo' => true,
                    'mediaTitle'      => 'Ảnh / video minh họa',
                    'mediaNote'       => 'Chọn luôn ở đây cũng được, file sẽ được gắn vào phong cách ngay sau khi tạo. Video được tự cắt ảnh bìa.',
                ])

                <div class="col-lg-12" style="padding:0 20px 40px">
                    <button type="submit" class="btn btn-primary">Thêm</button>
                    <a href="{{ route('admin.style') }}" class="btn btn-danger">Hủy</a>
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>$(function () { $('.summernote').summernote({ height: 220 }); });</script>
@endsection
