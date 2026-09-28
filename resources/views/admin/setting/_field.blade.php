{{-- Một ô nhập của bảng cấu hình. Ô nào hiện tùy theo cột type của dòng đó. --}}
@php
    $name  = 'values['.$row->id.']['.$column.']';
    $value = old('values.'.$row->id.'.'.$column, $row->{$column});
@endphp

@switch($row->type)
    @case('textarea')
        <textarea name="{{ $name }}" class="form-control" rows="3">{{ $value }}</textarea>
        @break

    @case('html')
        <textarea name="{{ $name }}" class="summernote form-control">{{ $value }}</textarea>
        @break

    @case('json')
        @if ($column === 'value' && $row->group.'.'.$row->key === 'social.links')
            @include('admin.setting._social', ['row' => $row])
        @elseif ($column === 'value')
            <textarea name="{{ $name }}" class="form-control" rows="6"
                      style="font-family:monospace;font-size:12px">{{ $value }}</textarea>
            <small class="text-muted">Sai cú pháp JSON thì dòng này sẽ không được lưu và báo lại ở đầu trang.</small>
        @endif
        @break

    @case('bool')
        @if ($column === 'value')
            <select name="{{ $name }}" class="form-control">
                <option value="1" @if ((string) $value === '1') selected @endif>Bật</option>
                <option value="0" @if ((string) $value !== '1') selected @endif>Tắt</option>
            </select>
        @endif
        @break

    @case('number')
        @if ($column === 'value')
            <input type="number" name="{{ $name }}" class="form-control" value="{{ $value }}">
        @endif
        @break

    @case('image')
        @if ($column === 'value')
            @if ($value)
                <img src="{{ asset($value) }}" alt="" style="max-height:50px;margin-bottom:6px;background:#222;padding:4px">
            @endif
            <input type="text" name="{{ $name }}" class="form-control" value="{{ $value }}"
                   placeholder="assets/imgs/logo.png">
            <input type="file" name="file_{{ $row->id }}" accept="image/*" style="margin-top:6px">
            <small class="text-muted">Chọn file mới sẽ ghi đè đường dẫn ở trên.</small>
        @endif
        @break

    @default
        <input type="text" name="{{ $name }}" class="form-control" value="{{ $value }}">
@endswitch
