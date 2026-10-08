<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Concerns\GeneratesSlug;
use App\Http\Controllers\Concerns\HandlesUploads;
use App\Models\Post;
use App\Models\PostCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

/**
 * Bài viết blog (bảng posts) — /blog và /blog/{slug}.
 *
 * Vài điểm khác các màn CRUD còn lại:
 *
 *  - created_at CHO SỬA. Nó vừa là ngày trên thẻ ngoài /blog vừa là dòng
 *    "Cập nhật lần cuối" ở trang chi tiết, nên nhập lại bài cũ phải chỉnh được
 *    ngày. Laravel chỉ tự điền lúc insert, sau đó ghi đè bình thường.
 *  - takeaways là cột json, form gửi lên dạng mảng takeaways[] rồi lọc dòng
 *    rỗng trước khi lưu.
 *  - Dùng soft delete như tattoo_styles: có bộ lọc "Đã xóa" và nút khôi phục.
 *  - Slug không cho nhập tay: sinh từ tiêu đề lúc TẠO MỚI rồi giữ nguyên. Sửa
 *    tiêu đề không đổi slug — slug nằm trong URL /blog/{slug}, đổi là link đã
 *    chia sẻ và thứ hạng tìm kiếm của bài đó mất hết.
 */
class PostController extends Controller
{
    use GeneratesSlug;
    use HandlesUploads;

    private $post;

    public function __construct(Post $post)
    {
        $this->post = $post;
    }

    public function index(Request $request)
    {
        $uri = 'post';
        $requestData = $request->all();

        $trashed = $request->input('trashed') === '1';

        $query = $trashed ? $this->post->onlyTrashed() : $this->post->newQuery();
        $query->with('category')->newestFirst();

        if ($keyword = $request->input('title')) {
            $query->where(function ($q) use ($keyword) {
                $q->where('title', 'like', '%'.$keyword.'%')
                  ->orWhere('slug', 'like', '%'.$keyword.'%')
                  ->orWhere('excerpt', 'like', '%'.$keyword.'%');
            });
        }

        if (($categoryId = $request->input('category_id')) !== null && $categoryId !== '') {
            $query->where('category_id', (int) $categoryId);
        }

        if (($active = $request->input('is_active')) !== null && $active !== '') {
            $query->where('is_active', (int) $active);
        }

        $posts = $query->paginate(20);

        return view('admin.post.index', [
            'uri'         => $uri,
            'posts'       => $posts,
            'requestData' => $requestData,
            'categories'  => PostCategory::ordered()->pluck('name', 'id'),
            'trashed'     => $trashed,
        ]);
    }

    public function create(Request $request)
    {
        $post = $this->post->newInstance([
            'is_active'   => true,
            'author_name' => 'Crimson Ink Studio',
        ]);

        return view('admin.post.create', $this->formData($post));
    }

    public function store(Request $request)
    {
        $data = $this->validated($request);

        $data['slug'] = $this->uniqueSlug($data['title'], 'posts');

        // Ghi lại ai tạo bài, chỉ dùng để lọc trong admin.
        $data['user_id'] = optional($request->user())->id;

        $this->post->create($data);

        return redirect()->route('admin.post')->with('success', 'Đã thêm bài viết mới');
    }

    public function edit(Request $request)
    {
        $post = $this->post->withTrashed()->findOrFail($request->id);

        return view('admin.post.edit', $this->formData($post));
    }

    public function update(Request $request)
    {
        $post = $this->post->withTrashed()->findOrFail($request->id);

        if ($post->update($this->validated($request))) {
            return redirect()->route('admin.post')->with('success', 'Cập nhật thành công');
        }

        return redirect()->back()->with('error', 'Cập nhật không thành công');
    }

    public function delete(Request $request)
    {
        $post = $this->post->findOrFail($request->id);
        $title = $post->title;

        $post->delete();

        return redirect()->route('admin.post')
            ->with('success', 'Đã xóa "'.$title.'". Vào bộ lọc "Đã xóa" để khôi phục.');
    }

    public function restore(Request $request)
    {
        $post = $this->post->onlyTrashed()->findOrFail($request->id);
        $post->restore();

        return redirect()->route('admin.post')->with('success', 'Đã khôi phục "'.$post->title.'"');
    }

    private function formData(Post $post)
    {
        return [
            'uri'        => 'post',
            'post'       => $post,
            'categories' => PostCategory::ordered()->pluck('name', 'id'),
        ];
    }

    private function validated(Request $request)
    {
        $data = $request->validate([
            'title'            => ['required', 'string', 'max:190'],
            'excerpt'          => ['nullable', 'string', 'max:300'],
            'content'          => ['nullable', 'string'],
            'cover_path'       => ['nullable', 'string', 'max:255'],
            'cover_file'       => ['nullable', 'image', 'max:5120'],
            'author_name'      => ['nullable', 'string', 'max:120'],
            'category_id'      => ['nullable', 'integer'],
            'meta_title'       => ['nullable', 'string', 'max:190'],
            'meta_description' => ['nullable', 'string', 'max:300'],
            'created_at'       => ['nullable', 'date'],
            'takeaways'        => ['nullable', 'array'],
            'takeaways.*'      => ['nullable', 'string', 'max:500'],
        ], [
            'title.required'  => 'Chưa nhập tiêu đề bài viết.',
            'cover_file.max'  => 'Ảnh bìa không được quá 5MB.',
            'created_at.date' => 'Ngày đăng không hợp lệ.',
        ], [
            'title'            => 'tiêu đề',
            'excerpt'          => 'tóm tắt',
            'cover_file'       => 'ảnh bìa',
            'author_name'      => 'tên tác giả',
            'meta_description' => 'meta description',
        ]);

        $data['cover_path'] = $this->storeUpload($request, 'cover_file', 'post', $data['cover_path'] ?? null);

        // Ô select "— Không gắn —" gửi lên chuỗi rỗng; để nguyên thì lọt số 0
        // vào cột category_id và bài trỏ vào một danh mục không tồn tại.
        $data['category_id'] = ($data['category_id'] ?? null) ?: null;

        // Hộp "Điểm chính": bỏ dòng trống rồi mới lưu, không thì ngoài site
        // hiện ra mấy gạch đầu dòng rỗng.
        $takeaways = array_values(array_filter(
            array_map('trim', (array) ($data['takeaways'] ?? [])),
            function ($line) {
                return $line !== '';
            }
        ));
        $data['takeaways'] = $takeaways ?: null;

        // Bỏ trống thì để Laravel tự điền lúc insert / giữ nguyên khi sửa.
        if (empty($data['created_at'])) {
            unset($data['created_at']);
        } else {
            $data['created_at'] = Carbon::parse($data['created_at']);
        }

        $data['is_active'] = $request->boolean('is_active');

        unset($data['cover_file']);

        return $data;
    }
}
