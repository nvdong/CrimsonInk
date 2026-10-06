@extends('layouts.admin.main')
@section('content')

    <div class="analytics-sparkle-area">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="product-status-wrap">
                        <h4>Danh sách Đặt lịch</h4>
                        @include('layouts.admin._message',['errors'=>$errors])

                        <div style="padding:0 20px 15px">
                            {{ Form::open(array('route'=>'admin.booking','method'=>'get','class'=>'form-inline')) }}
                            <label>Ngày hẹn từ </label>
                            {!! Form::date('date_from',Request::input('date_from'),array('class'=>'form-control')) !!}
                            <label> đến </label>
                            {!! Form::date('date_to',Request::input('date_to'),array('class'=>'form-control')) !!}
                            <label> Artist </label>
                            {!! Form::select('artist_id',array(''=>'Tất cả')+$artists->pluck('name_vi','id')->all(),Request::input('artist_id'),array('class'=>'form-control')) !!}
                            {{ Form::submit('Lọc',array('class'=>'btn btn-sm btn-primary')) }}
                            <a href="{{ route('admin.booking') }}" class="btn btn-sm btn-default">Bỏ lọc</a>
                            {{ Form::close() }}
                        </div>

                        <div class="sparkline10-graph">
                            <div class="static-table-list table-responsive">

                                <table class="table table-striped">
                                    <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Mã đặt chỗ</th>
                                        <th>Họ Tên</th>
                                        <th>Email</th>
                                        <th>Số ĐT</th>
                                        <th>Thời gian Hẹn</th>
                                        <th>Artists</th>
                                        <th>Phong cách</th>
                                        <th>Ghi chú</th>
                                        <th>Thời gian đặt</th>
                                        <th>Trạng thái</th>
                                    </tr>
                                    <tr>
                                        {{ Form::open(array('route'=>'admin.booking','method'=>'get')) }}
                                        <td class="hasinput"></td>
                                        <td class="hasinput">
                                            {!! Form::text('code',Request::input('code'),array('class'=>'form-control','placeholder'=>'Mã đặt chỗ')) !!}
                                        </td>
                                        <td class="hasinput">
                                            {!! Form::text('full_name',Request::input('full_name'),array('class'=>'form-control','placeholder'=>'Họ tên')) !!}
                                        </td>
                                        <td class="hasinput">
                                            {!! Form::text('email',Request::input('email'),array('class'=>'form-control','placeholder'=>'Email')) !!}
                                        </td>
                                        <td class="hasinput">
                                            {!! Form::text('phone',Request::input('phone'),array('class'=>'form-control','placeholder'=>'Số ĐT')) !!}
                                        </td>
                                        <td class="hasinput"></td>
                                        <td class="hasinput"></td>
                                        <td class="hasinput"></td>
                                        <td class="hasinput"></td>
                                        <td class="hasinput">
                                            {!! Form::select('status',array(''=>'Tất cả')+$statuses,Request::input('status'),array('class'=>'form-control')) !!}
                                        </td>
                                        <td class="hasinput">
                                            {{ Form::submit('Tìm kiếm',array('class'=>'btn btn-sm btn-primary')) }}
                                        </td>
                                        {{ Form::close() }}
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @forelse ($booking as $row)
                                        <tr>
                                            <td>{{ $row->id }}</td>
                                            <td>
                                                <a href="{{ route('admin.booking.show', ['id'=>$row->id]) }}">
                                                    <code>{{ $row->code }}</code>
                                                </a>
                                            </td>
                                            <td>{{ $row->full_name }}</td>
                                            <td>{{ $row->email }}</td>
                                            <td>{{ $row->phone }}</td>
                                            <td>
                                                {{ $row->preferred_date ? $row->preferred_date->format('d/m/Y') : '—' }}
                                                @if ($row->preferred_time)
                                                    <small class="text-muted">{{ substr($row->preferred_time, 0, 5) }}</small>
                                                @endif
                                            </td>
                                            <td>
                                                @if ($row->artist)
                                                    {{ $row->artist->name_vi }}
                                                @else
                                                    <span class="text-muted">Chưa gán</span>
                                                @endif
                                            </td>
                                            <td>{{ $row->tattooStyle ? $row->tattooStyle->name_vi : '—' }}</td>
                                            <td>
                                                @if ($row->admin_note)
                                                    <span title="{{ $row->admin_note }}">{{ Str::limit($row->admin_note, 35) }}</span>
                                                @else
                                                    <span class="text-muted">—</span>
                                                @endif
                                            </td>
                                            <td>{{ $row->created_at ? $row->created_at->format('d/m/Y H:i') : '' }}</td>
                                            <td>
                                                <label class="label {{ $statusLabel[$row->status] ?? 'label-default' }}">
                                                    {{ $statuses[$row->status] ?? $row->status }}
                                                </label>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="12">
                                                <div class="alert alert-danger alert-mg-b" role="alert">Không có bản ghi nào</div>
                                            </td>
                                        </tr>
                                    @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="custom-pagination">
                            {{ $booking->appends($requestData)->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
