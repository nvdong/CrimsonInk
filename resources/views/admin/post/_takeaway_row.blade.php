{{-- Một dòng của hộp "Điểm chính".

     Tên ô là takeaways[] không có chỉ số: thứ tự do DOM quyết định, xóa dòng
     giữa chừng cũng không để lại lỗ hổng trong mảng như takeaways[2]. --}}
<div class="ci-takeaway-row" style="display:flex;gap:8px;margin-bottom:8px">
    <input name="takeaways[]" class="form-control" maxlength="500"
           placeholder="Việt Nam có &lt;b&gt;nền văn hóa xăm giàu biểu tượng&lt;/b&gt;..."
           value="{{ $line }}" type="text">
    <button type="button" class="btn btn-danger ci-remove-takeaway" title="Xóa dòng">&times;</button>
</div>
