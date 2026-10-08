{{-- Panel file đính kèm — dùng chung cho màn Artist, Trang và Phong cách.
     Cặp đôi với trait App\Http\Controllers\Concerns\ManagesAttachedMedia.

     Biến cần truyền:
       $mediaItems  - collection file hiện có
       $mediaMaxKb  - giới hạn KB cho mỗi ảnh
       $mediaTitle  - tiêu đề panel
       $mediaNote   - dòng mô tả (cho phép HTML)
     Tùy chọn:
       $mediaAllowVideo   - true thì nhận cả video (mặc định false)
       $mediaVideoMaxKb   - giới hạn KB cho mỗi video
       $mediaTotalMaxKb   - giới hạn KB cho cả một lần gửi

     Bật $mediaAllowVideo ở đâu thì giao diện ngoài site của chỗ đó phải biết
     render video, không thì khách thấy thẻ ảnh vỡ. --}}
@php
    $mediaAllowVideo = $mediaAllowVideo ?? false;
    $mediaVideoMaxKb = $mediaVideoMaxKb ?? $mediaMaxKb;
    $mediaTotalMaxKb = $mediaTotalMaxKb ?? $mediaMaxKb;
    $mediaKindLabel  = $mediaAllowVideo ? 'ảnh / video' : 'ảnh';
@endphp
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 form-campaign">
    <div class="col-md-12">
        <hr>
        <h4 style="margin-bottom:4px">{{ $mediaTitle }}</h4>
        <p class="text-muted" style="margin-bottom:18px">{!! $mediaNote !!}</p>

        <div class="form-group">
            <label for="media_files">Thêm {{ $mediaKindLabel }}</label>
            <input id="media_files" name="media_files[]" type="file" multiple
                   accept="{{ $mediaAllowVideo ? 'image/*,video/mp4,video/quicktime,video/webm' : 'image/*' }}"
                   data-max-kb="{{ $mediaMaxKb }}"
                   data-video-max-kb="{{ $mediaVideoMaxKb }}"
                   data-total-max-kb="{{ $mediaTotalMaxKb }}">
            {{-- Dựng câu bằng PHP chứ không chèn @if giữa dòng chữ: Blade dùng
                 \B trong regex nhận diện directive, nên "...MB@if (...)" dính
                 ngay sau một chữ cái sẽ KHÔNG được coi là directive, còn
                 "@endif" thì có — lệch cặp và văng lỗi biên dịch view. --}}
            @php
                $mediaLimitText = 'Mỗi ảnh tối đa '.round($mediaMaxKb / 1024, 1).'MB';

                if ($mediaAllowVideo) {
                    $mediaLimitText .= ', mỗi video tối đa '.round($mediaVideoMaxKb / 1024).'MB (MP4, MOV, WebM)';
                }

                $mediaLimitText .= ', tổng một lần gửi không quá '.round($mediaTotalMaxKb / 1024).'MB';
            @endphp
            <small class="text-muted">
                Chọn được nhiều file một lúc. {{ $mediaLimitText }} — nặng hơn thì chia làm nhiều lần bấm lưu.
                @if ($mediaAllowVideo)
                    <br>Video được tự cắt ảnh bìa khi lưu, không cần tải ảnh bìa riêng.
                @endif
            </small>
            <p id="media_files_warn" class="help-block has-error" style="display:none"></p>
            @error('media_files.*') <span class="help-block has-error">{{ $message }}</span> @enderror
        </div>

        @if ($mediaItems->isEmpty())
            <p class="text-muted">Chưa có ảnh nào.</p>
        @else
            <p class="text-muted">
                Đang có {{ $mediaItems->count() }} file. Số nhỏ hơn thì đứng trước.
                Tick "Gỡ" rồi bấm lưu để bỏ khỏi trang (file vẫn còn trong thư viện).
            </p>

            <div class="row">
                @foreach ($mediaItems as $item)
                    <div class="col-md-2 col-sm-3 col-xs-6" style="margin-bottom:20px">
                        <div style="border:1px solid #e5e5e5;padding:8px;background:#fff">
                            @php
                                // Video chưa cắt được ảnh bìa thì KHÔNG đưa vào src — asset(null)
                                // trả về URL gốc của site và trình duyệt vẽ ra một thẻ ảnh vỡ.
                                $thumb = $item->type === 'video' ? $item->poster_path : $item->path;
                            @endphp
                            <a href="{{ asset($item->path) }}" target="_blank" rel="noopener"
                               style="position:relative;display:block">
                                @if ($thumb)
                                    <img src="{{ asset($thumb) }}" alt=""
                                         style="width:100%;height:150px;object-fit:cover;display:block;background:#f2f2f2">
                                @else
                                    <span style="display:flex;align-items:center;justify-content:center;width:100%;height:150px;background:#2b2b2b;color:#fff;font-size:12px;letter-spacing:.1em">
                                        VIDEO
                                    </span>
                                @endif

                                @if ($item->type === 'video')
                                    <span style="position:absolute;left:6px;top:6px;padding:2px 7px;background:rgba(0,0,0,.75);color:#fff;font-size:11px;letter-spacing:.08em">
                                        VIDEO
                                    </span>
                                @endif
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

    var kb        = function (attr) { return parseInt(input.getAttribute(attr), 10) * 1024; };
    var maxImage  = kb('data-max-kb');
    var maxVideo  = kb('data-video-max-kb') || maxImage;
    var maxTotal  = kb('data-total-max-kb') || maxImage;
    var form      = input.form;
    var mb        = function (bytes) { return Math.round(bytes / 1048576 * 10) / 10; };

    function check() {
        var total = 0;
        var tooBig = [];

        for (var i = 0; i < input.files.length; i++) {
            var file = input.files[i];
            total += file.size;

            /* Trần của video khác trần của ảnh nên phải phân loại trước khi so.
               file.type rỗng với vài định dạng -> coi như ảnh, phía server còn
               một lớp kiểm tra bằng mime thật nên không lọt được. */
            var limit = file.type.indexOf('video/') === 0 ? maxVideo : maxImage;

            if (file.size > limit) {
                tooBig.push(file.name + ' (' + mb(file.size) + 'MB / tối đa ' + mb(limit) + 'MB)');
            }
        }

        var msg = '';

        if (tooBig.length) {
            msg = 'File quá nặng: ' + tooBig.join(', ');
        } else if (total > maxTotal) {
            msg = 'Tổng ' + mb(total) + 'MB, vượt mức ' + mb(maxTotal)
                + 'MB cho một lần gửi. Bỏ bớt file rồi tải tiếp ở lần sau.';
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
