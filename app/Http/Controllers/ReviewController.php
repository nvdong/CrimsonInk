<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Concerns\HandlesUploads;
use App\Models\Artist;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

/**
 * Đánh giá khách hàng (bảng reviews) — khối "My Happy Clients" ở trang chủ.
 *
 * Trang chủ chỉ lấy review đang bật VÀ có tick "Hiện trang chủ"
 * (is_active + is_featured), sắp theo sort_order rồi id. Nên muốn tạm giấu một
 * review thì bỏ tick thay vì xóa.
 *
 * source quyết định huy hiệu nguồn hiện cạnh tên khách ngoài trang chủ: hiện
 * mới chỉ có icon Google, các nguồn khác để trống chỗ đó.
 */
class ReviewController extends Controller
{
    use HandlesUploads;

    /** Khớp đúng enum cột source trong migration create_reviews_table. */
    public static $sources = [
        'manual'    => 'Tự nhập',
        'google'    => 'Google Maps',
        'facebook'  => 'Facebook',
        'instagram' => 'Instagram',
    ];

    private $review;

    public function __construct(Review $review)
    {
        $this->review = $review;
    }

    public function index(Request $request)
    {
        $uri = 'review';
        $requestData = $request->all();

        $query = $this->review->orderBy('sort_order')->orderBy('id');

        if ($keyword = $request->input('author_name')) {
            $query->where(function ($q) use ($keyword) {
                $q->where('author_name', 'like', '%'.$keyword.'%')
                  ->orWhere('content_vi', 'like', '%'.$keyword.'%')
                  ->orWhere('content_en', 'like', '%'.$keyword.'%');
            });
        }

        if (($source = $request->input('source')) !== null && $source !== '') {
            $query->where('source', $source);
        }

        if (($rating = $request->input('rating')) !== null && $rating !== '') {
            $query->where('rating', (int) $rating);
        }

        if (($active = $request->input('is_active')) !== null && $active !== '') {
            $query->where('is_active', (int) $active);
        }

        if (($featured = $request->input('is_featured')) !== null && $featured !== '') {
            $query->where('is_featured', (int) $featured);
        }

        $reviews = $query->paginate(20);

        return view('admin.review.index', [
            'uri'         => $uri,
            'reviews'     => $reviews,
            'requestData' => $requestData,
            'sources'     => static::$sources,
            'homeCount'   => $this->review->active()->featured()->count(),
        ]);
    }

    public function create(Request $request)
    {
        // sort_order mặc định đẩy xuống cuối danh sách, đỡ phải tự tính
        $review = $this->review->newInstance([
            'rating'      => 5,
            'source'      => 'google',
            'is_active'   => true,
            'is_featured' => true,
            'sort_order'  => (int) $this->review->max('sort_order') + 1,
            'reviewed_at' => now()->toDateString(),
        ]);

        return view('admin.review.create', $this->formData($review));
    }

    public function store(Request $request)
    {
        $this->review->create($this->validated($request));

        return redirect()->route('admin.review')->with('success', 'Đã thêm đánh giá mới');
    }

    public function edit(Request $request)
    {
        $review = $this->review->findOrFail($request->id);

        return view('admin.review.edit', $this->formData($review));
    }

    public function update(Request $request)
    {
        $review = $this->review->findOrFail($request->id);

        if ($review->update($this->validated($request, $review))) {
            return redirect()->route('admin.review')->with('success', 'Cập nhật thành công');
        }

        return redirect()->back()->with('error', 'Cập nhật không thành công');
    }

    public function delete(Request $request)
    {
        $review = $this->review->findOrFail($request->id);
        $name = $review->author_name;

        $review->delete();

        return redirect()->route('admin.review')->with('success', 'Đã xóa đánh giá của '.$name);
    }

    /** Dữ liệu dùng chung cho form thêm / sửa. */
    private function formData(Review $review)
    {
        return [
            'uri'     => 'review',
            'review'  => $review,
            'sources' => static::$sources,
            'artists' => Artist::orderBy('sort_order')->orderBy('id')->pluck('name_vi', 'id'),
        ];
    }

    /**
     * Ảnh đại diện: nhập tay đường dẫn HOẶC chọn file. Chọn file thì ghi đè
     * đường dẫn, giống cách làm ở Artist / Setting.
     *
     * content_vi và content_en đều nullable ở DB, nhưng để trống cả hai thì
     * ngoài trang chủ sẽ ra một thẻ rỗng — nên bắt buộc có ít nhất một bản.
     */
    private function validated(Request $request, Review $current = null)
    {
        $data = $request->validate([
            'author_name'        => ['required', 'string', 'max:120'],
            'author_country'     => ['nullable', 'string', 'max:60'],
            'author_avatar_path' => ['nullable', 'string', 'max:255'],
            'avatar_file'        => ['nullable', 'image', 'max:900'],
            'rating'             => ['required', 'integer', 'min:1', 'max:5'],
            'content_vi'         => ['nullable', 'string', 'required_without:content_en'],
            'content_en'         => ['nullable', 'string', 'required_without:content_vi'],
            'source'             => ['required', Rule::in(array_keys(static::$sources))],
            'source_url'         => ['nullable', 'url', 'max:255'],
            'reviewed_at'        => ['nullable', 'date'],
            'artist_id'          => ['nullable', 'integer'],
            'sort_order'         => ['nullable', 'integer'],
        ], [
            // Màn admin chạy ở locale mặc định nên Laravel dựng câu báo lỗi
            // bằng tiếng Anh; viết đè sẵn vài câu hay gặp cho dễ đọc.
            'author_name.required'      => 'Chưa nhập tên khách.',
            'rating.required'           => 'Chưa chọn số sao.',
            'content_vi.required_without' => 'Phải có nội dung ít nhất một ngôn ngữ — điền ô VI hoặc ô EN.',
            'content_en.required_without' => 'Phải có nội dung ít nhất một ngôn ngữ — điền ô VI hoặc ô EN.',
            'source_url.url'            => 'Link đánh giá gốc phải là một URL đầy đủ, bắt đầu bằng http:// hoặc https://.',
            'avatar_file.image'         => 'File chọn không phải ảnh.',
            'avatar_file.max'           => 'Ảnh đại diện không được quá 900KB (giới hạn upload của server).',
            'reviewed_at.date'          => 'Ngày đánh giá không hợp lệ.',
        ], [
            'author_name'        => 'tên khách',
            'author_country'     => 'quốc gia',
            'author_avatar_path' => 'đường dẫn ảnh đại diện',
            'avatar_file'        => 'ảnh đại diện',
            'rating'             => 'số sao',
            'content_vi'         => 'nội dung (VI)',
            'content_en'         => 'nội dung (EN)',
            'source'             => 'nguồn',
            'source_url'         => 'link đánh giá gốc',
            'reviewed_at'        => 'ngày đánh giá',
        ]);

        $data['author_avatar_path'] = $this->storeUpload(
            $request,
            'avatar_file',
            'review',
            $data['author_avatar_path'] ?? ($current ? $current->author_avatar_path : null)
        );

        // Ô select "— Không gắn —" gửi lên chuỗi rỗng, phải hóa null chứ không
        // để lọt số 0 vào cột artist_id.
        $data['artist_id'] = ($data['artist_id'] ?? null) ?: null;

        $data['is_active']   = $request->boolean('is_active');
        $data['is_featured'] = $request->boolean('is_featured');
        $data['sort_order']  = $data['sort_order'] ?? 0;

        unset($data['avatar_file']);

        return $data;
    }
}
