@extends('layouts.admin.main')
@section('content')

    <div class="analytics-sparkle-area">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="product-status-wrap">
                        <h4>Danh sách Chiến dịch</h4>
                        @include('layouts.admin._message',['errors'=>$errors])
                        <div class="add-product">
                            <a href="{{route('admin.campaigns.create')}}">Tạo Chiến dịch mới</a>
                        </div>
                        <div class="sparkline10-graph">
                            <div class="static-table-list table-responsive">

                                <table class="table table-striped">
                                    <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Tên chiến dịch</th>
                                        <th>Hình Ảnh</th>
                                        <th>Ngày hết hạn</th>
                                        <th>Số tiền quyên góp hiện tại</th>
                                        <th>Trạng thái</th>
                                        <th>Hành động</th>
                                    </tr>
                                    <tr>
                                        {{Form::open(array('route'=>'admin.campaigns','method'=>'get'))}}
                                        <td class="hasinput"></td>
                                        <td class="hasinput">
                                            {!! Form::text('title',Request::input('title'),array('class'=>'form-control','placeholder'=>'Tiêu đề')) !!}
                                        </td>
                                        <td class="hasinput"></td>
                                        <td class="hasinput"></td>
                                        <td class="hasinput"></td>

                                        <td class="hasinput">
                                            {!! Form::select('stat',array(''=>'Tất cả',1=>'Nháp',2=>'Công bố'),Request::input('status'),array('class'=>'form-control','placeholder'=>'Trạng thái')) !!}
                                        </td>
                                        <td class="hasinput">
                                            {{Form::submit('Tìm kiếm',array('class'=>'btn btn-sm btn-primary'))}}
                                        </td>
                                        {{Form::close()}}
                                    </tr>
                                    @if(empty($campaigns))
                                        <div class="alert alert-danger alert-mg-b" role="alert">
                                            Bạn chưa có bản ghi nào
                                        </div>
                                    @endif
                                    </thead>
                                    <tbody>
                                    @foreach($campaigns as $row)
                                        <tr>
                                            <td>{{$row->id}}</td>
                                            <td>{{ Str::limit($row->title, 40) }}</td>
                                            <td><img src="{{ $row->image_url}}"  width="100"></td>
                                            <td>{{$row->expire_date}}</td>
                                            <td>{{$row->current_money ?? 0}} VND</td>
                                            <td>
                                            <label class="label {{ config('constants.campaign.status_color.' . $row->stat) }}">
                                                @lang('constants.campaign.status.' . $row->stat)
                                            </label>
                                            </td>
                                            <td>
                                                <ul class="action-control">
                                                    <li>
                                                        <a href="{{ route('admin.campaigns.edit', $row) }}" class="btn btn-sm btn-clean btn-icon btn-icon-md">
                                                            <i class="fa fa-pencil-square-o fa-2x" aria-hidden="true"></i>
                                                        </a>
                                                    </li>
{{--                                                    <li>--}}
{{--                                                        {!! Form::open(['method' => 'DELETE','route' => ['admin.authors.destroy', $author->id ],'style'=>'display:inline', 'id'=>'form-delete-' . $author->id]) !!}--}}
{{--                                                        {{ Form::submit('Delete', array('class' => 'btn btn-warning btn-sm')) }}--}}
{{--                                                        {!! Form::close() !!}--}}
{{--                                                    </li>--}}

                                                </ul>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="custom-pagination">
                            {{ $campaigns->appends($requestData)->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
