@extends('layouts.admin.main')
@section('content')

    <div class="analytics-sparkle-area">
        <div class="container-fluid">
            <div class="row">
                {!! Form::open(['url' => route('admin.campaigns.update', $campaign), 'id' => 'file-upload-form', 'method' => 'PUT', 'enctype' => 'multipart/form-data']) !!}
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 form-campaign">
                    <div class="col-md-8 col-sm-12">
                        <div class="form-group thumbnail-image ">
                            <!-- Upload  -->
                            <label for="campaign-description" class="required-flag">Ảnh đại diện</label>
                            <div id="file-upload-form" class="uploader">
                                <input id="file-upload" type="file" accept="image/*" />
                                <input type="hidden" name="image_url" class="image_url" value="{{ $campaign->image_url }}">
                                <label for="file-upload" id="file-drag">
                                    <img id="file-image" src="{{ $campaign->image_url }}" alt="Preview">
                                    <div id="start" class="hidden">
                                        <i class="fa fa-download" aria-hidden="true"></i>
                                        <div>Select a file or drag here</div>
                                        <div id="notimage" class="hidden">Please select an image</div>
                                        <span id="file-upload-btn" class="btn btn-primary">Select a file</span>
                                    </div>
                                    <div id="response" class="hidden">
                                        <div id="messages">
                                            <span id="file-progress"></span>
                                        </div>
                                    </div>
                                </label>
                            </div>
                        </div>
                        @error('image_url')
                        <span class="help-block has-error">{{ $message }}</span>
                        @enderror
                        <div class="form-group">
                            <label for="campaign-description" class="required-flag">Mô tả ngắn</label>
                            <textarea id="campaign-description"
                              class="summernote form-control"
                              placeholder="Mô tả ngắn"
                              rows="10" maxlength="255"
                              name="content"
                              cols="50">{{ $campaign->content }}</textarea>
                            @error('content')
                            <span class="help-block has-error">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-12">
                        <div class="form-group">
                            <label for="campaign-name" class="required-flag">Tên chiến dịch</label>
                            <input id="campaign-name" required
                                  class="form-control"
                                  placeholder="Tên chiến dịch"
                                  maxlength="255" name="title"
                                  type="text" value="{{ $campaign->title }}">
                            @error('title')
                            <span class="help-block has-error">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="campaign-description" class="required-flag">Mô tả ngắn</label>
                            <textarea id="campaign-description"
                                required=""
                                class="form-control"
                                placeholder="Mô tả ngắn"
                                rows="3" maxlength="255"
                                name="description"
                                cols="50">{{ $campaign->description }}"</textarea>
                            @error('description')
                            <span class="help-block has-error">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="campaign-money" class="required-flag">Số tiền mong muốn</label>
                            <div class="input-group">
                                <input type="number" name="money" value="{{ $campaign->money }}" class="form-control currency-input" placeholder="" aria-describedby="basic-addon2">
                                <span class="input-group-addon" id="basic-addon2">VND</span>
                            </div>
                            @error('money')
                            <span class="help-block has-error">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="campaign-name" class="required-flag">Ngày hết hạn</label>
                            <input id="campaign-name" required="" name="expire_date"
                                   class="form-control datepicker"
                                   placeholder="Tên chiến dịch"
                                   maxlength="255" value="{{ $campaign->expire_date }}"
                                   type="date">
                            @error('expire_date')
                            <span class="help-block has-error">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="campaign-name" class="required-flag">Trạng thái</label>
                            <select class="form-control" name="stat">
                                <option value="1" @if ($campaign->stat == 1) selected @endif>Nháp</option>
                                <option value="2" @if ($campaign->stat == 2) selected @endif>Công bố</option>
                            </select>
                            @error('stat')
                            <span class="help-block has-error">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="d-flex justify-content-between mt-4 mb-5">
                            <button type="submit" class="btn btn-primary">Sửa chiến dịch</button>
                            <a href="{{ route('admin.campaigns') }}" class="btn btn-danger">Hủy bỏ</a>
                        </div>
                    </div>
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
@endsection
