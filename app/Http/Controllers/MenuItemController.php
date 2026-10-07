<?php

namespace App\Http\Controllers;

use App\Models\MenuItem;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

/**
 * Quản lý menu (bảng menu_items).
 *
 * location quyết định menu hiện ở đâu. Hiện site mới dùng 'header'; hai giá trị
 * footer_* đã có sẵn trong enum cho lúc chuyển 2 cột link dưới footer sang DB.
 *
 * Mục con: chọn "Thuộc mục" là một mục cha CÙNG location. Chỉ hỗ trợ 2 cấp —
 * menu của theme cũng chỉ đổ xuống 1 tầng.
 */
class MenuItemController extends Controller
{
    public static $locations = [
        'header'        => 'Menu trên đầu trang',
        'footer_quick'  => 'Footer - cột liên kết nhanh',
        'footer_styles' => 'Footer - cột phong cách',
    ];

    private $item;

    public function __construct(MenuItem $item)
    {
        $this->item = $item;
    }

    public function index(Request $request)
    {
        $uri = 'menu';
        $requestData = $request->all();

        $location = $request->input('location') ?: 'header';

        // lấy mục cha kèm mục con để hiển thị thụt vào, không phân trang cho dễ nhìn thứ tự
        $items = $this->item->location($location)->roots()->ordered()
            ->with(['children' => function ($q) {
                $q->orderBy('sort_order')->orderBy('id');
            }])
            ->get();

        $locations = static::$locations;

        return view('admin.menu.index', compact('uri', 'items', 'requestData', 'locations', 'location'));
    }

    public function create(Request $request)
    {
        $item = $this->item->newInstance([
            'location'  => $request->input('location', 'header'),
            'is_active' => true,
        ]);

        return view('admin.menu.create', $this->formData($item));
    }

    public function store(Request $request)
    {
        $this->item->create($this->validated($request));

        return redirect()->route('admin.menu', ['location' => $request->input('location')])
            ->with('success', 'Đã thêm mục menu');
    }

    public function edit(Request $request)
    {
        $item = $this->item->findOrFail($request->id);

        return view('admin.menu.edit', $this->formData($item));
    }

    public function update(Request $request)
    {
        $item = $this->item->findOrFail($request->id);

        $data = $this->validated($request, $item->id);

        if ($item->update($data)) {
            return redirect()->route('admin.menu', ['location' => $item->location])
                ->with('success', 'Cập nhật thành công');
        }

        return redirect()->back()->with('error', 'Cập nhật không thành công');
    }

    public function delete(Request $request)
    {
        $item = $this->item->findOrFail($request->id);

        $childCount = $item->children()->count();

        if ($childCount > 0) {
            return redirect()->route('admin.menu', ['location' => $item->location])
                ->with('error', 'Không xóa được: "'.$item->label_vi.'" đang có '.$childCount.' mục con. Xóa hoặc chuyển các mục con đi trước.');
        }

        $label = $item->label_vi;
        $location = $item->location;
        $item->delete();

        return redirect()->route('admin.menu', ['location' => $location])
            ->with('success', 'Đã xóa mục '.$label);
    }

    private function formData(MenuItem $item)
    {
        // mục cha khả dĩ: cùng location, là mục gốc, và không phải chính nó
        $parents = $this->item->location($item->location ?: 'header')->roots()->ordered()
            ->when($item->exists, function ($q) use ($item) {
                return $q->where('id', '!=', $item->id);
            })
            ->get();

        return [
            'uri'       => 'menu',
            'item'      => $item,
            'locations' => static::$locations,
            'parents'   => $parents,
            'routes'    => $this->routeNames(),
        ];
    }

    /** Danh sách route đặt tên bắt đầu bằng page. — để chọn thay vì gõ tay. */
    private function routeNames()
    {
        $names = [];

        foreach (app('router')->getRoutes() as $route) {
            $name = $route->getName();

            if ($name && strpos($name, 'page.') === 0 && strpos($name, '{') === false) {
                $names[$name] = $name;
            }
        }

        ksort($names);

        return $names;
    }

    private function validated(Request $request, $ignoreId = null)
    {
        $data = $request->validate([
            'location'   => ['required', Rule::in(array_keys(static::$locations))],
            'parent_id'  => ['nullable', 'integer', Rule::exists('menu_items', 'id')->where(function ($q) use ($request) {
                return $q->whereNull('parent_id')->where('location', $request->input('location'));
            })],
            'label_en'   => ['required', 'string', 'max:80'],
            'label_vi'   => ['nullable', 'string', 'max:80'],
            'route_name' => ['nullable', 'string', 'max:120'],
            'url'        => ['nullable', 'string', 'max:255'],
            'sort_order' => ['nullable', 'integer'],
        ], [
            'parent_id.exists' => 'Mục cha phải là một mục gốc thuộc cùng vị trí menu.',
        ], [
            'location' => 'vị trí',
            'label_en' => 'nhãn (EN)',
            'label_vi' => 'nhãn (VI)',
        ]);

        // không cho một mục vừa là cha vừa là con
        if ($ignoreId && ! empty($data['parent_id']) && $this->item->where('parent_id', $ignoreId)->exists()) {
            $data['parent_id'] = null;
        }

        $data['parent_id']    = $data['parent_id'] ?: null;
        $data['route_name']   = $data['route_name'] ?: null;
        $data['url']          = $data['url'] ?: null;
        $data['target_blank'] = $request->boolean('target_blank');
        $data['is_active']    = $request->boolean('is_active');
        $data['sort_order']   = $data['sort_order'] ?? 0;

        return $data;
    }
}
