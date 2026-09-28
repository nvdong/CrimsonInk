@extends('layouts.admin.main')
@section('content')

    <div class="analytics-sparkle-area">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="product-status-wrap">
                        <h4>Thêm cấu hình</h4>
                        @include('layouts.admin._message',['errors'=>$errors])
                    </div>
                </div>

                {!! Form::open(['url' => route('admin.setting.store'), 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 form-campaign">
                    <div class="col-md-6 col-sm-12">
                        <div class="form-group">
                            <label for="group" class="required-flag">Nhóm</label>
                            <select id="group" name="group" class="form-control">
                                @foreach ($groups as $key => $label)
                                    <option value="{{ $key }}" @if (old('group') === $key) selected @endif>{{ $label }} ({{ $key }})</option>
                                @endforeach
                            </select>
                            @error('group') <span class="help-block has-error">{{ $message }}</span> @enderror
                        </div>
                        <div class="form-group">
                            <label for="key" class="required-flag">Khóa</label>
                            <input id="key" name="key" class="form-control" maxlength="80"
                                   placeholder="vd: hotline" value="{{ old('key') }}" type="text" required>
                            <small class="text-muted">Chữ thường không dấu, không khoảng trắng. Khóa không được trùng trong cùng một nhóm.</small>
                            @error('key') <span class="help-block has-error">{{ $message }}</span> @enderror
                        </div>
                        <div class="form-group">
                            <label for="type" class="required-flag">Kiểu dữ liệu</label>
                            <select id="type" name="type" class="form-control">
                                @foreach ($types as $key => $label)
                                    <option value="{{ $key }}" @if (old('type') === $key) selected @endif>{{ $label }}</option>
                                @endforeach
                            </select>
                            @error('type') <span class="help-block has-error">{{ $message }}</span> @enderror
                        </div>
                        <div class="form-group">
                            <label for="sort_order">Thứ tự</label>
                            <input id="sort_order" name="sort_order" class="form-control" value="{{ old('sort_order', 0) }}" type="number">
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-12">
                        <div class="form-group">
                            <label for="value">Giá trị chung</label>
                            <textarea id="value" name="value" class="form-control" rows="4">{{ old('value') }}</textarea>
                            <small class="text-muted">Dùng khi nội dung không cần dịch. Kiểu Ảnh thì điền đường dẫn hoặc chọn file bên dưới.</small>
                        </div>
                        <div class="form-group">
                            <label for="file">File ảnh (chỉ dùng cho kiểu Ảnh)</label>
                            <input id="file" name="file" type="file" accept="image/*" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="value_en">Giá trị EN</label>
                            <textarea id="value_en" name="value_en" class="form-control" rows="3">{{ old('value_en') }}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="value_vi">Giá trị VI</label>
                            <textarea id="value_vi" name="value_vi" class="form-control" rows="3">{{ old('value_vi') }}</textarea>
                        </div>
                        <div class="d-flex justify-content-between mt-4 mb-5">
                            <button type="submit" class="btn btn-primary">Thêm</button>
                            <a href="{{ route('admin.setting') }}" class="btn btn-danger">Hủy</a>
                        </div>
                    </div>
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>

@endsection
