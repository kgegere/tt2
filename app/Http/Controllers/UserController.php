<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function show()
    {
        $user = Auth::user();
        return view('user.profile', compact('user'));
    }

    public function update(Request $request)
    {
        $user = Auth::user();

        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $user->id,
            'address' => 'required|string|max:255',
            'password' => 'nullable|string|min:8|confirmed',
        ]);

        if ($data['password']) {
            $data['password'] = bcrypt($data['password']);
        } else {
            unset($data['password']);
        }

        $user->update($data);
        return back()->with('success', 'Profile updated!');
    }

    public function promote(Request $request)
    {
        $request->validate(['email' => 'required|email|exists:users,email']);
        $target = User::where('email', $request->email)->first();

        if (!Auth::user()->isSeller() && !Auth::user()->isAdmin()) {
            abort(403);
        }

        $target->role = 'seller';
        $target->promoted_by = Auth::id();
        $target->save();

        return back()->with('success', __('messages.user_promoted_successfully'));
    }

    public function demote(Request $request)
    {
        if (!Auth::user()->isAdmin()) {
            abort(403);
        }

        $user = User::findOrFail($request->input('user_id'));
        $user->role = 'user';
        $user->promoted_by = null;
        $user->save();

        return back()->with('success', __('messages.user_demoted_successfully'));
    }

    public function adminShow($id)
    {
        if (!Auth::user()->isAdmin()) {
            abort(403);
        }
        $user = \App\Models\User::findOrFail($id);
        return view('user.profile', ['user' => $user]);
    }

    public function index()
    {
        if (!Auth::user()->isAdmin()) {
            abort(403);
        }
        $roles = [
            'admin' => __('messages.admin'),
            'seller' => __('messages.seller'),
            'user' => __('messages.user'),
        ];
        $dbRoles = \App\Models\User::distinct()->pluck('role')->toArray();
        $roles = array_intersect_key($roles, array_flip($dbRoles));

        $users = \App\Models\User::query()
            ->when(request('search'), function ($q) {
                $q->where(function ($query) {
                    $query->where('name', 'like', '%' . request('search') . '%')
                          ->orWhere('email', 'like', '%' . request('search') . '%');
                });
            })
            ->when(request('role'), fn($q) => $q->where('role', request('role')))
            ->get();

        return view('admin.users', compact('users', 'roles'));
    }
}
