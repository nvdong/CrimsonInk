{{-- Menu chính trên header.
     Dữ liệu lấy từ bảng menu_items (location = 'header') — thêm/sửa/xóa mục
     và đổi thứ tự đều làm trong admin, không sửa file này.
     Giữ nguyên bộ class của ElementsKit để CSS và JS dropdown vẫn chạy. --}}
@php
    $menuItems = \App\Models\MenuItem::location('header')->active()->roots()->ordered()
        ->with('children')->get();
@endphp

<ul id="menu-main-menu" class="elementskit-navbar-nav elementskit-menu-po-right submenu-click-on-icon">
    @foreach ($menuItems as $item)
        @php
            $hasChildren = $item->children->isNotEmpty();
            $isActive    = $item->isActive();
        @endphp
        <li id="menu-item-{{ $item->id }}"
            class="menu-item menu-item-type-post_type menu-item-object-page nav-item elementskit-mobile-builder-content{{ $hasChildren ? ' menu-item-has-children elementskit-dropdown-has relative_position elementskit-dropdown-menu-default_width' : '' }}{{ $isActive ? ' current-menu-item current_page_item active' : '' }}"
            data-vertical-menu="750px">
            <a href="{{ $item->url }}"
                class="ekit-menu-nav-link{{ $hasChildren ? ' ekit-menu-dropdown-toggle' : '' }}{{ $isActive ? ' active' : '' }}"
                @if ($hasChildren) aria-haspopup="true" aria-expanded="false" aria-controls="ekit-submenu-{{ $item->id }}" @endif
                @if ($item->target_blank) target="_blank" rel="noopener" @endif>{{ $item->label }}@if ($hasChildren)<i aria-hidden="true" class="icon icon-down-arrow1 elementskit-submenu-indicator"></i>@endif</a>

            @if ($hasChildren)
                <ul class="elementskit-dropdown elementskit-submenu-panel" id="ekit-submenu-{{ $item->id }}">
                    @foreach ($item->children as $child)
                        <li id="menu-item-{{ $child->id }}"
                            class="menu-item menu-item-type-post_type menu-item-object-page nav-item elementskit-mobile-builder-content{{ $child->isActive() ? ' current-menu-item current_page_item active' : '' }}"
                            data-vertical-menu="750px">
                            <a href="{{ $child->url }}"
                                class="dropdown-item{{ $child->isActive() ? ' active' : '' }}"
                                @if ($child->target_blank) target="_blank" rel="noopener" @endif>{{ $child->label }}</a>
                        </li>
                    @endforeach
                </ul>
            @endif
        </li>
    @endforeach
</ul>
