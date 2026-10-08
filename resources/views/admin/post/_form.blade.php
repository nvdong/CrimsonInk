{{-- Form dùng chung cho thêm mới và sửa bài viết blog. --}}
@php
    // Cột takeaways là json; model đã cast sang mảng. old() ưu tiên để giữ
    // nguyên những gì vừa gõ khi validate trả về lỗi.
    $takeaways = old('takeaways', $post->takeaways ?: []);
    $takeaways = is_array($takeaways) ? array_values($takeaways) : [];
@endphp

<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 form-campaign">
    <div class="col-md-8 col-sm-12">
        <div class="form-group">
            <label for="title" class="required-flag">Tiêu đề</label>
            <input id="title" name="title" class="form-control" maxlength="190" required
                   value="{{ old('title', $post->title) }}" type="text">
            @error('title') <span class="help-block has-error">{{ $message }}</span> @enderror
        </div>

        <div class="form-group">
            <label for="excerpt">Tóm tắt</label>
            <textarea id="excerpt" name="excerpt" class="form-control" rows="3" maxlength="300">{{ old('excerpt', $post->excerpt) }}</textarea>
            <small class="text-muted">Đoạn chữ hiện dưới tiêu đề ở trang /blog. Bỏ trống thì thẻ bài chỉ có tiêu đề.</small>
            @error('excerpt') <span class="help-block has-error">{{ $message }}</span> @enderror
        </div>

        <div class="form-group">
            <label for="content">Nội dung</label>
            <textarea id="content" name="content" class="summernote form-control" rows="14">{{ old('content', $post->content) }}</textarea>
            <small class="text-muted">
                Mục lục ở trang chi tiết tự dựng từ các thẻ <b>Heading 2</b> trong nội dung — bài có từ 2 thẻ H2 trở lên mới hiện hộp mục lục.
            </small>
        </div>

        <h5 style="margin-top:30px">Điểm chính</h5>
        <p class="text-muted" style="margin-bottom:10px">
            Hộp khung viền ngay dưới mục lục ở trang chi tiết. Mỗi dòng một ý, dùng được thẻ
            <code>&lt;b&gt;</code> để in đậm. Dòng để trống sẽ bị bỏ khi lưu.
        </p>

        <div id="ci-takeaway-rows">
            @foreach ($takeaways as $line)
                @include('admin.post._takeaway_row', ['line' => $line])
            @endforeach
        </div>

        <button type="button" class="btn btn-default btn-sm" id="ci-add-takeaway">+ Thêm dòng</button>

        <h5 style="margin-top:30px">SEO</h5>
        <div class="form-group">
            <label for="meta_title">Meta title</label>
            <input id="meta_title" name="meta_title" class="form-control" maxlength="190"
                   value="{{ old('meta_title', $post->meta_title) }}" type="text">
            <small class="text-muted">Bỏ trống thì dùng tiêu đề bài viết.</small>
        </div>
        <div class="form-group">
            <label for="meta_description">Meta description</label>
            <textarea id="meta_description" name="meta_description" class="form-control" rows="2" maxlength="300">{{ old('meta_description', $post->meta_description) }}</textarea>
            <small class="text-muted">Bỏ trống thì dùng tóm tắt.</small>
            @error('meta_description') <span class="help-block has-error">{{ $message }}</span> @enderror
        </div>
    </div>

    <div class="col-md-4 col-sm-12">
        {{-- Slug do hệ thống sinh từ tiêu đề lúc tạo mới, không cho sửa: nó nằm
             trong URL /blog/{slug} nên đổi là gãy link đã chia sẻ. --}}
        <div class="form-group">
            <label>Đường dẫn</label>
            @if ($post->exists)
                <p class="form-control-static" style="word-break:break-all">
                    <code>/blog/{{ $post->slug }}</code>
                </p>
                <small class="text-muted">Sinh tự động từ tiêu đề lúc tạo, giữ nguyên khi đổi tiêu đề.</small>
            @else
                <p class="text-muted" style="margin:0">Tự sinh từ tiêu đề khi bấm Thêm.</p>
            @endif
        </div>

        <div class="form-group">
            <label for="category_id">Danh mục</label>
            <select id="category_id" name="category_id" class="form-control">
                <option value="">— Chưa gắn —</option>
                @foreach ($categories as $id => $name)
                    <option value="{{ $id }}" @if ((string) old('category_id', $post->category_id) === (string) $id) selected @endif>{{ $name }}</option>
                @endforeach
            </select>
            @if ($categories->isEmpty())
                <small class="text-muted">
                    Chưa có danh mục nào — <a href="{{ route('admin.post-category.create') }}">tạo danh mục</a> trước.
                </small>
            @endif
        </div>

        <div class="form-group">
            <label>Ảnh bìa</label>
            @if ($post->cover_path)
                <div><img src="{{ asset($post->cover_path) }}" alt="" style="max-height:110px;background:#222;padding:4px;margin-bottom:6px"></div>
            @endif
            <input name="cover_path" class="form-control" maxlength="255"
                   placeholder="upload/post/..." value="{{ old('cover_path', $post->cover_path) }}" type="text">
            <input name="cover_file" type="file" accept="image/*" style="margin-top:6px">
            <small class="text-muted">Chọn file mới sẽ ghi đè đường dẫn ở trên. Tối đa 5MB.</small>
            @error('cover_file') <span class="help-block has-error">{{ $message }}</span> @enderror
        </div>

        <div class="form-group">
            <label for="author_name">Tác giả hiển thị</label>
            <input id="author_name" name="author_name" class="form-control" maxlength="120"
                   value="{{ old('author_name', $post->author_name) }}" type="text">
            <small class="text-muted">Dòng "Đăng bởi ..." ngoài site.</small>
        </div>

        <div class="form-group">
            <label for="created_at">Ngày đăng</label>
            <input id="created_at" name="created_at" class="form-control" type="date"
                   value="{{ old('created_at', optional($post->created_at)->format('Y-m-d')) }}">
            <small class="text-muted">
                Vừa là ngày trên thẻ ngoài /blog vừa là dòng "Cập nhật lần cuối". Bỏ trống khi thêm mới thì lấy hôm nay.
            </small>
            @error('created_at') <span class="help-block has-error">{{ $message }}</span> @enderror
        </div>

        <div class="form-group">
            <label>
                <input type="checkbox" name="is_active" value="1"
                       @if (old('is_active', $post->is_active ?? true)) checked @endif> Đang bật
            </label>
            <small class="text-muted" style="display:block">Tắt để lưu nháp — bài không hiện ngoài /blog.</small>
        </div>

        <div class="d-flex justify-content-between mt-4 mb-5">
            <button type="submit" class="btn btn-primary">{{ $submitLabel }}</button>
            <a href="{{ route('admin.post') }}" class="btn btn-danger">Hủy</a>
        </div>
    </div>
</div>

<script type="text/template" id="ci-takeaway-template">
    @include('admin.post._takeaway_row', ['line' => ''])
</script>
