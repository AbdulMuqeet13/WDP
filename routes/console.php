<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

Schedule::command('app:check-and-promote-cto')->daily()->at('11:00');
Schedule::command('roi:distribute-cto')->daily()->at('11:30');
Schedule::command('roi:credit')->weekdays()->dailyAt('12:00');
Schedule::command('level:income')->weekdays()->dailyAt('12:15');
