{{-- Form dùng chung cho thêm mới và sửa tài khoản quản trị.
     Không có ô mật khẩu: đăng nhập bằng Google OAuth. --}}
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 form-campaign">
    <div class="col-md-8 col-sm-12">

        <div class="form-group">
            <label for="full_name" class="required-flag">Họ tên</label>
            <input id="full_name" name="full_name" class="form-control" maxlength="255" required
                   value="{{ old('full_name', $user->full_name) }}" type="text">
            @error('full_name') <span class="help-block has-error">{{ $message }}</span> @enderror
        </div>

        <div class="form-group">
            <label for="email" class="required-flag">Email</label>
            <input id="email" name="email" class="form-control" maxlength="255" required
                   placeholder="ten@gmail.com" value="{{ old('email', $user->email) }}" type="email">
            <small class="text-muted">
                Phải là email Google người đó dùng để đăng nhập — hệ thống khớp tài khoản theo email này.
            </small>
            @error('email') <span class="help-block has-error">{{ $message }}</span> @enderror
        </div>

        <div class="form-group">
            <label for="phone">Điện thoại</label>
            <input id="phone" name="phone" class="form-control" maxlength="20"
                   value="{{ old('phone', $user->phone) }}" type="text">
            <small class="text-muted">Không bắt buộc. Để trống cũng được, nhưng đã điền thì không được trùng người khác.</small>
            @error('phone') <span class="help-block has-error">{{ $message }}</span> @enderror
        </div>

        <div class="form-group">
            <label for="role" class="required-flag">Quyền</label>
            <select id="role" name="role" class="form-control" @if ($isSelf) disabled @endif>
                @foreach ($roles as $value => $label)
                    <option value="{{ $value }}" @if (old('role', $user->role) === $value) selected @endif>{{ $label }}</option>
                @endforeach
            </select>
            @if ($isSelf)
                {{-- select bị disabled thì trình duyệt không gửi lên, phải kèm hidden --}}
                <input type="hidden" name="role" value="{{ $user->role }}">
                <small class="text-muted">Không tự đổi quyền của mình được — nhờ một admin khác đổi hộ.</small>
            @else
                <small class="text-muted">
                    <strong>Quản trị</strong> dùng được mọi mục, kể cả trang này.
                    <strong>Biên tập</strong> dùng được các mục còn lại, không vào được Quản lý User.
                </small>
            @endif
            @error('role') <span class="help-block has-error">{{ $message }}</span> @enderror
        </div>

        <div class="form-group">
            <label>
                <input type="checkbox" name="stat" value="1"
                       @if (old('stat', $user->stat ?? 1)) checked @endif
                       @if ($isSelf) disabled @endif> Cho phép đăng nhập
            </label>
            @if ($isSelf)
                <input type="hidden" name="stat" value="1">
                <small class="text-muted">Không tự khóa tài khoản của mình được.</small>
            @else
                <small class="text-muted">Bỏ tick là khóa: người này đăng nhập Google sẽ bị từ chối, dữ liệu vẫn giữ nguyên.</small>
            @endif
        </div>

        <div class="d-flex justify-content-between mt-4 mb-5">
            <button type="submit" class="btn btn-primary">{{ $submitLabel }}</button>
            <a href="{{ route('admin.user') }}" class="btn btn-danger">Hủy</a>
        </div>
    </div>
</div>
