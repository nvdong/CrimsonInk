{{-- Form dùng chung cho thêm mới và sửa danh mục blog. --}}
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 form-campaign">
    <div class="col-md-8 col-sm-12">
        <div class="form-group">
            <label for="name" class="required-flag">Tên danh mục</label>
            <input id="name" name="name" class="form-control" maxlength="120" required
                   placeholder="Tattoo Guides &amp; Aftercare" value="{{ old('name', $category->name) }}" type="text">
            @error('name') <span class="help-block has-error">{{ $message }}</span> @enderror
        </div>

        <div class="form-group">
            <label for="description">Mô tả</label>
            <textarea id="description" name="description" class="form-control" rows="3" maxlength="255">{{ old('description', $category->description) }}</textarea>
            <small class="text-muted">Chỉ để ghi chú nội bộ, chưa hiển thị ngoài site.</small>
        </div>
    </div>

    <div class="col-md-4 col-sm-12">
        {{-- Slug do hệ thống sinh từ tên lúc tạo mới, không cho sửa. --}}
        <div class="form-group">
            <label>Slug</label>
            @if ($category->exists)
                <p class="form-control-static"><code>{{ $category->slug }}</code></p>
                <small class="text-muted">Sinh tự động từ tên lúc tạo, giữ nguyên khi đổi tên.</small>
            @else
                <p class="text-muted" style="margin:0">Tự sinh từ tên danh mục khi bấm Thêm.</p>
            @endif
        </div>

        <div class="form-group">
            <label for="sort_order">Thứ tự</label>
            <input id="sort_order" name="sort_order" class="form-control"
                   value="{{ old('sort_order', $category->sort_order ?? 0) }}" type="number">
        </div>

        <div class="form-group">
            <label>
                <input type="checkbox" name="is_active" value="1"
                       @if (old('is_active', $category->is_active ?? true)) checked @endif> Đang bật
            </label>
        </div>

        <div class="d-flex justify-content-between mt-4 mb-5">
            <button type="submit" class="btn btn-primary">{{ $submitLabel }}</button>
            <a href="{{ route('admin.post-category') }}" class="btn btn-danger">Hủy</a>
        </div>
    </div>
</div>
