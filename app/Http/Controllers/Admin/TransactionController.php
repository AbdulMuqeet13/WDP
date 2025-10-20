<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Transaction\UpdateTransactionRequest;
use Bavix\Wallet\Models\Transaction;

class TransactionController extends Controller
{
    public function index()
    {
        $transactions = Transaction::with('user')
            ->where('status', 'pending')
            ->orderBy('created_at', 'desc')
            ->get();

        return inertia('admin/transactions/Index', [
            'transactions' => $transactions,
        ]);
    }

    public function update(Transaction $transaction, UpdateTransactionRequest $request)
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
