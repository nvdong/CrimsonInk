@extends('layouts.admin.main')
@section('content')
    <div class="analytics-sparkle-area">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="product-status-wrap">
                        <h4>Sửa câu hỏi</h4>
                        @include('layouts.admin._message',['errors'=>$errors])
                    </div>
                </div>
                {!! Form::open(['url' => route('admin.faq.update'), 'method' => 'POST']) !!}
                <input type="hidden" name="id" value="{{ $faq->id }}">
                @include('admin.faq._form', ['submitLabel' => 'Cập nhật'])
                {!! Form::close() !!}
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        $(function () { $('.summernote').summernote({ height: 200 }); });
    </script>
@endsection
