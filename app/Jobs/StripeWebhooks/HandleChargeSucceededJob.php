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

class HandleChargeSucceededJob implements ShouldQueue
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
            $service_id = $charge['lines']['data']['metadata']['service_id'];

            $rowPayment = UserPayments::where([
                ['user_id', '=', $user->id],
                ['service_id', '=', $service_id],
                ['status', '=', 0]
            ])->first();

            if($rowPayment) {
                $rowPaymentData['status'] = 2;
                $condition['id'] = $rowPayment->id;
                $row = UserPayments::updateOrCreate($condition, $rowPaymentData);
            } else {
                $service = currentService($service_id);

                $paymentData['user_id'] = $user->id;
                $paymentData['service_price'] = $service['payment']['price'];
                $paymentData['service_points'] = $service['payment']['points'];
                $paymentData['service_id'] = $service_id;
                $paymentData['status'] = 2;
                UserPayments::create($paymentData);
            }
        }
    }
}
