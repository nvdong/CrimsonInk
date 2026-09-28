@extends('layouts.admin.main')
@section('content')

    <div class="analytics-sparkle-area">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="product-status-wrap">
                        <h4>Danh sách Artist</h4>
                        @include('layouts.admin._message',['errors'=>$errors])
                        <div class="add-product">
                            <a href="{{ route('admin.artist.create') }}">Thêm artist</a>
                        </div>
                        <div class="sparkline10-graph">
                            <div class="static-table-list table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Ảnh</th>
                                        <th>Tên (VI)</th>
                                        <th>Slug</th>
                                        <th>Vai trò (VI)</th>
                                        <th>Thứ tự</th>
                                        <th>Trang chủ</th>
                                        <th>Trạng thái</th>
                                        <th></th>
                                    </tr>
                                    <tr>
                                        {{ Form::open(array('route'=>'admin.artist','method'=>'get')) }}
                                        <td class="hasinput"></td>
                                        <td class="hasinput"></td>
                                        <td class="hasinput" colspan="2">
                                            {!! Form::text('name',Request::input('name'),array('class'=>'form-control','placeholder'=>'Tên hoặc slug')) !!}
                                        </td>
                                        <td class="hasinput">
                                            {!! Form::select('trashed',array(''=>'Đang dùng','1'=>'Đã xóa'),Request::input('trashed'),array('class'=>'form-control')) !!}
                                        </td>
                                        <td class="hasinput"></td>
                                        <td class="hasinput">
                                            {!! Form::select('is_featured',array(''=>'Tất cả','1'=>'Có','0'=>'Không'),Request::input('is_featured'),array('class'=>'form-control')) !!}
                                        </td>
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
                                    @forelse ($artists as $row)
                                        <tr>
                                            <td>{{ $row->id }}</td>
                                            <td>
                                                @if ($row->avatar_path)
                                                    <img src="{{ asset($row->avatar_path) }}" alt="" style="height:40px;width:60px;object-fit:cover;background:#222">
                                                @endif
                                            </td>
                                            <td>{{ $row->name_vi }}</td>
                                            <td><code>{{ $row->slug }}</code></td>
                                            <td>{{ $row->role_vi }}</td>
                                            <td>{{ $row->sort_order }}</td>
                                            <td>
                                                <label class="label {{ $row->is_featured ? 'label-info' : 'label-default' }}">
                                                    {{ $row->is_featured ? 'Có' : 'Không' }}
                                                </label>
                                            </td>
                                            <td>
                                                @if ($row->trashed())
                                                    <label class="label label-danger">Đã xóa</label>
                                                @else
                                                    <label class="label {{ $row->is_active ? 'label-success' : 'label-default' }}">
                                                        {{ $row->is_active ? 'Bật' : 'Tắt' }}
                                                    </label>
                                                @endif
                                            </td>
                                            <td>
                                                <ul class="action-control">
                                                    <li>
                                                        <a href="{{ route('admin.artist.edit', $row->id) }}" class="btn btn-sm btn-clean btn-icon btn-icon-md">
                                                            <i class="fa fa-pencil-square-o fa-2x" aria-hidden="true"></i>
                                                        </a>
                                                    </li>
                                                    <li>
                                                        @if ($row->trashed())
                                                            <a href="{{ route('admin.artist.restore', $row->id) }}" class="btn btn-sm btn-clean btn-icon btn-icon-md" title="Khôi phục">
                                                                <i class="fa fa-undo fa-2x" aria-hidden="true"></i>
                                                            </a>
                                                        @else
                                                            <a href="{{ route('admin.artist.delete', $row->id) }}" class="btn btn-sm btn-clean btn-icon btn-icon-md"
                                                               onclick="return confirm('Xóa {{ $row->name_vi }}? Đây là xóa mềm, khôi phục lại được.')">
                                                                <i class="fa fa-trash-o fa-2x" aria-hidden="true"></i>
                                                            </a>
                                                        @endif
                                                    </li>
                                                </ul>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="9"><div class="alert alert-danger alert-mg-b" role="alert">Không có bản ghi nào</div></td>
                                        </tr>
                                    @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="custom-pagination">
                            {{ $artists->appends($requestData)->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
