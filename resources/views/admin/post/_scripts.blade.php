{{-- Script dùng chung cho màn thêm và sửa bài viết. --}}
<script>
    $(function () {
        $('.summernote').summernote({ height: 420 });

        $('#ci-add-takeaway').on('click', function () {
            $('#ci-takeaway-rows').append($('#ci-takeaway-template').html());
        });

        $('#ci-takeaway-rows').on('click', '.ci-remove-takeaway', function () {
            $(this).closest('.ci-takeaway-row').remove();
        });
    });
</script>
