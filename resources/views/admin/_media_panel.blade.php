{{-- Panel ảnh đính kèm — dùng chung cho màn sửa Artist và màn sửa Trang.
     Cặp đôi với trait App\Http\Controllers\Concerns\ManagesAttachedMedia.

     Biến cần truyền:
       $mediaItems  - collection ảnh hiện có
       $mediaMaxKb  - giới hạn KB cho mỗi ảnh
       $mediaTitle  - tiêu đề panel
       $mediaNote   - dòng mô tả (cho phép HTML)
     Panel chỉ dùng được ở màn SỬA, vì lúc thêm mới chưa có id để gắn ảnh vào. --}}
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 form-campaign">
    <div class="col-md-12">
        <hr>
        <h4 style="margin-bottom:4px">{{ $mediaTitle }}</h4>
        <p class="text-muted" style="margin-bottom:18px">{!! $mediaNote !!}</p>

        <div class="form-group">
            <label for="media_files">Thêm ảnh</label>
            <input id="media_files" name="media_files[]" type="file" accept="image/*" multiple
                   data-max-kb="{{ $mediaMaxKb }}">
            <small class="text-muted">
                Chọn được nhiều ảnh một lúc. Mỗi ảnh tối đa {{ $mediaMaxKb }}KB và tổng một lần
                gửi cũng không quá {{ $mediaMaxKb }}KB — ảnh nặng hơn thì chia làm nhiều lần bấm Cập nhật.
            </small>
            <p id="media_files_warn" class="help-block has-error" style="display:none"></p>
            @error('media_files.*') <span class="help-block has-error">{{ $message }}</span> @enderror
        </div>

        @if ($mediaItems->isEmpty())
            <p class="text-muted">Chưa có ảnh nào.</p>
        @else
            <p class="text-muted">
                Đang có {{ $mediaItems->count() }} ảnh. Số nhỏ hơn thì đứng trước.
                Tick "Gỡ" rồi bấm Cập nhật để bỏ ảnh khỏi trang (file vẫn còn trong thư viện).
            </p>

            <div class="row">
                @foreach ($mediaItems as $item)
                    <div class="col-md-2 col-sm-3 col-xs-6" style="margin-bottom:20px">
                        <div style="border:1px solid #e5e5e5;padding:8px;background:#fff">
                            <a href="{{ asset($item->path) }}" target="_blank" rel="noopener">
                                <img src="{{ asset($item->path) }}" alt=""
                                     style="width:100%;height:150px;object-fit:cover;display:block;background:#f2f2f2">
                            </a>

                            <div style="margin-top:8px">
                                <input type="number" class="form-control input-sm"
                                       name="media_sort[{{ $item->id }}]"
                                       value="{{ $item->sort_order }}" aria-label="Thứ tự">
                            </div>

                            <label style="margin:8px 0 0;font-weight:400">
                                <input type="checkbox" name="media_delete[]" value="{{ $item->id }}"> Gỡ
                            </label>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</div>

{{-- Script đặt ngay trong partial: layout admin chỉ có @yield('scripts') và các
     màn sửa đã dùng section đó cho summernote. --}}
<script>
/* nginx chặn request quá client_max_body_size TRƯỚC khi tới Laravel, lúc đó
   người dùng chỉ thấy trang "413 Request Entity Too Large" trần trụi và mất
   hết những gì vừa nhập. Nên chặn sẵn ở đây cho biết lý do. */
(function () {
    var input = document.getElementById('media_files');
    var warn  = document.getElementById('media_files_warn');

    if (!input || !warn) {
        return;
    }

    var maxBytes = parseInt(input.getAttribute('data-max-kb'), 10) * 1024;
    var form     = input.form;

    function check() {
        var total = 0;
        var tooBig = [];

        for (var i = 0; i < input.files.length; i++) {
            total += input.files[i].size;

            if (input.files[i].size > maxBytes) {
                tooBig.push(input.files[i].name);
            }
        }

        var msg = '';

        if (tooBig.length) {
            msg = 'Ảnh quá nặng (tối đa ' + Math.round(maxBytes / 1024) + 'KB mỗi ảnh): ' + tooBig.join(', ');
        } else if (total > maxBytes) {
            msg = 'Tổng ' + Math.round(total / 1024) + 'KB, vượt mức ' + Math.round(maxBytes / 1024)
                + 'KB cho một lần gửi. Bỏ bớt ảnh rồi upload tiếp ở lần sau.';
        }

        warn.textContent = msg;
        warn.style.display = msg ? '' : 'none';

        return msg === '';
    }

    input.addEventListener('change', check);

    if (form) {
        form.addEventListener('submit', function (e) {
            if (!check()) {
                e.preventDefault();
                input.scrollIntoView({ block: 'center' });
            }
        });
    }
})();
</script>
