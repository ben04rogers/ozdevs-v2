<?php

namespace App\Listeners;

use Laravel\Cashier\Events\WebhookReceived;
use App\Models\User;
use App\Models\CompanyProfile;

class MarkCompanyProfileUnpaid
{
    public function handle(WebhookReceived $event)
    {
        // $payload = $event->payload;

        // $isCanceledEvent = false;

        // if ($payload['type'] === 'customer.subscription.deleted') {
        //     $isCanceledEvent = true;
        // }

        // if (
        //     $payload['type'] === 'customer.subscription.updated' &&
        //     (
        //         !empty($payload['data']['object']['canceled_at']) ||
        //         !empty($payload['data']['object']['cancel_at_period_end'])
        //     )
        // ) {
        //     $isCanceledEvent = true;
        // }

        // if ($isCanceledEvent) {
        //     $stripeId = $payload['data']['object']['customer'];
        //     $user = User::where('stripe_id', $stripeId)->first();
        // }
    }
}