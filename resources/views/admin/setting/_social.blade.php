{{-- Trình soạn riêng cho dòng settings social.links.
     Trong DB vẫn là một chuỗi JSON; ở đây tách thành từng ô cho dễ nhập.
     Controller ghép lại khi lưu. --}}
@php
    $links = json_decode($row->value, true);
    $links = is_array($links) ? $links : [];
@endphp

<input type="hidden" name="social_links_present" value="1">

<div id="ci-social-rows">
    @foreach ($links as $i => $link)
        @include('admin.setting._social_row', ['i' => $i, 'link' => $link, 'platforms' => $platforms])
    @endforeach
</div>

<button type="button" class="btn btn-default btn-sm" id="ci-add-social">+ Thêm kênh</button>

<small class="text-muted" style="display:block;margin-top:8px">
    Bỏ trống ô Link là kênh đó biến mất khỏi website. Cột <b>Footer</b> / <b>Thanh neo</b> / <b>Header</b>
    quyết định icon hiện ở đâu.
</small>

<script type="text/template" id="ci-social-template">
    @include('admin.setting._social_row', ['i' => '__INDEX__', 'link' => [], 'platforms' => $platforms])
</script>
