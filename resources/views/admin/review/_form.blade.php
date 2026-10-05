{{-- Form dùng chung cho thêm mới và sửa đánh giá khách hàng. --}}
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 form-campaign">
	<div class="col-md-8 col-sm-12">
		<div class="form-group">
			<label for="author_name" class="required-flag">Tên khách</label>
			<input id="author_name" name="author_name" class="form-control" maxlength="120" required
			       value="{{ old('author_name', $review->author_name) }}" type="text">
			@error('author_name') <span class="help-block has-error">{{ $message }}</span> @enderror
		</div>

		<div class="form-group">
			<label for="content_vi">Nội dung (VI)</label>
			<textarea id="content_vi" name="content_vi" class="form-control" rows="5">{{ old('content_vi', $review->content_vi) }}</textarea>
			@error('content_vi') <span class="help-block has-error">{{ $message }}</span> @enderror
		</div>

		<div class="form-group">
			<label for="content_en">Nội dung (EN)</label>
			<textarea id="content_en" name="content_en" class="form-control" rows="5">{{ old('content_en', $review->content_en) }}</textarea>
			<small class="text-muted">
				Để trống một bản thì ngoài site tự lùi về bản còn lại. Nhưng phải điền ít nhất một trong hai.
			</small>
			@error('content_en') <span class="help-block has-error">{{ $message }}</span> @enderror
		</div>

		<div class="form-group">
			<label for="source_url">Link đánh giá gốc</label>
			<input id="source_url" name="source_url" class="form-control" maxlength="255"
			       placeholder="https://..." value="{{ old('source_url', $review->source_url) }}" type="url">
			<small class="text-muted">Có link thì ngoài trang chủ hiện thêm dòng "Xem đánh giá gốc" dưới mỗi thẻ.</small>
			@error('source_url') <span class="help-block has-error">{{ $message }}</span> @enderror
		</div>
	</div>

	<div class="col-md-4 col-sm-12">
		<div class="form-group">
			<label for="rating" class="required-flag">Số sao</label>
			<select id="rating" name="rating" class="form-control">
				@for ($i = 5; $i >= 1; $i--)
					<option value="{{ $i }}" @if ((int) old('rating', $review->rating ?? 5) === $i) selected @endif>{{ $i }} sao</option>
				@endfor
			</select>
			@error('rating') <span class="help-block has-error">{{ $message }}</span> @enderror
		</div>

		<div class="form-group">
			<label for="source" class="required-flag">Nguồn</label>
			<select id="source" name="source" class="form-control">
				@foreach ($sources as $key => $label)
					<option value="{{ $key }}" @if (old('source', $review->source) === $key) selected @endif>{{ $label }}</option>
				@endforeach
			</select>
			<small class="text-muted">Chọn Google Maps thì ngoài trang chủ hiện icon Google cạnh tên khách.</small>
			@error('source') <span class="help-block has-error">{{ $message }}</span> @enderror
		</div>

		<div class="form-group">
			<label>Ảnh đại diện</label>
			@if ($review->author_avatar_path)
				<div>
					<img src="{{ asset($review->author_avatar_path) }}" alt=""
					     style="width:70px;height:70px;border-radius:50%;object-fit:cover;background:#222;margin-bottom:6px">
				</div>
			@endif
			<input name="author_avatar_path" class="form-control" maxlength="255"
			       placeholder="upload/review/..." value="{{ old('author_avatar_path', $review->author_avatar_path) }}" type="text">
			<input name="avatar_file" type="file" accept="image/*" style="margin-top:6px">
			<small class="text-muted">
				Chọn file mới sẽ ghi đè đường dẫn ở trên. Tối đa 900KB — server chặn ở 1MB.
				Bỏ trống thì trang chủ hiện ô chữ cái đầu của tên khách.
			</small>
			@error('avatar_file') <span class="help-block has-error">{{ $message }}</span> @enderror
		</div>

		<div class="form-group">
			<label for="reviewed_at">Ngày đánh giá</label>
			<input id="reviewed_at" name="reviewed_at" class="form-control" type="date"
			       value="{{ old('reviewed_at', optional($review->reviewed_at)->format('Y-m-d')) }}">
			<small class="text-muted">Trang chủ hiển thị dạng "2 tuần trước". Bỏ trống thì không hiện dòng ngày.</small>
			@error('reviewed_at') <span class="help-block has-error">{{ $message }}</span> @enderror
		</div>

		<div class="form-group">
			<label for="author_country">Quốc gia</label>
			<input id="author_country" name="author_country" class="form-control" maxlength="60"
			       value="{{ old('author_country', $review->author_country) }}" type="text">
		</div>

		<div class="form-group">
			<label for="artist_id">Artist được nhắc tới</label>
			<select id="artist_id" name="artist_id" class="form-control">
				<option value="">— Không gắn —</option>
				@foreach ($artists as $id => $name)
					<option value="{{ $id }}" @if ((string) old('artist_id', $review->artist_id) === (string) $id) selected @endif>{{ $name }}</option>
				@endforeach
			</select>
			<small class="text-muted">Chỉ để tra cứu nội bộ, trang chủ chưa dùng tới.</small>
		</div>

		<div class="form-group">
			<label for="sort_order">Thứ tự</label>
			<input id="sort_order" name="sort_order" class="form-control"
			       value="{{ old('sort_order', $review->sort_order ?? 0) }}" type="number">
			<small class="text-muted">Số nhỏ đứng trước trong carousel.</small>
		</div>

		<div class="form-group">
			<label>
				<input type="checkbox" name="is_featured" value="1"
				       @if (old('is_featured', $review->is_featured ?? true)) checked @endif> Hiện trang chủ
			</label>
		</div>

		<div class="form-group">
			<label>
				<input type="checkbox" name="is_active" value="1"
				       @if (old('is_active', $review->is_active ?? true)) checked @endif> Đang bật
			</label>
		</div>

		<div class="d-flex justify-content-between mt-4 mb-5">
			<button type="submit" class="btn btn-primary">{{ $submitLabel }}</button>
			<a href="{{ route('admin.review') }}" class="btn btn-danger">Hủy</a>
		</div>
	</div>
</div>
