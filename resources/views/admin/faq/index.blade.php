@extends('layouts.admin.main')
@section('content')

    <div class="analytics-sparkle-area">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="product-status-wrap">
                        <h4>Câu hỏi thường gặp</h4>
                        @include('layouts.admin._message',['errors'=>$errors])
                        <div class="add-product">
                            <a href="{{ route('admin.faq.create') }}">Thêm câu hỏi</a>
                        </div>
                        <div class="sparkline10-graph">
                            <div class="static-table-list table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Nhóm</th>
                                        <th>Câu hỏi (VI)</th>
                                        <th>Câu hỏi (EN)</th>
                                        <th>Thứ tự</th>
                                        <th>Trạng thái</th>
                                        <th></th>
                                    </tr>
                                    <tr>
                                        {{ Form::open(array('route'=>'admin.faq','method'=>'get')) }}
                                        <td class="hasinput"></td>
                                        <td class="hasinput">
                                            {!! Form::select('group',array(''=>'Tất cả')+$groups,Request::input('group'),array('class'=>'form-control')) !!}
                                        </td>
                                        <td class="hasinput">
                                            {!! Form::text('question',Request::input('question'),array('class'=>'form-control','placeholder'=>'Từ khóa')) !!}
                                        </td>
                                        <td class="hasinput"></td>
                                        <td class="hasinput"></td>
                                        <td class="hasinput">
                                            {!! Form::select('is_active',array(''=>'Tất cả','1'=>'Đang bật','0'=>'Đang tắt'),Request::input('is_active'),array('class'=>'form-control')) !!}
                                        </td>
                                        <td class="hasinput">
                                            {{ Form::submit('Tìm kiếm',array('class'=>'btn btn-sm btn-primary')) }}
                                        </td>
                                        {{ Form::close() }}
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @forelse ($faqs as $row)
                                        <tr>
                                            <td>{{ $row->id }}</td>
                                            <td><span class="label label-default">{{ $groups[$row->group] ?? $row->group }}</span></td>
                                            <td>{{ $row->question_vi }}</td>
                                            <td>{{ $row->question_en }}</td>
                                            <td>{{ $row->sort_order }}</td>
                                            <td>
                                                <label class="label {{ $row->is_active ? 'label-success' : 'label-default' }}">
                                                    {{ $row->is_active ? 'Bật' : 'Tắt' }}
                                                </label>
                                            </td>
                                            <td>
                                                <ul class="action-control">
                                                    <li>
                                                        <a href="{{ route('admin.faq.edit', $row) }}" class="btn btn-sm btn-clean btn-icon btn-icon-md">
                                                            <i class="fa fa-pencil-square-o fa-2x" aria-hidden="true"></i>
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a href="{{ route('admin.faq.delete', $row) }}" class="btn btn-sm btn-clean btn-icon btn-icon-md"
                                                           onclick="return confirm('Xóa câu hỏi này?')">
                                                            <i class="fa fa-trash-o fa-2x" aria-hidden="true"></i>
                                                        </a>
                                                    </li>
                                                </ul>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="7">
                                                <div class="alert alert-danger alert-mg-b" role="alert">Không có bản ghi nào</div>
                                            </td>
                                        </tr>
                                    @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="custom-pagination">
                            {{ $faqs->appends($requestData)->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
