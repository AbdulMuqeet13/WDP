<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Transaction\UpdateTransactionRequest;
use App\Http\Resources\UserTransactionResource;
use App\Models\UserTransaction;

class TransactionController extends Controller
{
    public function index()
    {
        $transactions = UserTransaction::query()->with('user')
            ->where('status', 'pending')
            ->orderBy('created_at', 'desc')
            ->get();

        return inertia('admin/transactions/Index', [
            'transactions' => UserTransactionResource::collection($transactions)->resolve(),
        ]);
    }

    public function update(UserTransaction $transaction, UpdateTransactionRequest $request)
    {
        $data = $request->validated();
        if ($transaction->status !== 'pending') {
            return back()->with('error', 'Transaction already processed.');
        }

        if ($data['status'] === 'approved') {
            $user = $transaction->user;

            if ($transaction->type === 'deposit') {
                $user->deposit($transaction->amount);
            } elseif ($transaction->type === 'withdraw') {
                $user->withdraw($transaction->amount);
            }
        }

        $transaction->update(['status' => $data['status']]);

        return back()->with('success', 'Transaction ' . $data['status'] . ' successfully.');
    }
}
