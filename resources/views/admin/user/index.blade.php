@extends('layouts.admin.main')
@section('content')

    <div class="analytics-sparkle-area">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="product-status-wrap">
                        <h4>Quản lý User</h4>
                        @include('layouts.admin._message',['errors'=>$errors])

                        <p class="text-muted" style="padding:0 20px">
                            Đăng nhập admin bằng Google nên không có mật khẩu — thêm tài khoản ở đây
                            là cho phép email đó vào admin. Email phải trùng đúng email Google của người dùng.
                        </p>

                        <div class="add-product">
                            <a href="{{ route('admin.user.create') }}">Thêm tài khoản</a>
                        </div>

                        <div class="sparkline10-graph">
                            <div class="static-table-list table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Họ tên</th>
                                        <th>Email</th>
                                        <th>Điện thoại</th>
                                        <th>Quyền</th>
                                        <th>Trạng thái</th>
                                        <th>Đăng nhập lần cuối</th>
                                        <th></th>
                                    </tr>
                                    <tr>
                                        {{ Form::open(array('route'=>'admin.user','method'=>'get')) }}
                                        <td class="hasinput"></td>
                                        <td class="hasinput" colspan="3">
                                            {!! Form::text('keyword',Request::input('keyword'),array('class'=>'form-control','placeholder'=>'Tên, email hoặc điện thoại')) !!}
                                        </td>
                                        <td class="hasinput">
                                            {!! Form::select('role',array(''=>'Tất cả')+$roles,Request::input('role'),array('class'=>'form-control')) !!}
                                        </td>
                                        <td class="hasinput">
                                            {!! Form::select('stat',array(''=>'Tất cả','1'=>'Hoạt động','0'=>'Khóa'),Request::input('stat'),array('class'=>'form-control')) !!}
                                        </td>
                                        <td class="hasinput"></td>
                                        <td class="hasinput">
                                            {{ Form::submit('Tìm kiếm',array('class'=>'btn btn-sm btn-primary')) }}
                                        </td>
                                        {{ Form::close() }}
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @forelse ($users as $row)
                                        @php $isSelf = $row->id === auth()->id(); @endphp
                                        <tr>
                                            <td>{{ $row->id }}</td>
                                            <td>
                                                {{ $row->full_name }}
                                                @if ($isSelf)
                                                    <span class="label label-info">bạn</span>
                                                @endif
                                            </td>
                                            <td>{{ $row->email }}</td>
                                            <td>{{ $row->phone ?: '—' }}</td>
                                            <td>
                                                <span class="label {{ $row->isAdmin() ? 'label-danger' : 'label-default' }}">
                                                    {{ $row->role_label }}
                                                </span>
                                            </td>
                                            <td>
                                                <label class="label {{ $row->isActive() ? 'label-success' : 'label-default' }}">
                                                    {{ $row->isActive() ? 'Hoạt động' : 'Khóa' }}
                                                </label>
                                            </td>
                                            <td>
                                                <small class="text-muted">
                                                    {{ $row->last_login ? $row->last_login->format('d/m/Y H:i') : 'Chưa đăng nhập' }}
                                                </small>
                                            </td>
                                            <td>
                                                <ul class="action-control">
                                                    <li>
                                                        <a href="{{ route('admin.user.edit', $row->id) }}" class="btn btn-sm btn-clean btn-icon btn-icon-md">
                                                            <i class="fa fa-pencil-square-o fa-2x" aria-hidden="true"></i>
                                                        </a>
                                                    </li>
                                                    @unless ($isSelf)
                                                        <li>
                                                            <a href="{{ route('admin.user.delete', $row->id) }}" class="btn btn-sm btn-clean btn-icon btn-icon-md"
                                                               onclick="return confirm('Xóa tài khoản {{ $row->email }}? Thao tác này không hoàn lại được — muốn chặn tạm thì sửa Trạng thái về Khóa.')">
                                                                <i class="fa fa-trash-o fa-2x" aria-hidden="true"></i>
                                                            </a>
                                                        </li>
                                                    @endunless
                                                </ul>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="8">
                                                <div class="alert alert-danger alert-mg-b" role="alert">Không có bản ghi nào</div>
                                            </td>
                                        </tr>
                                    @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <div class="custom-pagination">
                            {{ $users->appends($requestData)->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
