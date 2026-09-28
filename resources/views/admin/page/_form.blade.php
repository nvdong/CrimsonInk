{{-- Form dùng chung cho thêm mới và sửa trang. $page là model rỗng khi thêm mới. --}}
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 form-campaign">

    <div class="col-md-8 col-sm-12">
        <div class="form-group">
            <label for="title_vi" class="required-flag">Tiêu đề (VI)</label>
            <input id="title_vi" name="title_vi" class="form-control" maxlength="190" required
                   value="{{ old('title_vi', $page->title_vi) }}" type="text">
            @error('title_vi') <span class="help-block has-error">{{ $message }}</span> @enderror
        </div>
        <div class="form-group">
            <label for="title_en" class="required-flag">Tiêu đề (EN)</label>
            <input id="title_en" name="title_en" class="form-control" maxlength="190" required
                   value="{{ old('title_en', $page->title_en) }}" type="text">
            @error('title_en') <span class="help-block has-error">{{ $message }}</span> @enderror
        </div>

        <div class="form-group">
            <label for="heading_vi">Tiêu đề lớn trong trang (VI)</label>
            <input id="heading_vi" name="heading_vi" class="form-control" maxlength="190"
                   value="{{ old('heading_vi', $page->heading_vi) }}" type="text">
        </div>
        <div class="form-group">
            <label for="heading_en">Tiêu đề lớn trong trang (EN)</label>
            <input id="heading_en" name="heading_en" class="form-control" maxlength="190"
                   value="{{ old('heading_en', $page->heading_en) }}" type="text">
        </div>

        <div class="form-group">
            <label for="body_vi">Nội dung (VI)</label>
            <textarea id="body_vi" name="body_vi" class="summernote form-control" rows="10">{{ old('body_vi', $page->body_vi) }}</textarea>
        </div>
        <div class="form-group">
            <label for="body_en">Nội dung (EN)</label>
            <textarea id="body_en" name="body_en" class="summernote form-control" rows="10">{{ old('body_en', $page->body_en) }}</textarea>
        </div>

        <h5 style="margin-top:30px">SEO</h5>
        <div class="form-group">
            <label for="meta_title_vi">Meta title (VI)</label>
            <input id="meta_title_vi" name="meta_title_vi" class="form-control" maxlength="190"
                   value="{{ old('meta_title_vi', $page->meta_title_vi) }}" type="text">
        </div>
        <div class="form-group">
            <label for="meta_title_en">Meta title (EN)</label>
            <input id="meta_title_en" name="meta_title_en" class="form-control" maxlength="190"
                   value="{{ old('meta_title_en', $page->meta_title_en) }}" type="text">
        </div>
        <div class="form-group">
            <label for="meta_description_vi">Meta description (VI)</label>
            <textarea id="meta_description_vi" name="meta_description_vi" class="form-control" rows="2" maxlength="300">{{ old('meta_description_vi', $page->meta_description_vi) }}</textarea>
        </div>
        <div class="form-group">
            <label for="meta_description_en">Meta description (EN)</label>
            <textarea id="meta_description_en" name="meta_description_en" class="form-control" rows="2" maxlength="300">{{ old('meta_description_en', $page->meta_description_en) }}</textarea>
        </div>
        <div class="form-group">
            <label for="canonical_url">Canonical URL</label>
            <input id="canonical_url" name="canonical_url" class="form-control" maxlength="255"
                   placeholder="https://..." value="{{ old('canonical_url', $page->canonical_url) }}" type="text">
            @error('canonical_url') <span class="help-block has-error">{{ $message }}</span> @enderror
        </div>
    </div>

    <div class="col-md-4 col-sm-12">
        <div class="form-group">
            <label for="slug" class="required-flag">Slug</label>
            <input id="slug" name="slug" class="form-control" maxlength="120" required
                   placeholder="about-us" value="{{ old('slug', $page->slug) }}" type="text">
            <small class="text-muted">Chữ thường không dấu, số, gạch ngang. Không được trùng với trang khác.</small>
            @error('slug') <span class="help-block has-error">{{ $message }}</span> @enderror
        </div>

        <div class="form-group">
            <label for="type" class="required-flag">Loại trang</label>
            <select id="type" name="type" class="form-control">
                @foreach ($types as $key => $label)
                    <option value="{{ $key }}" @if (old('type', $page->type) === $key) selected @endif>{{ $label }}</option>
                @endforeach
            </select>
            @error('type') <span class="help-block has-error">{{ $message }}</span> @enderror
        </div>

        <div class="form-group">
            <label for="template" class="required-flag">Giao diện</label>
            <select id="template" name="template" class="form-control">
                @foreach ($templates as $key => $label)
                    <option value="{{ $key }}" @if (old('template', $page->template) === $key) selected @endif>{{ $label }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="route_name">Tên route</label>
            <input id="route_name" name="route_name" class="form-control" maxlength="120"
                   placeholder="page.about-us" value="{{ old('route_name', $page->route_name) }}" type="text">
            <small class="text-muted">
                Phải khớp với route khai trong routes/web.php. Sửa sai sẽ làm hỏng link trên menu.
                Để trống nếu trang chưa có route riêng.
            </small>
        </div>

        <div class="form-group">
            <label>Ảnh hero</label>
            @if ($page->hero_image_path)
                <div><img src="{{ asset($page->hero_image_path) }}" alt="" style="max-height:90px;background:#222;padding:4px;margin-bottom:6px"></div>
            @endif
            <input name="hero_image_path" class="form-control" maxlength="255"
                   placeholder="assets/images/..." value="{{ old('hero_image_path', $page->hero_image_path) }}" type="text">
            <input name="hero_image_file" type="file" accept="image/*" style="margin-top:6px">
            <small class="text-muted">Chọn file mới sẽ ghi đè đường dẫn ở trên. Ảnh lưu vào public/upload/page.</small>
        </div>

        <div class="form-group">
            <label>Ảnh chia sẻ (OG image)</label>
            @if ($page->og_image_path)
                <div><img src="{{ asset($page->og_image_path) }}" alt="" style="max-height:90px;background:#222;padding:4px;margin-bottom:6px"></div>
            @endif
            <input name="og_image_path" class="form-control" maxlength="255"
                   value="{{ old('og_image_path', $page->og_image_path) }}" type="text">
            <input name="og_image_file" type="file" accept="image/*" style="margin-top:6px">
        </div>

        <div class="form-group">
            <label for="sort_order">Thứ tự</label>
            <input id="sort_order" name="sort_order" class="form-control"
                   value="{{ old('sort_order', $page->sort_order ?? 0) }}" type="number">
        </div>

        <div class="form-group">
            <label>
                <input type="checkbox" name="is_active" value="1"
                       @if (old('is_active', $page->is_active ?? true)) checked @endif> Đang bật
            </label>
        </div>
        <div class="form-group">
            <label>
                <input type="checkbox" name="noindex" value="1"
                       @if (old('noindex', $page->noindex ?? false)) checked @endif> Chặn Google lập chỉ mục (noindex)
            </label>
        </div>

        @if (!empty($submitLabel))
        <div class="d-flex justify-content-between mt-4 mb-5">
            <button type="submit" class="btn btn-primary">{{ $submitLabel }}</button>
            <a href="{{ route('admin.page') }}" class="btn btn-danger">Hủy</a>
        </div>
        @endif
    </div>
</div>
