{{-- Form dùng chung cho thêm mới và sửa mục menu. --}}
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 form-campaign">
    <div class="col-md-6 col-sm-12">
        <div class="form-group">
            <label for="label_vi" class="required-flag">Nhãn (VI)</label>
            <input id="label_vi" name="label_vi" class="form-control" maxlength="80" required
                   value="{{ old('label_vi', $item->label_vi) }}" type="text">
            @error('label_vi') <span class="help-block has-error">{{ $message }}</span> @enderror
        </div>
        <div class="form-group">
            <label for="label_en" class="required-flag">Nhãn (EN)</label>
            <input id="label_en" name="label_en" class="form-control" maxlength="80" required
                   value="{{ old('label_en', $item->label_en) }}" type="text">
            @error('label_en') <span class="help-block has-error">{{ $message }}</span> @enderror
        </div>

        <div class="form-group">
            <label for="route_name">Trỏ tới trang</label>
            <select id="route_name" name="route_name" class="form-control">
                <option value="">— Không dùng route, nhập URL bên dưới —</option>
                @foreach ($routes as $name)
                    <option value="{{ $name }}" @if (old('route_name', $item->route_name) === $name) selected @endif>{{ $name }}</option>
                @endforeach
            </select>
            <small class="text-muted">Ưu tiên chọn route. Route đổi đường dẫn thì menu tự đúng theo.</small>
        </div>

        <div class="form-group">
            <label for="url">Hoặc URL tự nhập</label>
            <input id="url" name="url" class="form-control" maxlength="255" placeholder="https://... hoặc #"
                   value="{{ old('url', $item->url) }}" type="text">
            <small class="text-muted">Chỉ dùng khi trỏ ra ngoài site hoặc trang chưa có route.</small>
        </div>
    </div>

    <div class="col-md-6 col-sm-12">
        <div class="form-group">
            <label for="location" class="required-flag">Vị trí menu</label>
            <select id="location" name="location" class="form-control">
                @foreach ($locations as $key => $label)
                    <option value="{{ $key }}" @if (old('location', $item->location) === $key) selected @endif>{{ $label }}</option>
                @endforeach
            </select>
            @error('location') <span class="help-block has-error">{{ $message }}</span> @enderror
        </div>

        <div class="form-group">
            <label for="parent_id">Thuộc mục</label>
            <select id="parent_id" name="parent_id" class="form-control">
                <option value="">— Là mục gốc —</option>
                @foreach ($parents as $parent)
                    <option value="{{ $parent->id }}" @if ((int) old('parent_id', $item->parent_id) === $parent->id) selected @endif>
                        {{ $parent->label_vi }}
                    </option>
                @endforeach
            </select>
            <small class="text-muted">
                Chỉ chọn được mục gốc cùng vị trí menu. Menu chỉ đổ xuống 1 tầng, nên mục đang có mục con
                thì không thể tự biến thành mục con.
            </small>
            @error('parent_id') <span class="help-block has-error">{{ $message }}</span> @enderror
        </div>

        <div class="form-group">
            <label for="sort_order">Thứ tự</label>
            <input id="sort_order" name="sort_order" class="form-control"
                   value="{{ old('sort_order', $item->sort_order ?? 0) }}" type="number">
            <small class="text-muted">Nên đánh cách quãng 10, 20, 30... để sau chèn thêm cho dễ.</small>
        </div>

        <div class="form-group">
            <label>
                <input type="checkbox" name="target_blank" value="1"
                       @if (old('target_blank', $item->target_blank ?? false)) checked @endif> Mở ở tab mới
            </label>
        </div>
        <div class="form-group">
            <label>
                <input type="checkbox" name="is_active" value="1"
                       @if (old('is_active', $item->is_active ?? true)) checked @endif> Đang bật
            </label>
        </div>

        <div class="d-flex justify-content-between mt-4 mb-5">
            <button type="submit" class="btn btn-primary">{{ $submitLabel }}</button>
            <a href="{{ route('admin.menu', ['location' => $item->location]) }}" class="btn btn-danger">Hủy</a>
        </div>
    </div>
</div>
