@extends('layouts.admin.main')
@section('content')

    <div class="analytics-sparkle-area">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="product-status-wrap">
                        <h4>Quản lý Menu</h4>
                        @include('layouts.admin._message',['errors'=>$errors])
                        <div class="add-product">
                            <a href="{{ route('admin.menu.create', ['location' => $location]) }}">Thêm mục</a>
                        </div>

                        <div style="padding:0 20px 15px">
                            {{ Form::open(array('route'=>'admin.menu','method'=>'get','class'=>'form-inline')) }}
                            <label>Vị trí menu </label>
                            {!! Form::select('location',$locations,$location,array('class'=>'form-control','onchange'=>'this.form.submit()')) !!}
                            {{ Form::close() }}
                            <p class="text-muted" style="margin-top:8px">
                                Thứ tự hiển thị lấy theo cột <b>Thứ tự</b> (nhỏ trước). Mục con thụt vào dưới mục cha.
                            </p>
                        </div>

                        <div class="sparkline10-graph">
                            <div class="static-table-list table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Nhãn (VI)</th>
                                        <th>Nhãn (EN)</th>
                                        <th>Liên kết</th>
                                        <th>Thứ tự</th>
                                        <th>Tab mới</th>
                                        <th>Trạng thái</th>
                                        <th></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @forelse ($items as $item)
                                        @foreach (array_merge([$item], $item->children->all()) as $row)
                                            @php $isChild = $row->parent_id !== null; @endphp
                                            <tr>
                                                <td>{{ $row->id }}</td>
                                                <td>{!! $isChild ? '<span class="text-muted">&nbsp;&nbsp;&nbsp;&#8627;</span> ' : '' !!}{{ $row->label_vi }}</td>
                                                <td>{{ $row->label_en }}</td>
                                                <td>
                                                    @if ($row->route_name)
                                                        <code>{{ $row->route_name }}</code>
                                                    @elseif ($row->url)
                                                        <small>{{ $row->url }}</small>
                                                    @else
                                                        <span class="text-muted">—</span>
                                                    @endif
                                                </td>
                                                <td>{{ $row->sort_order }}</td>
                                                <td>{{ $row->target_blank ? 'Có' : '' }}</td>
                                                <td>
                                                    <label class="label {{ $row->is_active ? 'label-success' : 'label-default' }}">
                                                        {{ $row->is_active ? 'Bật' : 'Tắt' }}
                                                    </label>
                                                </td>
                                                <td>
                                                    <ul class="action-control">
                                                        <li>
                                                            <a href="{{ route('admin.menu.edit', $row->id) }}" class="btn btn-sm btn-clean btn-icon btn-icon-md">
                                                                <i class="fa fa-pencil-square-o fa-2x" aria-hidden="true"></i>
                                                            </a>
                                                        </li>
                                                        <li>
                                                            <a href="{{ route('admin.menu.delete', $row->id) }}" class="btn btn-sm btn-clean btn-icon btn-icon-md"
                                                               onclick="return confirm('Xóa mục {{ $row->label_vi }}?')">
                                                                <i class="fa fa-trash-o fa-2x" aria-hidden="true"></i>
                                                            </a>
                                                        </li>
                                                    </ul>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @empty
                                        <tr>
                                            <td colspan="8"><div class="alert alert-danger alert-mg-b" role="alert">Vị trí này chưa có mục nào</div></td>
                                        </tr>
                                    @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
