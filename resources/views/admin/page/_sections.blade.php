{{-- Khối quản lý block của trang. Nằm trong CÙNG form với thông tin trang,
     nên bấm "Cập nhật" một lần là lưu cả trang lẫn block. --}}
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="margin-top:30px">
    <div class="product-status-wrap" style="padding-bottom:20px">
        <h4 style="margin-bottom:6px">Nội dung các block</h4>
        <p class="text-muted" style="padding:0 20px 12px;margin:0">
            Mỗi block là một khối trên trang (hero, đoạn giới thiệu, carousel...). Blade tìm block theo
            <b>khóa</b>, nên đừng đổi khóa của block đang được dùng. Thứ tự nhỏ hiện trước.
            @if ($page->exists)
                <a href="{{ route('admin.page.sections.scaffold', $page->id) }}"
                   onclick="return confirm('Tạo các block chuẩn cho template &quot;{{ $page->template }}&quot;? Block đã có sẽ được giữ nguyên.')">
                    Tạo block mẫu theo template
                </a>
            @else
                <br><b>Lưu trang trước</b>, sau đó mới thêm được block.
            @endif
        </p>

        <div style="padding:0 20px">
            <div id="ci-sections">
                @foreach ($page->sections as $i => $s)
                    @include('admin.page._section_row', ['i' => $i, 's' => $s])
                @endforeach
            </div>

            @if ($page->exists)
                <button type="button" class="btn btn-default" id="ci-add-section">+ Thêm block trống</button>
            @endif
        </div>
    </div>
</div>

@if ($page->exists)
    {{-- Dòng mẫu để JS nhân bản. __INDEX__ được thay bằng số thứ tự thật khi thêm. --}}
    <script type="text/template" id="ci-section-template">
        @include('admin.page._section_row', ['i' => '__INDEX__', 's' => new \App\Models\PageSection])
    </script>
@endif
