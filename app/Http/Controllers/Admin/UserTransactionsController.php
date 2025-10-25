<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Resources\TransactionResource;
use App\Http\Resources\UserResource;
use App\Models\User;
use Bavix\Wallet\Models\Transaction;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Inertia\Inertia;

class UserTransactionsController extends Controller
{
    public function index(Request $request)
    {
        $query = Transaction::query()->with('payable');

        // Filter by user name or email
        $query->whereHas('payable', function ($q) use ($request) {
            if ($request->user) {
                $q->where(function ($query) use ($request) {
                    $query->where('name', 'LIKE', '%' . trim($request->user) . '%');
                    $query->orWhere('email', 'LIKE', '%' . trim($request->user) . '%');
                });
            }
        });

        // Filter by type (if stored in meta)
        if ($request->type) {
            $query->whereRaw(
                "LOWER(JSON_UNQUOTE(JSON_EXTRACT(meta, '$.type'))) LIKE ?",
                ['%' . strtolower(trim($request->type)) . '%']
            );
        }

        // Filter by amount start
        if ($request->amount) {
            $query->where('amount', 'LIKE', trim($request->amount) . '%');
        }

        // Filter by date range
        if ($request->start_date) {
            $query->whereDate('created_at', '>=', Carbon::parse($request->start_date)->startOfDay());
        }
        if ($request->end_date) {
            $query->whereDate('created_at', '<=', Carbon::parse($request->end_date)->endOfDay());
        }

        $transactions = TransactionResource::collection($query->paginate(10));

        return Inertia::render('admin/userTransaction/Index', compact('transactions'));
    }

}
