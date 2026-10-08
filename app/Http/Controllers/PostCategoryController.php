<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Concerns\GeneratesSlug;
use App\Models\PostCategory;
use Illuminate\Http\Request;

/**
 * Danh mục bài viết blog (bảng post_categories).
 *
 * Mỗi bài thuộc đúng một danh mục qua posts.category_id. Không có FK constraint
 * trong DB nên xóa danh mục đang có bài sẽ để lại bài trỏ vào id không còn tồn
 * tại — delete() ở đây chặn trường hợp đó.
 *
 * Slug không cho nhập tay: sinh từ tên lúc TẠO MỚI rồi giữ nguyên. Sửa tên
 * không đổi slug, vì slug nằm trong URL và đổi là gãy link cũ.
 */
class PostCategoryController extends Controller
{
    use GeneratesSlug;

    private $category;

    public function __construct(PostCategory $category)
    {
        $this->category = $category;
    }

    public function index(Request $request)
    {
        $uri = 'post-category';
        $requestData = $request->all();

        $query = $this->category->withCount('posts')->ordered();

        if ($keyword = $request->input('name')) {
            $query->where(function ($q) use ($keyword) {
                $q->where('name', 'like', '%'.$keyword.'%')
                  ->orWhere('slug', 'like', '%'.$keyword.'%');
            });
        }

        if (($active = $request->input('is_active')) !== null && $active !== '') {
            $query->where('is_active', (int) $active);
        }

        $categories = $query->paginate(20);

        return view('admin.post-category.index', compact('uri', 'categories', 'requestData'));
    }

    public function create(Request $request)
    {
        $category = $this->category->newInstance([
            'is_active'  => true,
            'sort_order' => (int) $this->category->max('sort_order') + 10,
        ]);

        return view('admin.post-category.create', ['uri' => 'post-category', 'category' => $category]);
    }

    public function store(Request $request)
    {
        $data = $this->validated($request);
        $data['slug'] = $this->uniqueSlug($data['name'], 'post_categories');

        $this->category->create($data);

        return redirect()->route('admin.post-category')->with('success', 'Đã thêm danh mục mới');
    }

    public function edit(Request $request)
    {
        $category = $this->category->findOrFail($request->id);

        return view('admin.post-category.edit', ['uri' => 'post-category', 'category' => $category]);
    }

    public function update(Request $request)
    {
        $category = $this->category->findOrFail($request->id);

        if ($category->update($this->validated($request, $category->id))) {
            return redirect()->route('admin.post-category')->with('success', 'Cập nhật thành công');
        }

        return redirect()->back()->with('error', 'Cập nhật không thành công');
    }

    public function delete(Request $request)
    {
        $category = $this->category->withCount('posts')->findOrFail($request->id);

        // Bảng posts không có FK nên xóa ở đây sẽ để lại bài trỏ vào id chết:
        // bài vẫn hiện ngoài site nhưng mất breadcrumb và nhãn danh mục.
        if ($category->posts_count > 0) {
            return redirect()->route('admin.post-category')->with(
                'error',
                'Không xóa được "'.$category->name.'": còn '.$category->posts_count
                .' bài viết đang thuộc danh mục này. Chuyển các bài đó sang danh mục khác trước, '
                .'hoặc tắt danh mục thay vì xóa.'
            );
        }

        $name = $category->name;
        $category->delete();

        return redirect()->route('admin.post-category')->with('success', 'Đã xóa danh mục '.$name);
    }

    private function validated(Request $request)
    {
        $data = $request->validate([
            'name'        => ['required', 'string', 'max:120'],
            'description' => ['nullable', 'string', 'max:255'],
            'sort_order'  => ['nullable', 'integer'],
        ], [
            'name.required' => 'Chưa nhập tên danh mục.',
        ], [
            'name'        => 'tên danh mục',
            'description' => 'mô tả',
        ]);

        $data['is_active']  = $request->boolean('is_active');
        $data['sort_order'] = $data['sort_order'] ?? 0;

        return $data;
    }
}
