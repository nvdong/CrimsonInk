@extends('layouts.admin.main')
@section('content')
    <div class="analytics-sparkle-area">
        <div class="container-fluid">
            <div class="row">
                {!! Form::open(['url' => route('admin.booking.update', $booking), 'id' => 'file-upload-form', 'method' => 'POST']) !!}
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 form-campaign">
                    <div class="col-md-4 col-sm-12">
                        <div class="form-group">
                            <label for="booing-code" class="required-flag">Mã Đặt hẹn</label>
                            <input id="booing-code" required="" name="code"
                                   class="form-control"
                                   placeholder="Tên chiến dịch"
                                   maxlength="255" value="{{ $booking->code }}"
                                   type="text" readonly>
                            @error('code')
                            <span class="help-block has-error">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="preferred_date" class="required-flag">Thời gian hẹn</label>
                            <input id="preferred_date" required="" name="preferred_date"
                                   class="form-control datepicker"
                                   placeholder="Thời gian hẹn"
                                   maxlength="255" value="{{ $booking->preferred_date }}"
                                   type="date">
                            @error('preferred_date')
                            <span class="help-block has-error">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="status" class="required-flag">Trạng thái</label>
                            <select class="form-control" name="status">
                                <option value="new" @if ($booking->status == 'new') selected @endif>Mới đặt</option>
                                <option value="contacted" @if ($booking->status == 'contacted') selected @endif>Đã liên hệ</option>
                                <option value="done" @if ($booking->status == 'done') selected @endif>Hoàn thành</option>
                            </select>
                            @error('status')
                            <span class="help-block has-error">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="d-flex justify-content-between mt-4 mb-5">
                            <button type="submit" class="btn btn-primary">Update</button>
                            <a href="{{ route('admin.booking') }}" class="btn btn-danger">Cancel</a>
                        </div>
                    </div>
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>

@endsection