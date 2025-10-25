<?php
namespace App\Console\Commands;

use Bavix\Wallet\Models\Transaction;
use Illuminate\Console\Command;
use App\Models\User;
use Carbon\Carbon;
use Symfony\Component\Console\Command\Command as CommandAlias;

class DistributeCTORoyalty extends Command
{
    protected $signature = 'roi:distribute-cto';
    protected $description = 'Distribute 3% of company’s 24-hour income among all CTOs';

    public function handle()
    {
        $yesterdayIncome = Transaction::query()
            ->whereJsonContains('meta.type', 'User Deposit')
            ->whereDate('created_at', Carbon::yesterday())
            ->sum('amount');

        $royaltyPool = $yesterdayIncome * 0.03; // 3%
        $ctos = User::query()->where('is_cto', 1)->get();

        if ($ctos->isEmpty() || $royaltyPool <= 0) {
            $this->info('No CTOs or no income yesterday.');
            return CommandAlias::SUCCESS;
        }

        $share = $royaltyPool / $ctos->count();

        foreach ($ctos as $cto) {
            $cto->deposit($share, ['type' => 'CTO Royalty']);
        }

        $this->info("Distributed \${$royaltyPool} among {$ctos->count()} CTOs.");
        return CommandAlias::SUCCESS;
    }
}
