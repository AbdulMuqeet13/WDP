<?php

namespace App\Http\Controllers\User;

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
            User::query()
                ->where('referred_by', auth()->id())
                ->where(function ($query) use ($data) {
                    if (isset($data['search'])) {
                        $query->where('name', 'LIKE', '%' . trim($data['search']) . '%')
                            ->orWhere('email', 'LIKE', '%' . trim($data['search']) . '%');
                    }
                })
                ->paginate(10)
        );
        return Inertia::render('User/user/Index', compact('users'));
    }
}
