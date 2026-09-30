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

                @if ($style->has_detail_page)
                    @include('admin._media_panel', [
                        'mediaItems' => $images,
                        'mediaMaxKb' => $mediaMaxKb,
                        'mediaTitle' => 'Ảnh minh họa',
                        'mediaNote'  => 'Lưới ảnh hiện ở trang <a href="'.url('/tattoo-styles/'.$style->slug).'" target="_blank" rel="noopener">/tattoo-styles/'.$style->slug.'</a>, bấm vào ảnh sẽ mở lightbox. Mọi thay đổi ở đây lưu chung với form phong cách.',
                    ])

                    <div class="col-lg-12" style="padding:0 20px 40px">
                        <button type="submit" class="btn btn-primary">Cập nhật</button>
                        <a href="{{ route('admin.style') }}" class="btn btn-danger">Hủy</a>
                    </div>
                @endif
                {!! Form::close() !!}
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>$(function () { $('.summernote').summernote({ height: 220 }); });</script>
@endsection
