{{-- Script dùng chung cho màn thêm và sửa bài viết. --}}
<script>
    $(function () {
        var ciUploadUrl = '{{ route('admin.editor.upload-image') }}';
        var ciCsrf      = $('meta[name="csrf-token"]').attr('content');

        /* Thoát ký tự trước khi nhét vào thuộc tính HTML. Tên file do người
           dùng đặt, không escape thì dấu " trong tên làm vỡ thẻ img. */
        function ciEscapeAttr(giaTri) {
            return String(giaTri == null ? '' : giaTri)
                .replace(/&/g, '&amp;')
                .replace(/"/g, '&quot;')
                .replace(/</g, '&lt;')
                .replace(/>/g, '&gt;');
        }

        /* "anh-xam-fineline.jpg" -> "anh xam fineline". Alt để nguyên tên file
           kèm đuôi thì Google đọc ra rác, mà ảnh trong bài blog là chỗ alt có
           giá trị SEO thật. Người viết vẫn sửa lại được trong editor. */
        function ciAltFromName(ten) {
            return String(ten || '')
                .replace(/\.[a-z0-9]+$/i, '')
                .replace(/[-_]+/g, ' ')
                .trim();
        }

        /* Chèn HTML vào khung soạn thảo.

           pasteHTML chèn tại vùng chọn hiện hành, mà vùng chọn có thể KHÔNG
           tồn tại: vừa mở trang chưa gõ gì, hoặc hộp thoại Insert Image vừa
           đóng làm mất con trỏ. Lúc đó pasteHTML im lặng bỏ qua, người dùng
           tưởng upload hỏng. Nên nếu chưa có vùng chọn thì đặt con trỏ vào
           cuối bài trước đã. */
        function ciInsertHtml($editor, html) {
            var info      = $editor.data('summernote');
            var $editable = (info && info.layoutInfo && info.layoutInfo.editable)
                || $editor.next('.note-editor').find('.note-editable');

            if ($editable && $editable.length && window.getSelection().rangeCount === 0) {
                $editable.focus();

                var vung = document.createRange();
                vung.selectNodeContents($editable[0]);
                vung.collapse(false);               // dồn về cuối

                var chon = window.getSelection();
                chon.removeAllRanges();
                chon.addRange(vung);
            }

            $editor.summernote('pasteHTML', html);

            /* pasteHTML để lại đúng khối vừa chèn trong vùng chọn (summernote
               làm vậy để người dùng kéo resize ảnh ngay). Hệ quả: chèn ảnh thứ
               hai sẽ GHI ĐÈ lên ảnh thứ nhất. Chọn 3 ảnh một lúc thì chỉ còn
               2 tấm cuối. Dồn con trỏ về sau khối vừa chèn để tấm sau nối tiếp
               tấm trước. */
            var chon = window.getSelection();

            if (chon && chon.rangeCount) {
                var sau = chon.getRangeAt(0);
                sau.collapse(false);
                chon.removeAllRanges();
                chon.addRange(sau);
            }
        }

        /* Upload MỘT ảnh rồi chèn link vào vị trí con trỏ.
           Trả về promise để chèn nhiều ảnh đúng thứ tự người dùng chọn. */
        function ciUploadImage($editor, file) {
            var form = new FormData();
            form.append('file', file);
            form.append('folder', 'post');

            return $.ajax({
                url: ciUploadUrl,
                method: 'POST',
                data: form,
                processData: false,
                contentType: false,
                dataType: 'json',
                headers: { 'X-CSRF-TOKEN': ciCsrf }
            }).then(function (res) {
                if (!res || !res.url) {
                    return $.Deferred().reject(null, null, (res && res.message) || 'Máy chủ không trả về link ảnh').promise();
                }

                /* Dùng pasteHTML chứ không dùng summernote('insertImage'):
                   trong bản 0.8.18 đang đóng gói sẵn, insertImage chạy không
                   báo lỗi nhưng cũng không chèn gì (đã thử với URL ảnh 200).
                   pasteHTML chèn chắc chắn và cho tự đặt alt + style. */
                ciInsertHtml($editor,
                    '<img src="' + ciEscapeAttr(res.url) + '"' +
                    ' alt="' + ciEscapeAttr(ciAltFromName(file.name)) + '"' +
                    ' style="max-width:100%;height:auto;">');
            });
        }

        /* Nối tiếp từng ảnh một. Bắn song song thì thứ tự chèn phụ thuộc
           ảnh nào upload xong trước, chọn 3 ảnh có thể ra lộn thứ tự. */
        function ciUploadImages($editor, files) {
            var $nut  = $('button[type="submit"]');
            var chain = $.Deferred().resolve().promise();

            $nut.prop('disabled', true);

            $.each(files, function (_, file) {
                chain = chain.then(function () {
                    return ciUploadImage($editor, file);
                });
            });

            chain.fail(function (xhr, _status, msg) {
                var loi = (xhr && xhr.responseJSON && xhr.responseJSON.message)
                    || msg
                    || 'Không rõ nguyên nhân';
                window.alert('Không tải được ảnh lên: ' + loi);
            }).always(function () {
                $nut.prop('disabled', false);
            });
        }

        $('.summernote').summernote({
            height: 420,

            /* Thanh công cụ nổi lên khi bấm vào ảnh chỉ có sẵn 100% - 50% -
               25%. Thêm nút 75% cho ảnh ngang khổ lớn: để 100% thì chiếm trọn
               cột chữ, xuống 50% lại bé quá. Tên nút tự đặt nên phải khai
               trong "buttons" rồi mới gọi được trong "popover" bên dưới. */
            buttons: {
                resizeThreeQuarter: function (context) {
                    return $.summernote.ui.button({
                        contents: '<span class="note-fontsize-10">75%</span>',
                        tooltip: '75%',
                        // Giống hệt cách nút 100%/50%/25% gốc gọi, để ảnh đang
                        // chọn được khôi phục đúng trước khi đổi kích thước.
                        click: context.createInvokeHandler('editor.resize', '0.75')
                    }).render();
                }
            },

            /* Khai lại cả cụm popover ảnh: summernote ghi đè chứ không trộn,
               bỏ sót nhóm nào là nhóm đó biến mất khỏi thanh công cụ. */
            popover: {
                image: [
                    ['resize', ['resizeFull', 'resizeThreeQuarter', 'resizeHalf', 'resizeQuarter', 'resizeNone']],
                    ['float',  ['floatLeft', 'floatRight', 'floatNone']],
                    ['remove', ['removeMedia']]
                ]
            },

            callbacks: {
                /* Mặc định summernote nhúng ảnh thẳng vào HTML dưới dạng
                   base64: một ảnh 2MB thành ~2,7MB chữ nằm trong cột content.
                   Vài bài là bảng posts phình, MySQL đọc chậm, trang trả về
                   cho khách cũng nặng y như vậy vì ảnh không cache được.

                   Chặn hành vi đó: upload file lên /upload trước, rồi chỉ chèn
                   <img src="link">. Callback này chạy cho cả nút Insert Image,
                   kéo-thả ảnh vào khung soạn thảo và dán ảnh từ clipboard —
                   summernote 0.8 gom cả ba về đây. */
                onImageUpload: function (files) {
                    ciUploadImages($(this), files);
                }
            }
        });

        $('#ci-add-takeaway').on('click', function () {
            $('#ci-takeaway-rows').append($('#ci-takeaway-template').html());
        });

        $('#ci-takeaway-rows').on('click', '.ci-remove-takeaway', function () {
            $(this).closest('.ci-takeaway-row').remove();
        });
    });
</script>
