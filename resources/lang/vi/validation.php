<?php

/*
|--------------------------------------------------------------------------
| Câu báo lỗi kiểm tra dữ liệu — tiếng Việt
|--------------------------------------------------------------------------
| Laravel chọn file theo app()->getLocale(), nên khi người dùng bấm cờ Việt
| Nam thì form đặt lịch (và cả các form trong admin) báo lỗi bằng tiếng Việt.
|
| Chỉ khai những rule dự án đang dùng. Rule nào chưa có ở đây sẽ tự lùi về
| resources/lang/en/validation.php, không gây lỗi.
|
| :attribute là tên trường — form đặt lịch truyền vào từ
| config/constants.php (booking.form.attributes) nên cũng đổi theo ngôn ngữ.
*/

return [

    /*
    | Câu viết sao cho :attribute KHÔNG đứng đầu câu. Tên trường khai bằng chữ
    | thường ("họ và tên"), để nó mở đầu thì ra câu viết hoa sai kiểu
    | "họ và tên không được dài quá 120 ký tự."
    */

    'required'        => 'Vui lòng nhập :attribute.',
    'required_if'     => 'Vui lòng nhập :attribute khi :other là :value.',
    'filled'          => 'Vui lòng nhập :attribute.',

    'string'          => 'Vui lòng nhập đúng định dạng :attribute.',
    'integer'         => 'Vui lòng nhập :attribute là số nguyên.',
    'numeric'         => 'Vui lòng nhập :attribute là số.',
    'boolean'         => 'Giá trị của :attribute không hợp lệ.',
    'array'           => 'Dữ liệu của :attribute không hợp lệ.',
    'date'            => 'Vui lòng chọn :attribute hợp lệ.',
    'email'           => 'Vui lòng nhập đúng định dạng :attribute.',
    'url'             => 'Vui lòng nhập đúng định dạng đường dẫn cho :attribute.',
    'image'           => 'Vui lòng chọn file ảnh cho :attribute.',
    'regex'           => 'Vui lòng nhập đúng định dạng :attribute.',

    'unique'          => 'Đã có bản ghi khác dùng :attribute này.',
    'exists'          => 'Giá trị :attribute được chọn không tồn tại.',
    'in'              => 'Vui lòng chọn :attribute hợp lệ.',
    'confirmed'       => 'Phần nhập lại của :attribute không khớp.',

    'after'           => 'Vui lòng chọn :attribute sau ngày :date.',
    'after_or_equal'  => 'Vui lòng chọn :attribute từ ngày :date trở đi.',
    'before'          => 'Vui lòng chọn :attribute trước ngày :date.',
    'before_or_equal' => 'Vui lòng chọn :attribute trước hoặc bằng ngày :date.',

    'max' => [
        'numeric' => 'Vui lòng nhập :attribute không lớn hơn :max.',
        'file'    => 'Vui lòng chọn :attribute nhẹ hơn :max KB.',
        'string'  => 'Vui lòng nhập :attribute không quá :max ký tự.',
        'array'   => 'Vui lòng chọn :attribute không quá :max mục.',
    ],

    'min' => [
        'numeric' => 'Vui lòng nhập :attribute không nhỏ hơn :min.',
        'file'    => 'Vui lòng chọn :attribute nặng ít nhất :min KB.',
        'string'  => 'Vui lòng nhập :attribute ít nhất :min ký tự.',
        'array'   => 'Vui lòng chọn :attribute ít nhất :min mục.',
    ],

    'between' => [
        'numeric' => 'Vui lòng nhập :attribute trong khoảng :min đến :max.',
        'file'    => 'Vui lòng chọn :attribute nặng từ :min đến :max KB.',
        'string'  => 'Vui lòng nhập :attribute dài từ :min đến :max ký tự.',
        'array'   => 'Vui lòng chọn :attribute từ :min đến :max mục.',
    ],

    'custom' => [],

    /*
    | Để trống: tên trường truyền trực tiếp từ controller (tham số thứ ba của
    | $request->validate) nên không cần khai lại ở đây.
    */
    'attributes' => [],
];
