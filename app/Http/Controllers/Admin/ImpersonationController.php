<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ImpersonationController extends Controller
{
    public function show(int $id)
    {
        $admin = Auth::user();

        // Allow only admin role
        if (!$admin->hasRole('admin')) {
            abort(403, 'Unauthorized');
        }

        // Save the original admin ID
        session(['impersonator_id' => $admin->id]);

        // Store the target user ID in session
        session(['impersonate' => $id]);

        return redirect(route('dashboard'))->with('success', 'You are now impersonating another user.');
    }

    public function destroy()
    {
        if (!session()->has('impersonate')) {
            return redirect('/')->with('error', 'You are not impersonating any user.');
        }

        $impersonatorId = session('impersonator_id');

        // Forget impersonation sessions
        session()->forget(['impersonate', 'impersonator_id']);

        // Log back in as admin
        Auth::loginUsingId($impersonatorId);

        return redirect(route('dashboard'))->with('success', 'You have stopped impersonating.');
    }
}
