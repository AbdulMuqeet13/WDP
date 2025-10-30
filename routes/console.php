<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

Schedule::command('app:check-and-promote-cto')->daily();
Schedule::command('roi:distribute-cto')->daily();
Schedule::command('roi:credit')->daily();
Schedule::command('level:income')->daily();
Schedule::command('app:test-command')->everyMinute();
