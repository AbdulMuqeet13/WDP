<?php

namespace App\Http\Controllers;

use App\Http\Resources\TransactionResource;
use Bavix\Wallet\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class ReportController extends Controller
{
    /**
     * Show reports for both admin & user
     */
    public function index(Request $request)
    {
        $user = Auth::user();

        $query = Transaction::query()->with(['payable']);

        // Admin sees all, user sees only own
        if (!$user->hasRole('admin')) {
            $query->where('payable_id', $user->id);
        }

        // Filter by type if provided
        if ($request->filled('type') && $request->type !== 'all') {
            $query->whereJsonContains('meta->type', $request->type);
        }

        // Date filters
        if ($request->filled('from') && $request->filled('to')) {
            $query->whereBetween('created_at', [$request->from, $request->to]);
        }

        $transactions = $query
            ->latest()
            ->select('id', 'type', 'amount', 'created_at', 'payable_id')
            ->with('payable:id,name,email')
            ->paginate(20)
            ->withQueryString();

        // Summary totals by type
//        $summary = Transaction::query()
//            ->when(!$user->hasRole('admin'), fn($q) => $q->where('payable_id', $user->id))
//            ->selectRaw("
//                SUM(CASE WHEN type = 'roi' THEN amount ELSE 0 END) as roi_total,
//                SUM(CASE WHEN type = 'sponsor_income' THEN amount ELSE 0 END) as sponsor_total,
//                SUM(CASE WHEN type = 'level_income' THEN amount ELSE 0 END) as level_total,
//                SUM(CASE WHEN type = 'cto_income' THEN amount ELSE 0 END) as cto_total
//            ")->first();

        return Inertia::render('Reports/Index', [
            'transactions' => TransactionResource::collection($transactions),
//            'summary' => [
//                'roi' => $summary->roi_total ?? 0,
//                'sponsor' => $summary->sponsor_total ?? 0,
//                'level' => $summary->level_total ?? 0,
//                'cto' => $summary->cto_total ?? 0,
//            ],
            'filters' => $request->only(['type', 'from', 'to']),
        ]);
    }
}
