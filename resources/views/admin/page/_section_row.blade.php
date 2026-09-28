{{-- Một block của trang. $i là chỉ số trong mảng sections[], $s là model PageSection
     (hoặc model rỗng khi là dòng mẫu để JS nhân bản). --}}
<div class="ci-section-row" style="border:1px solid #e3e3e3;margin-bottom:14px;background:#fff">
    <div style="padding:10px 14px;background:#f5f5f5;border-bottom:1px solid #e3e3e3;overflow:hidden">
        <b class="ci-section-title" style="float:left;line-height:30px">
            {{ $s->key ? $s->key : 'Block mới' }}
        </b>
        <span style="float:right">
            <label style="font-weight:normal;margin:0 12px 0 0">
                <input type="checkbox" name="sections[{{ $i }}][is_active]" value="1"
                       @if ($s->is_active ?? true) checked @endif> Đang bật
            </label>
            <label style="font-weight:normal;margin:0 12px 0 0;color:#c9302c">
                <input type="checkbox" name="sections[{{ $i }}][_destroy]" value="1"> Xóa block
            </label>
            <button type="button" class="btn btn-xs btn-default ci-section-toggle">Thu gọn / mở</button>
        </span>
    </div>

    <div class="ci-section-body" style="padding:14px">
        <input type="hidden" name="sections[{{ $i }}][id]" value="{{ $s->id }}">

        <div class="col-md-4" style="padding-left:0">
            <div class="form-group">
                <label>Khóa block</label>
                <input name="sections[{{ $i }}][key]" class="form-control ci-section-key" maxlength="60"
                       placeholder="hero" value="{{ $s->key }}" type="text">
                <small class="text-muted">Blade dùng khóa này để tìm block. Đổi khóa = blade không thấy block nữa.</small>
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label>Loại block</label>
                <select name="sections[{{ $i }}][type]" class="form-control">
                    @foreach ($sectionTypes as $key => $label)
                        <option value="{{ $key }}" @if (($s->type ?? 'rich_text') === $key) selected @endif>{{ $label }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="col-md-4" style="padding-right:0">
            <div class="form-group">
                <label>Thứ tự</label>
                <input name="sections[{{ $i }}][sort_order]" class="form-control"
                       value="{{ $s->sort_order ?? 0 }}" type="number">
            </div>
        </div>

        <div class="clearfix"></div>

        <div class="col-md-6" style="padding-left:0">
            <div class="form-group">
                <label>Dòng nhỏ phía trên tiêu đề (VI)</label>
                <input name="sections[{{ $i }}][eyebrow_vi]" class="form-control" maxlength="120"
                       placeholder="Chào mừng đến với" value="{{ $s->eyebrow_vi }}" type="text">
            </div>
            <div class="form-group">
                <label>Tiêu đề (VI)</label>
                <input name="sections[{{ $i }}][heading_vi]" class="form-control" maxlength="190"
                       value="{{ $s->heading_vi }}" type="text">
            </div>
            <div class="form-group">
                <label>Tiêu đề phụ (VI)</label>
                <input name="sections[{{ $i }}][subheading_vi]" class="form-control" maxlength="255"
                       value="{{ $s->subheading_vi }}" type="text">
            </div>
            <div class="form-group">
                <label>Nội dung (VI)</label>
                <textarea name="sections[{{ $i }}][body_vi]" class="form-control" rows="4">{{ $s->body_vi }}</textarea>
            </div>
        </div>

        <div class="col-md-6" style="padding-right:0">
            <div class="form-group">
                <label>Dòng nhỏ phía trên tiêu đề (EN)</label>
                <input name="sections[{{ $i }}][eyebrow_en]" class="form-control" maxlength="120"
                       placeholder="Welcome to" value="{{ $s->eyebrow_en }}" type="text">
            </div>
            <div class="form-group">
                <label>Tiêu đề (EN)</label>
                <input name="sections[{{ $i }}][heading_en]" class="form-control" maxlength="190"
                       value="{{ $s->heading_en }}" type="text">
            </div>
            <div class="form-group">
                <label>Tiêu đề phụ (EN)</label>
                <input name="sections[{{ $i }}][subheading_en]" class="form-control" maxlength="255"
                       value="{{ $s->subheading_en }}" type="text">
            </div>
            <div class="form-group">
                <label>Nội dung (EN)</label>
                <textarea name="sections[{{ $i }}][body_en]" class="form-control" rows="4">{{ $s->body_en }}</textarea>
            </div>
        </div>

        <div class="clearfix"></div>

        <div class="col-md-3" style="padding-left:0">
            <div class="form-group">
                <label>Nhãn nút (VI)</label>
                <input name="sections[{{ $i }}][cta_label_vi]" class="form-control" maxlength="80"
                       placeholder="Đặt lịch xăm" value="{{ $s->cta_label_vi }}" type="text">
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <label>Nhãn nút (EN)</label>
                <input name="sections[{{ $i }}][cta_label_en]" class="form-control" maxlength="80"
                       placeholder="Book an appointment" value="{{ $s->cta_label_en }}" type="text">
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <label>Nút trỏ tới trang</label>
                <select name="sections[{{ $i }}][cta_route]" class="form-control">
                    <option value="">— Không dùng route —</option>
                    @foreach ($routes as $name)
                        <option value="{{ $name }}" @if ($s->cta_route === $name) selected @endif>{{ $name }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="col-md-3" style="padding-right:0">
            <div class="form-group">
                <label>Hoặc URL nút</label>
                <input name="sections[{{ $i }}][cta_url]" class="form-control" maxlength="255"
                       value="{{ $s->cta_url }}" type="text">
            </div>
        </div>

        <div class="clearfix"></div>

        <div class="col-md-4" style="padding-left:0">
            <div class="form-group">
                <label>Ảnh của block</label>
                @if ($s->image_path)
                    <div><img src="{{ asset($s->image_path) }}" alt="" style="max-height:70px;background:#222;padding:3px;margin-bottom:5px"></div>
                @endif
                <input name="sections[{{ $i }}][image_path]" class="form-control" maxlength="255"
                       value="{{ $s->image_path }}" type="text">
                <input name="sections[{{ $i }}][image_file]" type="file" accept="image/*" style="margin-top:5px">
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label>Ảnh nền</label>
                @if ($s->background_path)
                    <div><img src="{{ asset($s->background_path) }}" alt="" style="max-height:70px;background:#222;padding:3px;margin-bottom:5px"></div>
                @endif
                <input name="sections[{{ $i }}][background_path]" class="form-control" maxlength="255"
                       value="{{ $s->background_path }}" type="text">
                <input name="sections[{{ $i }}][background_file]" type="file" accept="image/*" style="margin-top:5px">
            </div>
        </div>
        <div class="col-md-4" style="padding-right:0">
            <div class="form-group">
                <label>Tham số riêng (JSON)</label>
                <textarea name="sections[{{ $i }}][settings]" class="form-control" rows="3"
                          style="font-family:monospace;font-size:12px"
                          placeholder='{"limit": 4}'>{{ $s->settings ? json_encode($s->settings, JSON_UNESCAPED_UNICODE) : '' }}</textarea>
                <small class="text-muted">Sai cú pháp thì riêng block này không được lưu.</small>
            </div>
        </div>

        <div style="clear:both"></div>
    </div>
</div>
