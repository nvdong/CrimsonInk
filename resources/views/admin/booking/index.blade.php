@extends('layouts.admin.main')
@section('content')

    <div class="analytics-sparkle-area">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="product-status-wrap">
                        <h4>Danh sách Đặt lịch</h4>
                        @include('layouts.admin._message',['errors'=>$errors])
                        <div class="add-product">
                            <a href="#">#</a>
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
                                        <th>Thời gian đặt</th>
                                        <th>Trạng thái</th>
                                    </tr>
                                    <tr>
                                        {{Form::open(array('route'=>'admin.booking','method'=>'get'))}}
                                        <td class="hasinput"></td>
                                        <td class="hasinput">
                                            {!! Form::text('code',Request::input('code'),array('class'=>'form-control','placeholder'=>'Mã đặt chỗ')) !!}
                                        </td>
                                        <td class="hasinput"></td>
                                        <td class="hasinput">
                                            {!! Form::text('email',Request::input('email'),array('class'=>'form-control','placeholder'=>'Email')) !!}
                                        </td>
                                        <td class="hasinput">
                                            {!! Form::text('phone',Request::input('phone'),array('class'=>'form-control','placeholder'=>'Số ĐT')) !!}
                                        </td>
                                        <td class="hasinput"></td>
                                        <td class="hasinput"></td>
                                        <td class="hasinput"></td>

                                        <td class="hasinput">
                                            {!! Form::select('stat',array(''=>'Tất cả','new'=>'Mới đặt','contacted'=>'Đã liên hệ','done'=>'Đã hoàn thành'),Request::input('status'),array('class'=>'form-control','placeholder'=>'Trạng thái')) !!}
                                        </td>
                                        <td class="hasinput">
                                            {{Form::submit('Tìm kiếm',array('class'=>'btn btn-sm btn-primary'))}}
                                        </td>
                                        {{Form::close()}}
                                    </tr>
                                    @if(empty($booking))
                                        <div class="alert alert-danger alert-mg-b" role="alert">
                                            Bạn chưa có bản ghi nào
                                        </div>
                                    @endif
                                    </thead>
                                    <tbody>
                                    @foreach($booking as $row)
                                        <tr>
                                            <td>{{$row->id}}</td>
                                            <td>{{$row->code}}</td>
                                            <td>{{$row->full_name}}</td>
                                            <td>{{$row->email}}</td>
                                            <td>{{$row->phone}}</td>
                                            <td>{{$row->preferred_date}}</td>
                                            <td>{{$row->artist->name_vi}}</td>
                                            <td>{{$row->created_at}}</td>
                                            <td>
                                            <label class="label success">
                                                {{ $row->status }}
                                            </label>
                                            </td>
                                            <td>
                                                <ul class="action-control">
                                                    <li>
                                                        <a href="{{ route('admin.booking.edit', $row) }}" class="btn btn-sm btn-clean btn-icon btn-icon-md">
                                                            <i class="fa fa-pencil-square-o fa-2x" aria-hidden="true"></i>
                                                        </a>
                                                    </li>

                                                </ul>
                                            </td>
                                        </tr>
                                    @endforeach
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
