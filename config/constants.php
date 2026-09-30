<?php

/*
|--------------------------------------------------------------------------
| Hằng số và chuỗi hiển thị
|--------------------------------------------------------------------------
| Chuỗi song ngữ viết theo dạng ['vi' => '...', 'en' => '...'], mã ngôn ngữ
| khớp với cột code trong settings (group i18n, key locales).
|
| Đọc ra bằng App\Support\Text:
|     Text::get('booking.form.submit')       -> một chuỗi theo ngôn ngữ hiện tại
|     Text::group('booking.form.labels')     -> cả cụm, đã chọn sẵn ngôn ngữ
|
| Thiếu bản dịch cho ngôn ngữ đang xem thì Text tự lùi về app.fallback_locale
| rồi tới bản dịch đầu tiên có sẵn — trang không bao giờ hiện ô trống.
*/

return [

    'booking' => [

        // Nhãn trạng thái đơn đặt lịch trong admin (chỉ tiếng Việt)
        'status' => [
            'new'       => 'Mới đặt',
            'contacted' => 'Đã liên hệ',
            'confirmed' => 'Đã Xác nhận',
            'cancelled' => 'Đã hủy',
            'done'      => 'Hoàn thành',
        ],

        // Toàn bộ chữ trên form đặt lịch ngoài trang /contact-us
        'form' => [

            'eyebrow' => [
                'vi' => 'Đặt lịch',
                'en' => 'Booking',
            ],

            // Tiêu đề tách hai phần: phần sau nằm trong <span> nên đổi màu đỏ
            'heading' => [
                'vi' => 'Đặt lịch',
                'en' => 'Book Your',
            ],
            'heading_accent' => [
                'vi' => 'hẹn xăm',
                'en' => 'Appointment',
            ],

            'lead' => [
                'vi' => 'Bạn đang lên lịch tới Hà Nội? Gửi trước ý tưởng của bạn, chúng tôi sẽ chọn artist phù hợp và báo giá trước khi bạn đến.',
                'en' => 'Planning a trip to Hanoi? Send us your idea before you land and we will match you with the right artist and confirm pricing ahead of time.',
            ],

            'labels' => [
                'full_name'      => ['vi' => 'Họ và tên',              'en' => 'Full name'],
                'phone'          => ['vi' => 'Số điện thoại',          'en' => 'Phone number'],
                'email'          => ['vi' => 'Địa chỉ email',          'en' => 'Email address'],
                'preferred_date' => ['vi' => 'Ngày mong muốn',         'en' => 'Preferred date'],
                'artist'         => ['vi' => 'Nghệ sĩ xăm',            'en' => 'Tattoo artists'],
                'message'        => ['vi' => 'Mô tả ý tưởng hình xăm', 'en' => 'Describe your tattoo idea'],
            ],

            'placeholders' => [
                'full_name' => ['vi' => 'Nhập họ và tên của bạn',  'en' => 'Enter your full name'],
                'phone'     => ['vi' => 'Nhập số điện thoại',      'en' => 'Enter your phone number'],
                'email'     => ['vi' => 'Nhập địa chỉ email',      'en' => 'Enter your email address'],
                'message'   => [
                    'vi' => 'Mô tả càng chi tiết càng tốt: chủ đề, hình khối, màu sắc, cảm xúc muốn truyền tải...',
                    'en' => 'Describe your tattoo idea in detail. Include themes, elements, colors, mood, etc.',
                ],
                // Ô chọn nghệ sĩ: dòng đầu tiên khi chưa chọn ai
                'artist'    => ['vi' => 'Chọn nghệ sĩ',            'en' => 'Select artists'],
            ],

            'submit' => [
                'vi' => 'Gửi yêu cầu',
                'en' => 'Send message',
            ],

            'success' => [
                'vi' => 'Cảm ơn bạn! Chúng tôi đã nhận được yêu cầu đặt lịch và sẽ liên hệ lại trong thời gian sớm nhất.',
                'en' => 'Thank you! We have received your booking request and will get back to you shortly.',
            ],

            /*
            | Câu báo lỗi riêng cho từng trường. Mặc định rule after_or_equal
            | in thẳng tham số ra (":date" thành chữ "today"), nên phải viết đè.
            */
            'messages' => [
                'preferred_date.after_or_equal' => [
                    'vi' => 'Ngày mong muốn không thể là ngày đã qua.',
                    'en' => 'The preferred date cannot be in the past.',
                ],
            ],

            /*
            | Tên trường dùng khi Laravel dựng câu báo lỗi ("The full name field
            | is required."). Bản thân câu báo lỗi vẫn là tiếng Anh vì project
            | chưa có resources/lang/vi — xem ghi chú ở ContactController.
            */
            'attributes' => [
                'full_name'      => ['vi' => 'họ và tên',      'en' => 'full name'],
                'phone'          => ['vi' => 'số điện thoại',  'en' => 'phone number'],
                'email'          => ['vi' => 'email',          'en' => 'email'],
                'preferred_date' => ['vi' => 'ngày mong muốn', 'en' => 'preferred date'],
                'artist'         => ['vi' => 'nghệ sĩ xăm',    'en' => 'tattoo artist'],
                'message'        => ['vi' => 'ý tưởng hình xăm', 'en' => 'tattoo idea'],
            ],
        ],
    ],
];
