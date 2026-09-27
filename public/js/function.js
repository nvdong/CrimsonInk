$(document).ready(function () {
    $('.summernote').summernote({
        // lang: vi,
        placeholder: 'Nhập mô tả chiến dịch ....',
        height: 400,
        toolbar: [
            ['style', ['style', 'bold', 'italic', 'underline', 'clear']],
            ['font', ['strikethrough', 'superscript', 'subscript']],
            ['fontname', ['fontname']],
            ['fontsize', ['fontsize']],
            ['color', ['color']],
            ['table', ['table']],
            ['para', ['ul', 'ol', 'paragraph']],
            ['height', ['height']],
            ['insert', ['link', 'picture', 'video']],
            ['view', ['undo', 'redo', 'fullscreen', 'codeview', 'help']]
        ],
        popover: {
            image: [
                ['image', ['resizeFull', 'resizeHalf', 'resizeQuarter', 'resizeNone']],
                ['float', ['floatLeft', 'floatRight', 'floatNone']],
                ['remove', ['removeMedia']]
            ],
            link: [
                ['link', ['linkDialogShow', 'unlink']]
            ],
            table: [
                ['add', ['addRowDown', 'addRowUp', 'addColLeft', 'addColRight']],
                ['delete', ['deleteRow', 'deleteCol', 'deleteTable']],
            ],
            air: [
                ['color', ['color']],
                ['font', ['bold', 'underline', 'clear']],
                ['para', ['ul', 'paragraph']],
                ['table', ['table']],
                ['insert', ['link', 'picture']]
            ]
        },
        callbacks: {
            onImageUpload: function(image) {
                editorUploadImage(image[0]);
            },
            // onBlur: function() {
            //     let content = $(this).summernote("code").replace(/&nbsp;|<\/?[^>]+(>|$)/g, "").trim();
            //
            //     if (content.length == 0) {
            //         $(this).summernote("code", '')
            //     }
            // }
        }
    });

    // return {
    //     init: function() {
    //         editorSetup();
    //     },
    //     disable: function() {
    //         editorDisable();
    //     },
    // };

    function editorUploadImage(image) {
        var data = new FormData();
        data.append("file", image);

        $.ajax({
            url: '/upload-image',
            cache: false,
            contentType: false,
            processData: false,
            data: data,
            type: "POST",
            success: function(result) {
                let image = $('<img>').attr('src', result.url);
                $('.summernote').summernote("insertNode", image[0]);
               // $('.summernote').summernote('insertImage', 'http://vicongdong.lc/' + result.url);
                //debugger;
            },
            error: function(result) {
                let errorMessage = 'Some thing wrong';

                if(result.responseJSON.message) {
                    errorMessage = result.responseJSON.message;
                };

                alert(errorMessage);
            }
        });
    }
});
