<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use App\Models\Todo;
use Carbon\Carbon;
// Artisan::command('inspire', function () {
//     $this->comment(Inspiring::quote());
// })->purpose('Display an inspiring quote')->hourly();

Schedule::call(function () {
    $twoDaysAgo = Carbon::now()->subDays(2)->startOfDay();
    $tasks = Todo::whereDate('created_at', $twoDaysAgo)->get();
    $tasks->update(['completed' => true]);
})->daily();
