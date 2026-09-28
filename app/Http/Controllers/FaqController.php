<?php

namespace App\Http\Controllers;

use App\Models\Faq;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

/**
 * Câu hỏi thường gặp (bảng faqs).
 *
 * Nhóm (group) dùng để tách FAQ theo chủ đề và lọc khi hiển thị ngoài site,
 * ví dụ chỉ lấy nhóm 'booking' gắn vào trang đặt lịch.
 */
class FaqController extends Controller
{
    public static $groups = [
        'booking'   => 'Đặt lịch',
        'aftercare' => 'Chăm sóc sau xăm',
        'pricing'   => 'Giá cả',
        'general'   => 'Chung',
    ];

    private $faq;

    public function __construct(Faq $faq)
    {
        $this->faq = $faq;
    }

    public function index(Request $request)
    {
        $uri = 'faq';
        $requestData = $request->all();

        $query = $this->faq->orderBy('group')->orderBy('sort_order')->orderBy('id');

        if ($keyword = $request->input('question')) {
            $query->where(function ($q) use ($keyword) {
                $q->where('question_vi', 'like', '%'.$keyword.'%')
                  ->orWhere('question_en', 'like', '%'.$keyword.'%');
            });
        }

        if (($group = $request->input('group')) !== null && $group !== '') {
            $query->where('group', $group);
        }

        if (($active = $request->input('is_active')) !== null && $active !== '') {
            $query->where('is_active', (int) $active);
        }

        $faqs   = $query->paginate(20);
        $groups = static::$groups;

        return view('admin.faq.index', compact('uri', 'faqs', 'requestData', 'groups'));
    }

    public function create(Request $request)
    {
        $uri = 'faq';
        $faq = $this->faq->newInstance([
            'group'      => 'booking',
            'is_active'  => true,
            'sort_order' => 0,
        ]);

        return view('admin.faq.create', ['uri' => $uri, 'faq' => $faq, 'groups' => static::$groups]);
    }

    public function store(Request $request)
    {
        $this->faq->create($this->validated($request));

        return redirect()->route('admin.faq')->with('success', 'Đã thêm câu hỏi mới');
    }

    public function edit(Request $request)
    {
        $uri = 'faq';
        $faq = $this->faq->findOrFail($request->id);

        return view('admin.faq.edit', ['uri' => $uri, 'faq' => $faq, 'groups' => static::$groups]);
    }

    public function update(Request $request)
    {
        $faq = $this->faq->findOrFail($request->id);

        if ($faq->update($this->validated($request))) {
            return redirect()->route('admin.faq')->with('success', 'Cập nhật thành công');
        }

        return redirect()->back()->with('error', 'Cập nhật không thành công');
    }

    public function delete(Request $request)
    {
        $faq = $this->faq->findOrFail($request->id);
        $faq->delete();

        return redirect()->route('admin.faq')->with('success', 'Đã xóa câu hỏi');
    }

    private function validated(Request $request)
    {
        $data = $request->validate([
            'group'       => ['required', Rule::in(array_keys(static::$groups))],
            'question_en' => ['required', 'string', 'max:255'],
            'question_vi' => ['required', 'string', 'max:255'],
            'answer_en'   => ['nullable', 'string'],
            'answer_vi'   => ['nullable', 'string'],
            'sort_order'  => ['nullable', 'integer'],
        ], [], [
            'group'       => 'nhóm',
            'question_en' => 'câu hỏi (EN)',
            'question_vi' => 'câu hỏi (VI)',
        ]);

        $data['is_active']  = $request->boolean('is_active');
        $data['sort_order'] = $data['sort_order'] ?? 0;

        return $data;
    }
}
