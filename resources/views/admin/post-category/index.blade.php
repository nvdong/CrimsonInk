@extends('layouts.admin.main')
@section('content')

    <div class="analytics-sparkle-area">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="product-status-wrap">
                        <h4>Danh mục blog</h4>
                        @include('layouts.admin._message',['errors'=>$errors])
                        <div class="add-product">
                            <a href="{{ route('admin.post-category.create') }}">Thêm danh mục</a>
                        </div>

                        <p class="text-muted" style="padding:0 20px 10px">
                            Mỗi bài viết thuộc đúng một danh mục. Tên danh mục hiện đè lên ảnh ở trang
                            <a href="{{ route('page.blog') }}" target="_blank" rel="noopener">/blog</a>
                            và ở dòng breadcrumb trang chi tiết.
                        </p>

                        <div class="sparkline10-graph">
                            <div class="static-table-list table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                    <tr>
                                        <th style="width:60px">ID</th>
                                        <th>Tên</th>
                                        <th>Slug</th>
                                        <th>Mô tả</th>
                                        <th style="width:90px">Số bài</th>
                                        <th style="width:80px">Thứ tự</th>
                                        <th style="width:90px">Trạng thái</th>
                                        <th style="width:90px"></th>
                                    </tr>
                                    <tr>
                                        {{ Form::open(array('route'=>'admin.post-category','method'=>'get')) }}
                                        <td class="hasinput"></td>
                                        <td class="hasinput">
                                            {!! Form::text('name',Request::input('name'),array('class'=>'form-control','placeholder'=>'Tên hoặc slug')) !!}
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
                                    @forelse ($categories as $row)
                                        <tr>
                                            <td>{{ $row->id }}</td>
                                            <td><b>{{ $row->name }}</b></td>
                                            <td><code>{{ $row->slug }}</code></td>
                                            <td>{{ Str::limit($row->description, 70) }}</td>
                                            <td>{{ $row->posts_count }}</td>
                                            <td>{{ $row->sort_order }}</td>
                                            <td>
                                                <label class="label {{ $row->is_active ? 'label-success' : 'label-default' }}">
                                                    {{ $row->is_active ? 'Bật' : 'Tắt' }}
                                                </label>
                                            </td>
                                            <td>
                                                <ul class="action-control">
                                                    <li>
                                                        <a href="{{ route('admin.post-category.edit', $row) }}" class="btn btn-sm btn-clean btn-icon btn-icon-md">
                                                            <i class="fa fa-pencil-square-o fa-2x" aria-hidden="true"></i>
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a href="{{ route('admin.post-category.delete', $row) }}" class="btn btn-sm btn-clean btn-icon btn-icon-md"
                                                           onclick="return confirm('Xóa danh mục {{ $row->name }}?')">
                                                            <i class="fa fa-trash-o fa-2x" aria-hidden="true"></i>
                                                        </a>
                                                    </li>
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
                            {{ $categories->appends($requestData)->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
