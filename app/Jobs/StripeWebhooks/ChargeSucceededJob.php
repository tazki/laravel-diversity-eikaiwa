<?php

namespace App\Jobs\StripeWebhooks;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Spatie\WebhookClient\Models\WebhookCall;
use App\Models\User;
use App\Models\UserPayments;

class ChargeSucceededJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /** @var \Spatie\WebhookClient\Models\WebhookCall */
    public $webhookCall;

    public function __construct(WebhookCall $webhookCall)
    {
        $this->webhookCall = $webhookCall;
    }

    public function handle()
    {
        $charge = $this->webhookCall->payload['data']['object'];
        $user = User::where('stripe_id', $charge['customer'])->first();
        if($user) {
            $rowPayment = UserPayments::where('user_id', '=', $user->id)
            ->orderBy('id', 'desc')
            ->get();
            if(isset($rowPayment[0]) && isset($rowPayment[0]->service_id)) {
                $service = currentService($rowPayment[0]->service_id);
                if($rowPayment[0]->status == 2) {
                    $paymentData['user_id'] = $user->id;
                    $paymentData['service_price'] = $service['payment']['price'];
                    $paymentData['service_points'] = $service['payment']['points'];
                    $paymentData['service_id'] = $rowPayment[0]->service_id;
                    $paymentData['status'] = 2;
                    UserPayments::create($paymentData);
                }
            }
        }
    }
}
