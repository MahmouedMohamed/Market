<?php

namespace App\Observers;

use App\Models\Promotion;
use Illuminate\Support\Facades\Cache;

class PromotionObserver
{
    /**
     * Handle the Promotion "created" event.
     */
    public function created(Promotion $promotion): void
    {
        Cache::forget('promotedProducts');
    }

    /**
     * Handle the Promotion "deleted" event.
     */
    public function deleted(Promotion $promotion): void
    {
        Cache::forget('promotedProducts');
    }

    /**
     * Handle the Promotion "force deleted" event.
     */
    public function forceDeleted(Promotion $promotion): void
    {
        Cache::forget('promotedProducts');
    }
}
