<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Inertia;

class UserController extends Controller
{
    public function index()
    {
        $data = request()->all();
        $users = UserResource::collection(
            User::role(['user'])
                ->where(function ($query) use ($data) {
                    if (isset($data['search'])) {
                        $query->where('name', 'LIKE', '%' . trim($data['search']) . '%')
                            ->orWhere('email', 'LIKE', '%' . trim($data['search']) . '%');
                    }
                })
                ->paginate(10)
        );
        return Inertia::render('admin/user/Index', compact('users'));
    }

    public function show(User $user)
    {
        return Inertia::render('admin/user/Edit', compact('user'));
    }

    public function update(User $user)
    {
//        return Inertia::render('admin/user/Edit', compact('user'));
    }
}
