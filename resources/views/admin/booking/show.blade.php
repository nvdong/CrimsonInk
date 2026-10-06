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
                            <label for="artist_id">Artist phụ trách</label>
                            <select id="artist_id" name="artist_id" class="form-control" disabled>
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
                            <label for="preferred_date">Ngày hẹn</label>
                            <input id="preferred_date" name="preferred_date" class="form-control" type="date"
                                   value="{{ old('preferred_date', $booking->preferred_date ? $booking->preferred_date->format('Y-m-d') : '') }}">
                            @error('preferred_date') <span class="help-block has-error">{{ $message }}</span> @enderror
                        </div>

                        <div class="form-group">
                            <label>Gửi lúc</label>
                            <input class="form-control" type="text" readonly
                                   value="{{ $booking->created_at ? $booking->created_at->format('d/m/Y H:i') : '' }}{{ $booking->locale ? ' · ngôn ngữ '.$booking->locale : '' }}{{ $booking->ip ? ' · IP '.$booking->ip : '' }}">
                        </div>


                        <div class="form-group">
                            <label for="admin_note">Ghi chú nội bộ</label>
                            <textarea id="admin_note" name="admin_note" class="form-control" rows="5"
                                      placeholder="Đã gọi xác nhận, khách xin dời sang cuối tuần...">{{ old('admin_note', $booking->admin_note) }}</textarea>
                            <small class="text-muted">Chỉ hiện trong admin, khách không thấy.</small>
                            @error('admin_note') <span class="help-block has-error">{{ $message }}</span> @enderror
                        </div>

                        
                    </div>

                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>

@endsection
