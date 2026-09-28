@extends('layouts.admin.main')
@section('content')

    <div class="analytics-sparkle-area">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="product-status-wrap">
                        <h4>Thư viện ảnh / video</h4>
                        @include('layouts.admin._message',['errors'=>$errors])
                        <div class="add-product">
                            <a href="{{ route('admin.media.create') }}">Thêm file</a>
                        </div>
                        <div class="sparkline10-graph">
                            <div class="static-table-list table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Xem trước</th>
                                        <th>Gắn vào</th>
                                        <th>Bộ sưu tập</th>
                                        <th>Loại</th>
                                        <th>Đường dẫn</th>
                                        <th>Mô tả ảnh (alt)</th>
                                        <th>Thứ tự</th>
                                        <th>Trạng thái</th>
                                        <th></th>
                                    </tr>
                                    <tr>
                                        {{ Form::open(array('route'=>'admin.media','method'=>'get')) }}
                                        <td class="hasinput"></td>
                                        <td class="hasinput"></td>
                                        <td class="hasinput">
                                            {!! Form::select('mediable_type',array(''=>'Tất cả')+$owners,Request::input('mediable_type'),array('class'=>'form-control')) !!}
                                        </td>
                                        <td class="hasinput">
                                            {!! Form::select('collection',array(''=>'Tất cả')+$collections,Request::input('collection'),array('class'=>'form-control')) !!}
                                        </td>
                                        <td class="hasinput">
                                            {!! Form::select('type',array(''=>'Tất cả')+$types,Request::input('type'),array('class'=>'form-control')) !!}
                                        </td>
                                        <td class="hasinput" colspan="2">
                                            {!! Form::text('alt',Request::input('alt'),array('class'=>'form-control','placeholder'=>'Từ khóa hoặc tên file')) !!}
                                        </td>
                                        <td class="hasinput"></td>
                                        <td class="hasinput">
                                            {!! Form::select('is_active',array(''=>'Tất cả','1'=>'Đang bật','0'=>'Đang tắt'),Request::input('is_active'),array('class'=>'form-control')) !!}
                                        </td>
                                        <td class="hasinput">
                                            {{ Form::submit('Tìm',array('class'=>'btn btn-sm btn-primary')) }}
                                        </td>
                                        {{ Form::close() }}
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @forelse ($media as $row)
                                        @php $ownerKey = $row->mediable_type.'|'.$row->mediable_id; @endphp
                                        <tr>
                                            <td>{{ $row->id }}</td>
                                            <td>
                                                @if ($row->type === 'embed')
                                                    <i class="fa fa-youtube-play fa-2x text-muted" aria-hidden="true"></i>
                                                @elseif ($row->poster_path || $row->path)
                                                    <img src="{{ asset($row->poster_path ?: $row->path) }}" alt=""
                                                         style="height:45px;width:45px;object-fit:cover;background:#222">
                                                @endif
                                            </td>
                                            <td>
                                                {{ $ownerLabels[$ownerKey] ?? 'Không rõ ('.$ownerKey.')' }}
                                            </td>
                                            <td>{{ $collections[$row->collection] ?? $row->collection }}</td>
                                            <td><span class="label label-default">{{ $types[$row->type] ?? $row->type }}</span></td>
                                            <td><small class="text-muted">{{ Str::limit($row->path ?: $row->embed_url, 40) }}</small></td>
                                            <td>{{ Str::limit($row->alt_vi ?: $row->alt_en, 45) }}</td>
                                            <td>{{ $row->sort_order }}</td>
                                            <td>
                                                <label class="label {{ $row->is_active ? 'label-success' : 'label-default' }}">
                                                    {{ $row->is_active ? 'Bật' : 'Tắt' }}
                                                </label>
                                            </td>
                                            <td>
                                                <ul class="action-control">
                                                    <li>
                                                        <a href="{{ route('admin.media.edit', $row->id) }}" class="btn btn-sm btn-clean btn-icon btn-icon-md">
                                                            <i class="fa fa-pencil-square-o fa-2x" aria-hidden="true"></i>
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a href="{{ route('admin.media.delete', $row->id) }}" class="btn btn-sm btn-clean btn-icon btn-icon-md"
                                                           onclick="return confirm('Xóa bản ghi này? File trong public/upload vẫn còn.')">
                                                            <i class="fa fa-trash-o fa-2x" aria-hidden="true"></i>
                                                        </a>
                                                    </li>
                                                </ul>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="10"><div class="alert alert-danger alert-mg-b" role="alert">Không có bản ghi nào</div></td>
                                        </tr>
                                    @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="custom-pagination">
                            {{ $media->appends($requestData)->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
