{{-- Một kênh mạng xã hội. $i là chỉ số trong mảng social_links[]. --}}
<div class="ci-social-row" style="border:1px solid #e3e3e3;padding:10px;margin-bottom:8px;background:#fafafa">
    <div class="col-md-3" style="padding-left:0">
        <label style="font-size:12px">Kênh</label>
        <select name="social_links[{{ $i }}][platform]" class="form-control input-sm">
            @foreach ($platforms as $key => $label)
                <option value="{{ $key }}" @if (($link['platform'] ?? '') === $key) selected @endif>{{ $label }}</option>
            @endforeach
        </select>
    </div>
    <div class="col-md-3">
        <label style="font-size:12px">Nhãn hiển thị</label>
        <input name="social_links[{{ $i }}][label]" class="form-control input-sm" maxlength="80"
               placeholder="WhatsApp" value="{{ $link['label'] ?? '' }}" type="text">
    </div>
    <div class="col-md-4">
        <label style="font-size:12px">Link</label>
        <input name="social_links[{{ $i }}][url]" class="form-control input-sm" maxlength="255"
               placeholder="https://..." value="{{ $link['url'] ?? '' }}" type="text">
    </div>
    <div class="col-md-2" style="padding-right:0">
        <label style="font-size:12px">Thứ tự</label>
        <input name="social_links[{{ $i }}][sort]" class="form-control input-sm"
               value="{{ $link['sort'] ?? 0 }}" type="number">
    </div>

    <div class="clearfix"></div>

    <div style="padding-top:8px">
        <label style="font-weight:normal;margin-right:14px">
            <input type="checkbox" name="social_links[{{ $i }}][footer]" value="1"
                   @if (!empty($link['footer'])) checked @endif> Footer
        </label>
        <label style="font-weight:normal;margin-right:14px">
            <input type="checkbox" name="social_links[{{ $i }}][dock]" value="1"
                   @if (!empty($link['dock'])) checked @endif> Thanh neo góc phải
        </label>
        <label style="font-weight:normal;margin-right:14px">
            <input type="checkbox" name="social_links[{{ $i }}][header]" value="1"
                   @if (!empty($link['header'])) checked @endif> Header
        </label>
        <button type="button" class="btn btn-xs btn-danger pull-right ci-remove-social">Xóa kênh</button>
    </div>
    <div class="clearfix"></div>
</div>
