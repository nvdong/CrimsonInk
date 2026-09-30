@extends('layouts.admin.main')
@section('content')
    <div class="analytics-sparkle-area">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="product-status-wrap">
                        <h4>Sửa trang: {{ $page->slug }}</h4>
                        @include('layouts.admin._message',['errors'=>$errors])
                    </div>
                </div>
                {!! Form::open(['url' => route('admin.page.update'), 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
                <input type="hidden" name="id" value="{{ $page->id }}">
                @include('admin.page._form', ['submitLabel' => null])
                @include('admin.page._sections')

                @include('admin._media_panel', [
                    'mediaItems' => $gallery,
                    'mediaMaxKb' => $mediaMaxKb,
                    'mediaTitle' => 'Ảnh của trang',
                    'mediaNote'  => 'Lưới ảnh hiện ở cuối trang, bấm vào ảnh sẽ mở lightbox. Hiện chỉ trang <strong>about-us</strong> render lưới này; trang khác vẫn lưu được ảnh nhưng chưa hiển thị.',
                ])

                <div class="col-lg-12" style="padding:0 20px 40px">
                    <button type="submit" class="btn btn-primary">Cập nhật trang và block</button>
                    <a href="{{ route('admin.page') }}" class="btn btn-danger">Hủy</a>
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        $(function () {
            $('.summernote').summernote({ height: 250 });

            // thu gọn / mở một block
            $('#ci-sections').on('click', '.ci-section-toggle', function () {
                $(this).closest('.ci-section-row').find('.ci-section-body').toggle();
            });

            // đổi khóa thì đổi luôn tiêu đề trên thanh block
            $('#ci-sections').on('input', '.ci-section-key', function () {
                $(this).closest('.ci-section-row').find('.ci-section-title')
                       .text($(this).val() || 'Block mới');
            });

            var nextIndex = {{ count($page->sections) }};

            // Thêm block trống. Thứ tự đặt sau block cuối cùng — để mặc định 0
            // thì block mới sẽ nhảy lên đầu danh sách sau khi lưu.
            $('#ci-add-section').on('click', function () {
                var thuTuCuoi = 0;

                $('#ci-sections input[name$="[sort_order]"]').each(function () {
                    thuTuCuoi = Math.max(thuTuCuoi, parseInt($(this).val(), 10) || 0);
                });

                var html = $('#ci-section-template').html().split('__INDEX__').join(nextIndex);
                nextIndex++;

                var $row = $(html);
                $row.find('input[name$="[sort_order]"]').val(thuTuCuoi + 10);
                $('#ci-sections').append($row);
            });
        });
    </script>
@endsection
