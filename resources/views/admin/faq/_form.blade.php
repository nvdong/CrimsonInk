{{-- Form dùng chung cho thêm mới và sửa câu hỏi. --}}
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 form-campaign">
    <div class="col-md-8 col-sm-12">
        <div class="form-group">
            <label for="question_vi" class="required-flag">Câu hỏi (VI)</label>
            <input id="question_vi" name="question_vi" class="form-control" maxlength="255" required
                   value="{{ old('question_vi', $faq->question_vi) }}" type="text">
            @error('question_vi') <span class="help-block has-error">{{ $message }}</span> @enderror
        </div>
        <div class="form-group">
            <label for="answer_vi">Trả lời (VI)</label>
            <textarea id="answer_vi" name="answer_vi" class="summernote form-control" rows="8">{{ old('answer_vi', $faq->answer_vi) }}</textarea>
        </div>

        <div class="form-group">
            <label for="question_en" class="required-flag">Câu hỏi (EN)</label>
            <input id="question_en" name="question_en" class="form-control" maxlength="255" required
                   value="{{ old('question_en', $faq->question_en) }}" type="text">
            @error('question_en') <span class="help-block has-error">{{ $message }}</span> @enderror
        </div>
        <div class="form-group">
            <label for="answer_en">Trả lời (EN)</label>
            <textarea id="answer_en" name="answer_en" class="summernote form-control" rows="8">{{ old('answer_en', $faq->answer_en) }}</textarea>
        </div>
    </div>

    <div class="col-md-4 col-sm-12">
        <div class="form-group">
            <label for="group" class="required-flag">Nhóm</label>
            <select id="group" name="group" class="form-control">
                @foreach ($groups as $key => $label)
                    <option value="{{ $key }}" @if (old('group', $faq->group) === $key) selected @endif>{{ $label }}</option>
                @endforeach
            </select>
            <small class="text-muted">Dùng để lọc khi hiển thị ngoài site, ví dụ chỉ lấy nhóm Đặt lịch cho trang đặt lịch.</small>
            @error('group') <span class="help-block has-error">{{ $message }}</span> @enderror
        </div>
        <div class="form-group">
            <label for="sort_order">Thứ tự</label>
            <input id="sort_order" name="sort_order" class="form-control"
                   value="{{ old('sort_order', $faq->sort_order ?? 0) }}" type="number">
        </div>
        <div class="form-group">
            <label>
                <input type="checkbox" name="is_active" value="1"
                       @if (old('is_active', $faq->is_active ?? true)) checked @endif> Đang bật
            </label>
        </div>
        <div class="d-flex justify-content-between mt-4 mb-5">
            <button type="submit" class="btn btn-primary">{{ $submitLabel }}</button>
            <a href="{{ route('admin.faq') }}" class="btn btn-danger">Hủy</a>
        </div>
    </div>
</div>
