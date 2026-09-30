<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;


class UserController extends Controller
{
    private $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function index(Request $request)
    {
        $uri = 'user';
        $requestData = $request->all();

        $query = $this->user->orderBy('id');

        if ($keyword = $request->input('keyword')) {
            $query->where(function ($q) use ($keyword) {
                $q->where('full_name', 'like', '%'.$keyword.'%')
                  ->orWhere('email', 'like', '%'.$keyword.'%')
                  ->orWhere('phone', 'like', '%'.$keyword.'%');
            });
        }

        if (($role = $request->input('role')) !== null && $role !== '') {
            $query->where('role', $role);
        }

        if (($stat = $request->input('stat')) !== null && $stat !== '') {
            $query->where('stat', (int) $stat);
        }

        $users = $query->paginate(20);

        return view('admin.user.index', [
            'uri'         => $uri,
            'users'       => $users,
            'requestData' => $requestData,
            'roles'       => User::$roles,
        ]);
    }

    public function create(Request $request)
    {
        $user = $this->user->newInstance([
            'role' => User::ROLE_EDITOR,
            'stat' => 1,
        ]);

        return view('admin.user.create', $this->formData($user));
    }

    public function store(Request $request)
    {
        $data = $this->validated($request);

        $this->user->create($data);

        return redirect()->route('admin.user')->with('success', 'Đã thêm tài khoản '.$data['email']);
    }

    public function edit(Request $request)
    {
        $user = $this->user->findOrFail($request->id);

        return view('admin.user.edit', $this->formData($user));
    }

    public function update(Request $request)
    {
        $user = $this->user->findOrFail($request->id);
        $data = $this->validated($request, $user->id);

        if ($error = $this->guard($user, $data['role'], (int) $data['stat'])) {
            return redirect()->back()->withInput()->with('error', $error);
        }

        $user->update($data);

        return redirect()->route('admin.user')->with('success', 'Cập nhật thành công');
    }

    public function delete(Request $request)
    {
        $user = $this->user->findOrFail($request->id);

        // xóa = vừa mất quyền vừa mất trạng thái, nên kiểm tra cả hai
        if ($error = $this->guard($user, User::ROLE_EDITOR, 0, true)) {
            return redirect()->route('admin.user')->with('error', $error);
        }

        $email = $user->email;
        $user->delete();

        return redirect()->route('admin.user')->with('success', 'Đã xóa tài khoản '.$email);
    }

    private function guard(User $user, $newRole, $newStat, $deleting = false)
    {
        $me = auth()->id();

        if ($user->id === $me) {
            if ($deleting) {
                return 'Không tự xóa tài khoản của mình được. Nhờ một admin khác xóa hộ.';
            }

            if ($newRole !== $user->role) {
                return 'Không tự đổi quyền của mình được — đổi xong là mất luôn quyền vào mục này. Nhờ một admin khác đổi hộ.';
            }

            if ($newStat !== 1) {
                return 'Không tự khóa tài khoản của mình được.';
            }
        }

        // Đang là admin đang hoạt động mà sắp thôi làm admin (hoặc bị khóa/xóa)
        $isActiveAdmin = $user->isAdmin() && $user->isActive();
        $stillActiveAdmin = ($newRole === User::ROLE_ADMIN) && $newStat === 1;

        if ($isActiveAdmin && ! $stillActiveAdmin && $this->activeAdminCount() <= 1) {
            return 'Đây là admin đang hoạt động duy nhất. Cấp quyền admin cho một người khác trước đã, không thì không ai vào được mục này nữa.';
        }

        return null;
    }

    private function activeAdminCount()
    {
        return $this->user->where('role', User::ROLE_ADMIN)->where('stat', 1)->count();
    }

    private function formData(User $user)
    {
        return [
            'uri'   => 'user',
            'user'  => $user,
            'roles' => User::$roles,
            'isSelf' => $user->exists && $user->id === auth()->id(),
        ];
    }

    private function validated(Request $request, $ignoreId = null)
    {
        $data = $request->validate([
            'full_name' => ['required', 'string', 'max:255'],
            'email'     => ['required', 'email', 'max:255', Rule::unique('users')->ignore($ignoreId)],
            'phone'     => ['nullable', 'string', 'max:20', Rule::unique('users')->ignore($ignoreId)],
            'role'      => ['required', Rule::in(array_keys(User::$roles))],
        ], [
            'email.unique' => 'Email này đã có tài khoản rồi.',
            'phone.unique' => 'Số điện thoại này đã có tài khoản rồi.',
        ], [
            'full_name' => 'họ tên',
            'email'     => 'email',
            'phone'     => 'số điện thoại',
            'role'      => 'quyền',
        ]);

        // ?? chứ không phải ?: — phone là nullable, request không gửi key này lên
        // thì validate không đưa nó vào $data và $data['phone'] bắn Undefined index.
        //
        // Và phải đẩy chuỗi rỗng về NULL: phone là cột unique, để '' thì người
        // thứ hai bỏ trống sẽ đụng trùng (MySQL cho nhiều NULL trong cột unique).
        $data['phone'] = ($data['phone'] ?? null) ?: null;
        $data['stat']  = $request->boolean('stat') ? 1 : 0;

        return $data;
    }
}
