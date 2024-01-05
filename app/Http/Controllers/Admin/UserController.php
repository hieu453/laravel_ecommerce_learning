<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\UserFormRequest;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index() {
        $users = User::all();
        return view('admin.users.index', compact('users'));
    }

    public function create() {
        return view('admin.users.create');
    }

    public function edit($userId) {
        $user = User::findOrFail($userId);
        return view('admin.users.edit', compact('user'));
    }

    public function store(UserFormRequest $request) {
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role_as' => (int) $request->role,
        ]);
        return redirect()->to('/admin/users')->with('message', 'User Created');
    }

    public function update($userId, UserFormRequest $request) {
        User::findOrFail($userId)->update([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role_as' => (int) $request->role,
        ]);
        return redirect()->to('/admin/users')->with('message', 'User Updated');
    }

    public function delete($userId) {
        User::findOrFail($userId)->delete();
        return redirect()->to('/admin/users')->with('message', 'User Deleted');
    }
}
