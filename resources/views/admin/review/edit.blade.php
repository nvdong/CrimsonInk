@extends('layouts.admin.main')
@section('content')
    <div class="analytics-sparkle-area">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="product-status-wrap">
                        <h4>Sửa đánh giá</h4>
                        @include('layouts.admin._message',['errors'=>$errors])
                    </div>
                </div>
                {!! Form::open(['url' => route('admin.review.update'), 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
                <input type="hidden" name="id" value="{{ $review->id }}">
                @include('admin.review._form', ['submitLabel' => 'Cập nhật'])
                {!! Form::close() !!}
            </div>
        </div>
    </div>
@endsection
