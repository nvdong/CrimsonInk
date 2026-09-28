@extends('layouts.admin.main')
@section('content')

    <div class="analytics-sparkle-area">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="product-status-wrap">
                        <h4>Danh sách Trang</h4>
                        @include('layouts.admin._message',['errors'=>$errors])
                        <div class="add-product">
                            <a href="{{ route('admin.page.create') }}">Thêm trang</a>
                        </div>
                        <div class="sparkline10-graph">
                            <div class="static-table-list table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Slug</th>
                                        <th>Tiêu đề (VI)</th>
                                        <th>Loại</th>
                                        <th>Giao diện</th>
                                        <th>Route</th>
                                        <th>Block</th>
                                        <th>Thứ tự</th>
                                        <th>Trạng thái</th>
                                        <th></th>
                                    </tr>
                                    <tr>
                                        {{ Form::open(array('route'=>'admin.page','method'=>'get')) }}
                                        <td class="hasinput"></td>
                                        <td class="hasinput">
                                            {!! Form::text('slug',Request::input('slug'),array('class'=>'form-control','placeholder'=>'Slug')) !!}
                                        </td>
                                        <td class="hasinput">
                                            {!! Form::text('title',Request::input('title'),array('class'=>'form-control','placeholder'=>'Tiêu đề')) !!}
                                        </td>
                                        <td class="hasinput">
                                            {!! Form::select('type',array(''=>'Tất cả')+$types,Request::input('type'),array('class'=>'form-control')) !!}
                                        </td>
                                        <td class="hasinput"></td>
                                        <td class="hasinput"></td>
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
                                    @forelse ($pages as $row)
                                        <tr>
                                            <td>{{ $row->id }}</td>
                                            <td><code>{{ $row->slug }}</code></td>
                                            <td>{{ $row->title_vi }}</td>
                                            <td>{{ $types[$row->type] ?? $row->type }}</td>
                                            <td>{{ $row->template }}</td>
                                            <td><small class="text-muted">{{ $row->route_name ?: '—' }}</small></td>
                                            <td><span class="label label-default">{{ $row->sections_count }}</span></td>
                                            <td>{{ $row->sort_order }}</td>
                                            <td>
                                                <label class="label {{ $row->is_active ? 'label-success' : 'label-default' }}">
                                                    {{ $row->is_active ? 'Bật' : 'Tắt' }}
                                                </label>
                                            </td>
                                            <td>
                                                <ul class="action-control">
                                                    <li>
                                                        <a href="{{ route('admin.page.edit', $row) }}" class="btn btn-sm btn-clean btn-icon btn-icon-md">
                                                            <i class="fa fa-pencil-square-o fa-2x" aria-hidden="true"></i>
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a href="{{ route('admin.page.delete', $row) }}" class="btn btn-sm btn-clean btn-icon btn-icon-md"
                                                           onclick="return confirm('Xóa trang {{ $row->slug }}? Không khôi phục lại được.')">
                                                            <i class="fa fa-trash-o fa-2x" aria-hidden="true"></i>
                                                        </a>
                                                    </li>
                                                </ul>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="10">
                                                <div class="alert alert-danger alert-mg-b" role="alert">Không có bản ghi nào</div>
                                            </td>
                                        </tr>
                                    @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="custom-pagination">
                            {{ $pages->appends($requestData)->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
