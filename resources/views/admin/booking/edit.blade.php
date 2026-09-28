@extends('layouts.admin.main')
@section('content')
    <div class="analytics-sparkle-area">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="product-status-wrap">
                        <h4>Đơn đặt lịch {{ $booking->code }}</h4>
                        @include('layouts.admin._message',['errors'=>$errors])
                    </div>
                </div>

                {!! Form::open(['url' => route('admin.booking.update'), 'method' => 'POST']) !!}
                <input type="hidden" name="id" value="{{ $booking->id }}" />

                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 form-campaign">

                    {{-- Khách tự nhập --}}
                    <div class="col-md-6 col-sm-12">
                        <h5 style="margin-bottom:15px">Thông tin khách gửi</h5>

                        <div class="form-group">
                            <label for="code">Mã đặt hẹn</label>
                            <input id="code" class="form-control" value="{{ $booking->code }}" type="text" readonly>
                        </div>
                        <div class="form-group">
                            <label for="full_name" class="required-flag">Họ tên</label>
                            <input id="full_name" name="full_name" class="form-control" maxlength="120" required
                                   value="{{ old('full_name', $booking->full_name) }}" type="text">
                            @error('full_name') <span class="help-block has-error">{{ $message }}</span> @enderror
                        </div>
                        <div class="form-group">
                            <label for="phone" class="required-flag">Số điện thoại</label>
                            <input id="phone" name="phone" class="form-control" maxlength="40" required
                                   value="{{ old('phone', $booking->phone) }}" type="text">
                            @error('phone') <span class="help-block has-error">{{ $message }}</span> @enderror
                        </div>
                        <div class="form-group">
                            <label for="email" class="required-flag">Email</label>
                            <input id="email" name="email" class="form-control" maxlength="190" required
                                   value="{{ old('email', $booking->email) }}" type="email">
                            @error('email') <span class="help-block has-error">{{ $message }}</span> @enderror
                        </div>

                        <div class="form-group">
                            <label>Ý tưởng hình xăm</label>
                            <textarea class="form-control" rows="6" readonly>{{ $booking->message }}</textarea>
                            <small class="text-muted">Nội dung khách viết — để nguyên, ghi chú của bạn điền ở cột bên phải.</small>
                        </div>

                        @if ($booking->reference_paths)
                            <div class="form-group">
                                <label>Ảnh khách gửi kèm</label>
                                <div>
                                    @foreach ($booking->reference_paths as $path)
                                        <a href="{{ asset($path) }}" target="_blank" rel="noopener">
                                            <img src="{{ asset($path) }}" alt="" style="height:80px;margin:0 6px 6px 0;background:#222;padding:3px">
                                        </a>
                                    @endforeach
                                </div>
                            </div>
                        @endif

                        <div class="form-group">
                            <label>Gửi lúc</label>
                            <input class="form-control" type="text" readonly
                                   value="{{ $booking->created_at ? $booking->created_at->format('d/m/Y H:i') : '' }}{{ $booking->locale ? ' · ngôn ngữ '.$booking->locale : '' }}{{ $booking->ip ? ' · IP '.$booking->ip : '' }}">
                        </div>
                    </div>

                    {{-- Admin điền sau khi gọi xác nhận --}}
                    <div class="col-md-6 col-sm-12">
                        <h5 style="margin-bottom:15px">Xử lý của studio</h5>

                        <div class="form-group">
                            <label for="status" class="required-flag">Trạng thái</label>
                            <select id="status" name="status" class="form-control">
                                @foreach ($statuses as $key => $label)
                                    <option value="{{ $key }}" @if (old('status', $booking->status) === $key) selected @endif>{{ $label }}</option>
                                @endforeach
                            </select>
                            @error('status') <span class="help-block has-error">{{ $message }}</span> @enderror
                        </div>

                        <div class="form-group">
                            <label for="artist_id">Artist phụ trách</label>
                            <select id="artist_id" name="artist_id" class="form-control">
                                <option value="">— Chưa gán —</option>
                                @foreach ($artists as $artist)
                                    <option value="{{ $artist->id }}"
                                        @if ((int) old('artist_id', $booking->artist_id) === $artist->id) selected @endif>
                                        {{ $artist->name_vi }}{{ $artist->role_vi ? " — ".$artist->role_vi : "" }}{{ $artist->trashed() ? " (đã xóa)" : "" }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="tattoo_style_id">Phong cách chốt</label>
                            <select id="tattoo_style_id" name="tattoo_style_id" class="form-control">
                                <option value="">— Chưa chốt —</option>
                                @foreach ($styles as $style)
                                    <option value="{{ $style->id }}"
                                        @if ((int) old('tattoo_style_id', $booking->tattoo_style_id) === $style->id) selected @endif>
                                        {{ $style->name_vi }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="preferred_date">Ngày hẹn</label>
                            <input id="preferred_date" name="preferred_date" class="form-control" type="date"
                                   value="{{ old('preferred_date', $booking->preferred_date ? $booking->preferred_date->format('Y-m-d') : '') }}">
                            @error('preferred_date') <span class="help-block has-error">{{ $message }}</span> @enderror
                        </div>

                        <div class="form-group">
                            <label for="preferred_time">Giờ hẹn</label>
                            <input id="preferred_time" name="preferred_time" class="form-control" type="time"
                                   value="{{ old('preferred_time', $booking->preferred_time ? substr($booking->preferred_time, 0, 5) : '') }}">
                            @error('preferred_time') <span class="help-block has-error">{{ $message }}</span> @enderror
                        </div>

                        <div class="form-group">
                            <label for="placement">Vị trí xăm</label>
                            <input id="placement" name="placement" class="form-control" maxlength="120"
                                   placeholder="Bắp tay trái" value="{{ old('placement', $booking->placement) }}" type="text">
                        </div>

                        <div class="form-group">
                            <label for="size_cm">Kích thước</label>
                            <input id="size_cm" name="size_cm" class="form-control" maxlength="40"
                                   placeholder="15 x 20 cm" value="{{ old('size_cm', $booking->size_cm) }}" type="text">
                        </div>

                        <div class="form-group">
                            <label for="admin_note">Ghi chú nội bộ</label>
                            <textarea id="admin_note" name="admin_note" class="form-control" rows="5"
                                      placeholder="Đã gọi xác nhận, khách xin dời sang cuối tuần...">{{ old('admin_note', $booking->admin_note) }}</textarea>
                            <small class="text-muted">Chỉ hiện trong admin, khách không thấy.</small>
                            @error('admin_note') <span class="help-block has-error">{{ $message }}</span> @enderror
                        </div>

                        @if ($booking->handler)
                            <p class="text-muted">
                                Người xử lý gần nhất: <b>{{ $booking->handler->full_name }}</b>
                                lúc {{ $booking->updated_at ? $booking->updated_at->format('d/m/Y H:i') : '' }}
                            </p>
                        @endif

                        <div class="d-flex justify-content-between mt-4 mb-5">
                            <button type="submit" class="btn btn-primary">Cập nhật</button>
                            <a href="{{ route('admin.booking') }}" class="btn btn-danger">Hủy</a>
                        </div>
                    </div>
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>

@endsection
