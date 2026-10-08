@extends('layouts.admin.main')
@section('content')

    <div class="analytics-sparkle-area">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="product-status-wrap">
                        <h4>Bài viết blog @if ($trashed)<small class="text-muted">— đã xóa</small>@endif</h4>
                        @include('layouts.admin._message',['errors'=>$errors])
                        <div class="add-product">
                            <a href="{{ route('admin.post.create') }}">Thêm bài viết</a>
                        </div>

                        <p class="text-muted" style="padding:0 20px 10px">
                            @if ($trashed)
                                Bài đã xóa vẫn còn trong DB, bấm biểu tượng hoàn tác để khôi phục.
                                <a href="{{ route('admin.post') }}">Về danh sách đang dùng</a>
                            @else
                                Trang <a href="{{ route('page.blog') }}" target="_blank" rel="noopener">/blog</a>
                                chỉ hiện bài đang bật, sắp theo ngày đăng giảm dần.
                                <a href="{{ route('admin.post', ['trashed' => 1]) }}">Xem bài đã xóa</a>
                            @endif
                        </p>

                        <div class="sparkline10-graph">
                            <div class="static-table-list table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                    <tr>
                                        <th style="width:60px">ID</th>
                                        <th style="width:90px">Ảnh bìa</th>
                                        <th>Tiêu đề</th>
                                        <th style="width:180px">Danh mục</th>
                                        <th style="width:110px">Ngày đăng</th>
                                        <th style="width:90px">Trạng thái</th>
                                        <th style="width:110px"></th>
                                    </tr>
                                    <tr>
                                        {{ Form::open(array('route'=>'admin.post','method'=>'get')) }}
                                        @if ($trashed)
                                            <input type="hidden" name="trashed" value="1">
                                        @endif
                                        <td class="hasinput"></td>
                                        <td class="hasinput"></td>
                                        <td class="hasinput">
                                            {!! Form::text('title',Request::input('title'),array('class'=>'form-control','placeholder'=>'Tiêu đề, slug hoặc tóm tắt')) !!}
                                        </td>
                                        <td class="hasinput">
                                            {!! Form::select('category_id',array(''=>'Tất cả')+$categories->toArray(),Request::input('category_id'),array('class'=>'form-control')) !!}
                                        </td>
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
                                    @forelse ($posts as $row)
                                        <tr>
                                            <td>{{ $row->id }}</td>
                                            <td>
                                                @if ($row->cover_path)
                                                    <img src="{{ asset($row->cover_path) }}" alt=""
                                                         style="width:70px;height:50px;object-fit:cover;background:#222">
                                                @else
                                                    <span class="label label-default">—</span>
                                                @endif
                                            </td>
                                            <td>
                                                <b>{{ $row->title }}</b><br>
                                                <code>{{ $row->slug }}</code>
                                            </td>
                                            <td>
                                                @if ($row->category)
                                                    <span class="label label-default">{{ $row->category->name }}</span>
                                                @else
                                                    <span class="text-muted">— chưa gắn —</span>
                                                @endif
                                            </td>
                                            <td>{{ optional($row->created_at)->format('d/m/Y') }}</td>
                                            <td>
                                                <label class="label {{ $row->is_active ? 'label-success' : 'label-default' }}">
                                                    {{ $row->is_active ? 'Bật' : 'Tắt' }}
                                                </label>
                                            </td>
                                            <td>
                                                <ul class="action-control">
                                                    @if ($trashed)
                                                        <li>
                                                            <a href="{{ route('admin.post.restore', $row->id) }}" class="btn btn-sm btn-clean btn-icon btn-icon-md"
                                                               title="Khôi phục">
                                                                <i class="fa fa-undo fa-2x" aria-hidden="true"></i>
                                                            </a>
                                                        </li>
                                                    @else
                                                        <li>
                                                            <a href="{{ $row->url }}" target="_blank" rel="noopener" class="btn btn-sm btn-clean btn-icon btn-icon-md"
                                                               title="Xem ngoài site">
                                                                <i class="fa fa-external-link fa-2x" aria-hidden="true"></i>
                                                            </a>
                                                        </li>
                                                        <li>
                                                            <a href="{{ route('admin.post.edit', $row->id) }}" class="btn btn-sm btn-clean btn-icon btn-icon-md">
                                                                <i class="fa fa-pencil-square-o fa-2x" aria-hidden="true"></i>
                                                            </a>
                                                        </li>
                                                        <li>
                                                            <a href="{{ route('admin.post.delete', $row->id) }}" class="btn btn-sm btn-clean btn-icon btn-icon-md"
                                                               onclick="return confirm('Xóa bài {{ addslashes($row->title) }}? Vẫn khôi phục lại được.')">
                                                                <i class="fa fa-trash-o fa-2x" aria-hidden="true"></i>
                                                            </a>
                                                        </li>
                                                    @endif
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
                            {{ $posts->appends($requestData)->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
