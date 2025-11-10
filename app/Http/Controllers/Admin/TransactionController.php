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
                $user->depositFloat($transaction->amount, [
                    'type' => 'User Deposit',
                ]);
                if ($user->transactions()->whereJsonContains('meta->type', 'User Deposit')->sumAmountFloat('amount')>=50){
                    if (!$user->is_active) {
                        $user->update(['is_active' => true]);
                    }
                   $user->depositFloat($transaction->amount * 0.03, [
                        'type' => 'Sponsor Income',
                    ]);
                }

            } elseif ($transaction->type === 'withdraw') {
                $user->withdrawFloat($transaction->amount, [
                    'type' => 'User Withdraw',
                ]);
            }
        }

        $transaction->update(['status' => $data['status']]);

        return back()->with('success', 'Transaction ' . $data['status'] . ' successfully.');
    }
}
