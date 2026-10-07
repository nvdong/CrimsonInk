{{-- Form dùng chung cho thêm mới và sửa artist. --}}
@php $selectedStyles = old('tattoo_style_ids', $artist->tattoo_style_ids ?: []); @endphp

<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 form-campaign">
    <div class="col-md-8 col-sm-12">
        <div class="form-group">
            <label for="name_en" class="required-flag">Tên (EN)</label>
            <input id="name_en" name="name_en" class="form-control" maxlength="120" required
                   value="{{ old('name_en', $artist->name_en) }}" type="text">
            @error('name_en') <span class="help-block has-error">{{ $message }}</span> @enderror
        </div>
        <div class="form-group">
            <label for="role_en">Vai trò / sở trường (EN)</label>
            <input id="role_en" name="role_en" class="form-control" maxlength="160"
                   placeholder="Realism &amp; Portrait" value="{{ old('role_en', $artist->role_en) }}" type="text">
        </div>
        <div class="form-group">
            <label for="slogan_en">Slogan (EN)</label>
            <input id="slogan_en" name="slogan_en" class="form-control" maxlength="190"
                   placeholder="Your Vision, Forged at CrimsonInk"
                   value="{{ old('slogan_en', $artist->slogan_en) }}" type="text">
        </div>
        <div class="form-group">
            <label for="bio_en">Giới thiệu ngắn (EN)</label>
            <textarea id="bio_en" name="bio_en" class="form-control" rows="3">{{ old('bio_en', $artist->bio_en) }}</textarea>
        </div>
        <div class="form-group">
            <label for="content_en">Nội dung trang chi tiết (EN)</label>
            <textarea id="content_en" name="content_en" class="summernote form-control" rows="8">{{ old('content_en', $artist->content_en) }}</textarea>
        </div>

        <h5 style="margin-top:30px">SEO</h5>
        <div class="form-group">
            <label for="meta_title_en">Meta title (EN)</label>
            <input id="meta_title_en" name="meta_title_en" class="form-control" maxlength="190"
                   value="{{ old('meta_title_en', $artist->meta_title_en) }}" type="text">
        </div>
        <div class="form-group">
            <label for="meta_description_en">Meta description (EN)</label>
            <textarea id="meta_description_en" name="meta_description_en" class="form-control" rows="2" maxlength="300">{{ old('meta_description_en', $artist->meta_description_en) }}</textarea>
        </div>
    </div>

    <div class="col-md-4 col-sm-12">
        <div class="form-group">
            <label for="slug" class="required-flag">Slug</label>
            <input id="slug" name="slug" class="form-control" maxlength="120" required
                   placeholder="minh-khoa" value="{{ old('slug', $artist->slug) }}" type="text">
            <small class="text-muted">Dùng cho URL /artists/&lt;slug&gt;. Đổi slug sẽ làm hỏng link cũ.</small>
            @error('slug') <span class="help-block has-error">{{ $message }}</span> @enderror
        </div>

        <div class="form-group">
            <label>Ảnh đại diện</label>
            @if ($artist->avatar_path)
                <div><img src="{{ asset($artist->avatar_path) }}" alt="" style="max-height:110px;background:#222;padding:4px;margin-bottom:6px"></div>
            @endif
            <input name="avatar_path" class="form-control" maxlength="255"
                   placeholder="assets/images/..." value="{{ old('avatar_path', $artist->avatar_path) }}" type="text">
            <input name="avatar_file" type="file" accept="image/*" style="margin-top:6px">
            <small class="text-muted">Chọn file mới sẽ ghi đè đường dẫn ở trên.</small>
        </div>

        <div class="form-group">
            <label>Ảnh bìa trang chi tiết</label>
            @if ($artist->cover_path)
                <div><img src="{{ asset($artist->cover_path) }}" alt="" style="max-height:90px;background:#222;padding:4px;margin-bottom:6px"></div>
            @endif
            <input name="cover_path" class="form-control" maxlength="255"
                   value="{{ old('cover_path', $artist->cover_path) }}" type="text">
            <input name="cover_file" type="file" accept="image/*" style="margin-top:6px">
        </div>

        <div class="form-group">
            <label for="tattoo_style_ids">Phong cách sở trường</label>
            <select id="tattoo_style_ids" name="tattoo_style_ids[]" class="form-control" multiple size="8">
                @foreach ($styles as $style)
                    <option value="{{ $style->id }}"
                        @if (in_array($style->id, (array) $selectedStyles)) selected @endif>
                        {{ $style->name_vi }}
                    </option>
                @endforeach
            </select>
            <small class="text-muted">Giữ Ctrl (Cmd trên Mac) để chọn nhiều.</small>
        </div>

        <div class="form-group">
            <label for="experience_years">Số năm kinh nghiệm</label>
            <input id="experience_years" name="experience_years" class="form-control" min="0" max="80"
                   value="{{ old('experience_years', $artist->experience_years) }}" type="number">
        </div>

        <div class="form-group">
            <label for="instagram">Instagram</label>
            <input id="instagram" name="instagram" class="form-control" maxlength="255" placeholder="https://instagram.com/..."
                   value="{{ old('instagram', $artist->socials['instagram'] ?? '') }}" type="text">
            @error('instagram') <span class="help-block has-error">{{ $message }}</span> @enderror
        </div>
        <div class="form-group">
            <label for="facebook">Facebook</label>
            <input id="facebook" name="facebook" class="form-control" maxlength="255" placeholder="https://facebook.com/..."
                   value="{{ old('facebook', $artist->socials['facebook'] ?? '') }}" type="text">
            @error('facebook') <span class="help-block has-error">{{ $message }}</span> @enderror
        </div>

        <div class="form-group">
            <label for="sort_order">Thứ tự</label>
            <input id="sort_order" name="sort_order" class="form-control"
                   value="{{ old('sort_order', $artist->sort_order ?? 0) }}" type="number">
        </div>

        <div class="form-group">
            <label>
                <input type="checkbox" name="is_featured" value="1"
                       @if (old('is_featured', $artist->is_featured ?? true)) checked @endif> Hiện ở trang chủ
            </label>
        </div>
        <div class="form-group">
            <label>
                <input type="checkbox" name="is_active" value="1"
                       @if (old('is_active', $artist->is_active ?? true)) checked @endif> Đang bật
            </label>
        </div>

        <div class="d-flex justify-content-between mt-4 mb-5">
            <button type="submit" class="btn btn-primary">{{ $submitLabel }}</button>
            <a href="{{ route('admin.artist') }}" class="btn btn-danger">Hủy</a>
        </div>
    </div>
</div>
