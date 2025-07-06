<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Laravel\Cashier\Events\SubscriptionCancelled;

class MarkCompanyProfileUnpaid
{
    public function handle(SubscriptionCancelled $subscriptionCancelled): void
    {
        $user = $subscriptionCancelled->billable;
        $companyProfile = CompanyProfile::where('user_id', $user->id)->first();

        if ($companyProfile && $companyProfile->paid_subscription) {
            $companyProfile->paid_subscription = false;
            $companyProfile->save();
        }
    }
}
