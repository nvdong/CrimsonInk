@extends('layouts.admin.main')
@section('content')
    <div class="analytics-sparkle-area">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="product-status-wrap">
                        <h4>Sửa tài khoản: {{ $user->full_name }}</h4>
                        @if ($isSelf)
                            <div class="alert alert-info" style="margin:10px 20px">
                                Đây là tài khoản bạn đang đăng nhập — ô Quyền và Trạng thái bị khóa để bạn không tự đẩy mình ra ngoài.
                            </div>
                        @endif
                        @include('layouts.admin._message',['errors'=>$errors])
                    </div>
                </div>
                {!! Form::open(['url' => route('admin.user.update'), 'method' => 'POST']) !!}
                <input type="hidden" name="id" value="{{ $user->id }}">
                @include('admin.user._form', ['submitLabel' => 'Cập nhật'])
                {!! Form::close() !!}
            </div>
        </div>
    </div>
@endsection
