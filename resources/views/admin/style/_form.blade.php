{{-- Form dùng chung cho thêm mới và sửa phong cách xăm. --}}
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 form-campaign">
    <div class="col-md-8 col-sm-12">
        <div class="form-group">
            <label for="name_vi" class="required-flag">Tên (VI)</label>
            <input id="name_vi" name="name_vi" class="form-control" maxlength="120" required
                   placeholder="Tả thực" value="{{ old('name_vi', $style->name_vi) }}" type="text">
            @error('name_vi') <span class="help-block has-error">{{ $message }}</span> @enderror
        </div>
        <div class="form-group">
            <label for="name_en" class="required-flag">Tên (EN)</label>
            <input id="name_en" name="name_en" class="form-control" maxlength="120" required
                   placeholder="Realism" value="{{ old('name_en', $style->name_en) }}" type="text">
            @error('name_en') <span class="help-block has-error">{{ $message }}</span> @enderror
        </div>
        <div class="form-group">
            <label for="excerpt_vi">Mô tả ngắn (VI)</label>
            <input id="excerpt_vi" name="excerpt_vi" class="form-control" maxlength="255"
                   value="{{ old('excerpt_vi', $style->excerpt_vi) }}" type="text">
        </div>
        <div class="form-group">
            <label for="excerpt_en">Mô tả ngắn (EN)</label>
            <input id="excerpt_en" name="excerpt_en" class="form-control" maxlength="255"
                   value="{{ old('excerpt_en', $style->excerpt_en) }}" type="text">
        </div>
        <div class="form-group">
            <label for="content_vi">Nội dung trang chi tiết (VI)</label>
            <textarea id="content_vi" name="content_vi" class="summernote form-control" rows="8">{{ old('content_vi', $style->content_vi) }}</textarea>
        </div>
        <div class="form-group">
            <label for="content_en">Nội dung trang chi tiết (EN)</label>
            <textarea id="content_en" name="content_en" class="summernote form-control" rows="8">{{ old('content_en', $style->content_en) }}</textarea>
        </div>

        <h5 style="margin-top:30px">SEO</h5>
        <div class="form-group">
            <label for="meta_title_vi">Meta title (VI)</label>
            <input id="meta_title_vi" name="meta_title_vi" class="form-control" maxlength="190"
                   value="{{ old('meta_title_vi', $style->meta_title_vi) }}" type="text">
        </div>
        <div class="form-group">
            <label for="meta_title_en">Meta title (EN)</label>
            <input id="meta_title_en" name="meta_title_en" class="form-control" maxlength="190"
                   value="{{ old('meta_title_en', $style->meta_title_en) }}" type="text">
        </div>
        <div class="form-group">
            <label for="meta_description_vi">Meta description (VI)</label>
            <textarea id="meta_description_vi" name="meta_description_vi" class="form-control" rows="2" maxlength="300">{{ old('meta_description_vi', $style->meta_description_vi) }}</textarea>
        </div>
        <div class="form-group">
            <label for="meta_description_en">Meta description (EN)</label>
            <textarea id="meta_description_en" name="meta_description_en" class="form-control" rows="2" maxlength="300">{{ old('meta_description_en', $style->meta_description_en) }}</textarea>
        </div>
    </div>

    <div class="col-md-4 col-sm-12">
        <div class="form-group">
            <label for="slug" class="required-flag">Slug</label>
            <input id="slug" name="slug" class="form-control" maxlength="120" required
                   placeholder="realism-tattoos" value="{{ old('slug', $style->slug) }}" type="text">
            @error('slug') <span class="help-block has-error">{{ $message }}</span> @enderror
        </div>

        <div class="form-group">
            <label>Ảnh thẻ (carousel trang chủ)</label>
            @if ($style->cover_path)
                <div><img src="{{ asset($style->cover_path) }}" alt="" style="max-height:110px;background:#222;padding:4px;margin-bottom:6px"></div>
            @endif
            <input name="cover_path" class="form-control" maxlength="255"
                   placeholder="assets/images/..." value="{{ old('cover_path', $style->cover_path) }}" type="text">
            <input name="cover_file" type="file" accept="image/*" style="margin-top:6px">
        </div>

        <div class="form-group">
            <label>
                <input type="checkbox" name="has_detail_page" value="1"
                       @if (old('has_detail_page', $style->has_detail_page ?? false)) checked @endif> Có trang chi tiết riêng
            </label>
        </div>
        <div class="form-group">
            <label>Địa chỉ trang chi tiết</label>
            <p class="form-control-static">
                <code>/tattoo-styles/{{ $style->slug ?: '{slug}' }}</code>
            </p>
            <small class="text-muted">
                Sinh tự động từ slug, không cần khai route. Bỏ tick "Có trang chi tiết riêng"
                thì địa chỉ này trả về 404 và thẻ ngoài trang sẽ trỏ về /tattoo-styles.
            </small>
            <input type="hidden" name="route_name" value="{{ old('route_name', $style->route_name) }}">
        </div>

        <div class="form-group">
            <label for="sort_order">Thứ tự</label>
            <input id="sort_order" name="sort_order" class="form-control"
                   value="{{ old('sort_order', $style->sort_order ?? 0) }}" type="number">
            <small class="text-muted">Quyết định số in trên thẻ carousel ("1. Fineline").</small>
        </div>
        <div class="form-group">
            <label>
                <input type="checkbox" name="is_featured" value="1"
                       @if (old('is_featured', $style->is_featured ?? true)) checked @endif> Hiện trong carousel trang chủ
            </label>
        </div>
        <div class="form-group">
            <label>
                <input type="checkbox" name="is_active" value="1"
                       @if (old('is_active', $style->is_active ?? true)) checked @endif> Đang bật
            </label>
        </div>

        <div class="d-flex justify-content-between mt-4 mb-5">
            <button type="submit" class="btn btn-primary">{{ $submitLabel }}</button>
            <a href="{{ route('admin.style') }}" class="btn btn-danger">Hủy</a>
        </div>
    </div>
</div>
