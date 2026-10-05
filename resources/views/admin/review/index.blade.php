@extends('layouts.admin.main')
@section('content')

    <div class="analytics-sparkle-area">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="product-status-wrap">
                        <h4>Đánh giá khách hàng</h4>
                        @include('layouts.admin._message',['errors'=>$errors])
                        <div class="add-product">
                            <a href="{{ route('admin.review.create') }}">Thêm đánh giá</a>
                        </div>

                        <p class="text-muted" style="padding:0 20px 10px">
                            Trang chủ chỉ hiện đánh giá <b>đang bật</b> và có tick <b>Hiện trang chủ</b>, sắp theo cột Thứ tự.
                            Hiện có <b>{{ $homeCount }}</b> đánh giá đang lên trang chủ. Muốn tạm giấu thì bỏ tick, đừng xóa.
                        </p>

                        <div class="sparkline10-graph">
                            <div class="static-table-list table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th style="width:70px">Ảnh</th>
                                        <th>Khách</th>
                                        <th>Nội dung (VI)</th>
                                        <th style="width:80px">Sao</th>
                                        <th style="width:110px">Nguồn</th>
                                        <th style="width:70px">Thứ tự</th>
                                        <th style="width:110px">Trang chủ</th>
                                        <th style="width:90px">Trạng thái</th>
                                        <th style="width:90px"></th>
                                    </tr>
                                    <tr>
                                        {{ Form::open(array('route'=>'admin.review','method'=>'get')) }}
                                        <td class="hasinput"></td>
                                        <td class="hasinput"></td>
                                        <td class="hasinput">
                                            {!! Form::text('author_name',Request::input('author_name'),array('class'=>'form-control','placeholder'=>'Tên hoặc nội dung')) !!}
                                        </td>
                                        <td class="hasinput"></td>
                                        <td class="hasinput">
                                            {!! Form::select('rating',array(''=>'Tất cả')+[5=>'5 sao',4=>'4 sao',3=>'3 sao',2=>'2 sao',1=>'1 sao'],Request::input('rating'),array('class'=>'form-control')) !!}
                                        </td>
                                        <td class="hasinput">
                                            {!! Form::select('source',array(''=>'Tất cả')+$sources,Request::input('source'),array('class'=>'form-control')) !!}
                                        </td>
                                        <td class="hasinput"></td>
                                        <td class="hasinput">
                                            {!! Form::select('is_featured',array(''=>'Tất cả','1'=>'Đang hiện','0'=>'Không hiện'),Request::input('is_featured'),array('class'=>'form-control')) !!}
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
                                    @forelse ($reviews as $row)
                                        <tr>
                                            <td>{{ $row->id }}</td>
                                            <td>
                                                @if ($row->author_avatar_path)
                                                    <img src="{{ asset($row->author_avatar_path) }}" alt=""
                                                         style="width:44px;height:44px;border-radius:50%;object-fit:cover;background:#222">
                                                @else
                                                    <span class="label label-default">—</span>
                                                @endif
                                            </td>
                                            <td>
                                                <b>{{ $row->author_name }}</b>
                                                @if ($row->author_country)
                                                    <br><small class="text-muted">{{ $row->author_country }}</small>
                                                @endif
                                                @if ($row->reviewed_at)
                                                    <br><small class="text-muted">{{ $row->reviewed_at->format('d/m/Y') }}</small>
                                                @endif
                                            </td>
                                            <td>{{ Str::limit($row->content_vi ?: $row->content_en, 110) }}</td>
                                            <td>{{ $row->rating }} / 5</td>
                                            <td><span class="label label-default">{{ $sources[$row->source] ?? $row->source }}</span></td>
                                            <td>{{ $row->sort_order }}</td>
                                            <td>
                                                <label class="label {{ $row->is_featured ? 'label-success' : 'label-default' }}">
                                                    {{ $row->is_featured ? 'Đang hiện' : 'Không hiện' }}
                                                </label>
                                            </td>
                                            <td>
                                                <label class="label {{ $row->is_active ? 'label-success' : 'label-default' }}">
                                                    {{ $row->is_active ? 'Bật' : 'Tắt' }}
                                                </label>
                                            </td>
                                            <td>
                                                <ul class="action-control">
                                                    <li>
                                                        <a href="{{ route('admin.review.edit', $row) }}" class="btn btn-sm btn-clean btn-icon btn-icon-md">
                                                            <i class="fa fa-pencil-square-o fa-2x" aria-hidden="true"></i>
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a href="{{ route('admin.review.delete', $row) }}" class="btn btn-sm btn-clean btn-icon btn-icon-md"
                                                           onclick="return confirm('Xóa hẳn đánh giá của {{ $row->author_name }}? Chỉ muốn tạm giấu thì bỏ tick Hiện trang chủ là đủ.')">
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
                            {{ $reviews->appends($requestData)->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
