<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use App\Contract\ClaimContract;
use App\Contract\ReportContract;
use App\Contract\ChatContract;
use App\Contract\AdminApprovalContract;

use App\Services\ClaimService;
use App\Services\ReportService;
use App\Services\ChatService;
use App\Services\AdminApprovalService;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(ClaimContract::class, ClaimService::class);
        $this->app->bind(ReportContract::class, ReportService::class);
        $this->app->bind(ChatContract::class, ChatService::class);
        $this->app->bind(AdminApprovalContract::class, AdminApprovalService::class);
    }

    public function boot(): void
    {
        //
    }
}