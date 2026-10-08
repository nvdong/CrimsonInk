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
                @include('admin._media_panel', [
                    'mediaItems' => $works,
                    'mediaMaxKb' => $mediaMaxKb,
                    'mediaTotalMaxKb' => $mediaTotalMaxKb,
                    'mediaTitle' => 'Tác phẩm',
                    'mediaNote'  => 'Ảnh hiện ở cuối trang <a href="'.route('page.artists.show', $artist->slug).'" target="_blank" rel="noopener">/artists/'.$artist->slug.'</a>, bấm vào ảnh sẽ mở lightbox. Mọi thay đổi ở đây lưu chung với form artist.',
                ])

                <div class="col-lg-12" style="padding:0 20px 40px">
                    <button type="submit" class="btn btn-primary">Cập nhật</button>
                    <a href="{{ route('admin.artist') }}" class="btn btn-danger">Hủy</a>
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>$(function () { $('.summernote').summernote({ height: 220 }); });</script>
@endsection
