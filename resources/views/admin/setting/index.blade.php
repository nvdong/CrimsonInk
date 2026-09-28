@extends('layouts.admin.main')
@section('content')

    <div class="analytics-sparkle-area">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="product-status-wrap">
                        <h4>Cấu hình website</h4>
                        @include('layouts.admin._message',['errors'=>$errors])
                        <div class="add-product">
                            <a href="{{ route('admin.setting.create') }}">Thêm cấu hình</a>
                        </div>

                        <p class="text-muted" style="padding:0 20px 10px">
                            Cột <b>Giá trị chung</b> dùng cho dữ liệu không cần dịch (số điện thoại, đường dẫn ảnh, JSON).
                            Hai cột <b>EN</b> / <b>VI</b> chỉ dùng khi nội dung cần dịch — điền cột chung thì hai cột kia bị bỏ qua.
                        </p>

                        {!! Form::open(['url' => route('admin.setting.update'), 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}

                        @foreach ($grouped as $group => $rows)
                            <div class="sparkline10-graph">
                                <h5 style="padding:10px 20px;margin:0;border-bottom:1px solid #eee">
                                    {{ $groups[$group] ?? $group }}
                                    <small class="text-muted">({{ $group }})</small>
                                </h5>
                                <div class="static-table-list table-responsive">
                                    <table class="table table-striped">
                                        <thead>
                                        <tr>
                                            <th style="width:180px">Khóa</th>
                                            <th style="width:110px">Kiểu</th>
                                            <th>Giá trị chung</th>
                                            <th>EN</th>
                                            <th>VI</th>
                                            <th style="width:60px"></th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach ($rows as $row)
                                            <tr>
                                                <td><code>{{ $row->key }}</code></td>
                                                <td><span class="label label-default">{{ $types[$row->type] ?? $row->type }}</span></td>
                                                <td>
                                                    @include('admin.setting._field', ['row' => $row, 'column' => 'value'])
                                                </td>
                                                <td>
                                                    @if (in_array($row->type, ['text','textarea','html']))
                                                        @include('admin.setting._field', ['row' => $row, 'column' => 'value_en'])
                                                    @else
                                                        <span class="text-muted">—</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    @if (in_array($row->type, ['text','textarea','html']))
                                                        @include('admin.setting._field', ['row' => $row, 'column' => 'value_vi'])
                                                    @else
                                                        <span class="text-muted">—</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    <a href="{{ route('admin.setting.delete', $row->id) }}"
                                                       class="btn btn-sm btn-clean btn-icon btn-icon-md"
                                                       onclick="return confirm('Xóa cấu hình {{ $row->group }}.{{ $row->key }}? Chỗ nào ngoài site đang đọc khóa này sẽ về giá trị mặc định.')">
                                                        <i class="fa fa-trash-o fa-2x" aria-hidden="true"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        @endforeach

                        <div class="d-flex justify-content-between mt-4 mb-5" style="padding:20px">
                            <button type="submit" class="btn btn-primary">Lưu tất cả</button>
                        </div>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('scripts')
    <script>
        $(function () {
            $('.summernote').summernote({ height: 180 });

            var nextSocial = $('#ci-social-rows .ci-social-row').length;

            $('#ci-add-social').on('click', function () {
                var html = $('#ci-social-template').html().split('__INDEX__').join(nextSocial);
                nextSocial++;
                $('#ci-social-rows').append(html);
            });

            $('#ci-social-rows').on('click', '.ci-remove-social', function () {
                $(this).closest('.ci-social-row').remove();
            });
        });
    </script>
@endsection
