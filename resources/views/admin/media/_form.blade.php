{{-- Form dùng chung cho thêm mới và sửa file trong thư viện. --}}
@php $ownerValue = old('owner', $item->mediable_type ? $item->mediable_type.'|'.$item->mediable_id : ''); @endphp

<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 form-campaign">
    <div class="col-md-7 col-sm-12">
        <div class="form-group">
            <label for="owner" class="required-flag">Gắn vào</label>
            <select id="owner" name="owner" class="form-control" required>
                <option value="">— Chọn —</option>
                @foreach ($ownerList as $groupLabel => $rows)
                    <optgroup label="{{ $groupLabel }}">
                        @foreach ($rows as $key => $label)
                            <option value="{{ $key }}" @if ($ownerValue === $key) selected @endif>{{ $label }}</option>
                        @endforeach
                    </optgroup>
                @endforeach
            </select>
            <small class="text-muted">File thuộc về trang, artist hay phong cách nào. Ảnh trang /gallery gắn vào Trang: Thư viện ảnh.</small>
            @error('owner') <span class="help-block has-error">{{ $message }}</span> @enderror
        </div>

        <div class="form-group">
            <label for="type" class="required-flag">Loại</label>
            <select id="type" name="type" class="form-control">
                @foreach ($types as $key => $label)
                    <option value="{{ $key }}" @if (old('type', $item->type) === $key) selected @endif>{{ $label }}</option>
                @endforeach
            </select>
            <small class="text-muted">Ảnh và Video (file) cần đường dẫn hoặc file tải lên. Video nhúng cần link YouTube/Vimeo.</small>
        </div>

        <div class="form-group">
            <label>File</label>
            @if ($item->path && $item->type !== 'video')
                <div><img src="{{ asset($item->path) }}" alt="" style="max-height:140px;background:#222;padding:4px;margin-bottom:6px"></div>
            @endif
            <input name="path" class="form-control" maxlength="255"
                   placeholder="assets/images/... hoặc upload/..." value="{{ old('path', $item->path) }}" type="text">
            <input name="file" type="file" style="margin-top:6px">
            <small class="text-muted">Chọn file mới sẽ ghi đè đường dẫn ở trên. File lưu vào public/upload/media.</small>
        </div>

        <div class="form-group">
            <label for="embed_url">Link nhúng</label>
            <input id="embed_url" name="embed_url" class="form-control" maxlength="255"
                   placeholder="https://www.youtube.com/embed/..." value="{{ old('embed_url', $item->embed_url) }}" type="text">
            @error('embed_url') <span class="help-block has-error">{{ $message }}</span> @enderror
        </div>

        <div class="form-group">
            <label>Ảnh bìa video (poster)</label>
            @if ($item->poster_path)
                <div><img src="{{ asset($item->poster_path) }}" alt="" style="max-height:90px;background:#222;padding:4px;margin-bottom:6px"></div>
            @endif
            <input name="poster_path" class="form-control" maxlength="255"
                   value="{{ old('poster_path', $item->poster_path) }}" type="text">
            <input name="poster_file" type="file" accept="image/*" style="margin-top:6px">
        </div>

        <div class="form-group">
            <label for="alt_vi">Mô tả ảnh - alt (VI)</label>
            <input id="alt_vi" name="alt_vi" class="form-control" maxlength="190"
                   value="{{ old('alt_vi', $item->alt_vi) }}" type="text">
            <small class="text-muted">Quan trọng cho SEO ảnh. Mô tả đúng nội dung trong ảnh.</small>
        </div>
        <div class="form-group">
            <label for="alt_en">Mô tả ảnh - alt (EN)</label>
            <input id="alt_en" name="alt_en" class="form-control" maxlength="190"
                   value="{{ old('alt_en', $item->alt_en) }}" type="text">
        </div>
        <div class="form-group">
            <label for="caption_vi">Chú thích (VI)</label>
            <input id="caption_vi" name="caption_vi" class="form-control" maxlength="255"
                   value="{{ old('caption_vi', $item->caption_vi) }}" type="text">
        </div>
        <div class="form-group">
            <label for="caption_en">Chú thích (EN)</label>
            <input id="caption_en" name="caption_en" class="form-control" maxlength="255"
                   value="{{ old('caption_en', $item->caption_en) }}" type="text">
        </div>
    </div>

    <div class="col-md-5 col-sm-12">
        <div class="form-group">
            <label for="collection" class="required-flag">Bộ sưu tập</label>
            <select id="collection" name="collection" class="form-control">
                @foreach ($collections as $key => $label)
                    <option value="{{ $key }}" @if (old('collection', $item->collection) === $key) selected @endif>{{ $label }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="artist_id">Artist thực hiện</label>
            <select id="artist_id" name="artist_id" class="form-control">
                <option value="">— Không ghi —</option>
                @foreach ($artists as $artist)
                    <option value="{{ $artist->id }}" @if ((int) old('artist_id', $item->artist_id) === $artist->id) selected @endif>{{ $artist->name_vi }}</option>
                @endforeach
            </select>
            <small class="text-muted">Chỉ để ghi công, khác với ô "Gắn vào" ở trên.</small>
        </div>

        <div class="form-group">
            <label for="tattoo_style_id">Phong cách</label>
            <select id="tattoo_style_id" name="tattoo_style_id" class="form-control">
                <option value="">— Không ghi —</option>
                @foreach ($styles as $style)
                    <option value="{{ $style->id }}" @if ((int) old('tattoo_style_id', $item->tattoo_style_id) === $style->id) selected @endif>{{ $style->name_vi }}</option>
                @endforeach
            </select>
            <small class="text-muted">Dùng để lọc thư viện theo phong cách.</small>
        </div>

        <div class="form-group">
            <label for="width">Chiều rộng (px)</label>
            <input id="width" name="width" class="form-control" value="{{ old('width', $item->width) }}" type="number" min="0">
        </div>
        <div class="form-group">
            <label for="height">Chiều cao (px)</label>
            <input id="height" name="height" class="form-control" value="{{ old('height', $item->height) }}" type="number" min="0">
            <small class="text-muted">Điền sẵn kích thước giúp trang không bị giật khi ảnh tải xong.</small>
        </div>
        <div class="form-group">
            <label for="duration_seconds">Thời lượng (giây)</label>
            <input id="duration_seconds" name="duration_seconds" class="form-control"
                   value="{{ old('duration_seconds', $item->duration_seconds) }}" type="number" min="0">
        </div>

        <div class="form-group">
            <label for="sort_order">Thứ tự</label>
            <input id="sort_order" name="sort_order" class="form-control"
                   value="{{ old('sort_order', $item->sort_order ?? 0) }}" type="number">
        </div>
        <div class="form-group">
            <label>
                <input type="checkbox" name="is_active" value="1"
                       @if (old('is_active', $item->is_active ?? true)) checked @endif> Đang bật
            </label>
        </div>

        <div class="d-flex justify-content-between mt-4 mb-5">
            <button type="submit" class="btn btn-primary">{{ $submitLabel }}</button>
            <a href="{{ route('admin.media') }}" class="btn btn-danger">Hủy</a>
        </div>
    </div>
</div>
